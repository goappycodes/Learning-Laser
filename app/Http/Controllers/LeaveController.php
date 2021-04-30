<?php

namespace App\Http\Controllers;
use App\User;
use App\Leave;
use App\Entitlement;
use App\Holiday;
use DB;
use Illuminate\Http\Request;
use Auth;

class LeaveController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function leaves()
    {
        if(Auth::user()->isAdmin())
        {
            $leaves = Leave::fetch_leaves();
            $entitled = [];
            $is_admin = 1;
        }
        else
        {
            $leaves = Leave::fetch_leaves(Auth::user()->id);
            $users = DB::select("select * from users where id=".Auth::user()->id);
            $entitlements = json_decode($users[0]->entitlements, true);
            if(!$entitlements)
            {
                $entitlements = [];
            }
            $entitlements = implode(",",$entitlements);
            $entitled = DB::select("select * from entitled_leaves where id in (".$entitlements.")");
            $is_admin = 0;
        }
        return view('pages.leaves',['leaves' => $leaves, 'entitled' => $entitled, 'is_admin' => $is_admin]);
    }

    public function add_leaves()
    {
        if(Auth::user()->isAdmin())
        {
            $users = DB::select("select * from users");
            $entitled = DB::select("select * from entitled_leaves");
            $is_admin = 1;
        }
        else
        {
            $users = DB::select("select * from users where id=".Auth::user()->id);
            $entitlements = json_decode($users[0]->entitlements, true);
            if(!$entitlements)
            {
                $entitlements = [];
            }
            $entitlements = implode(",",$entitlements);
            $valid_entiitlements = [];
            $entitled = DB::select("select * from entitled_leaves where id in (".$entitlements.")");
            $leaves = Leave::fetch_leaves(Auth::user()->id);
            $current_month = date('m');
            $current_year = date('Y');
            foreach($entitled as $entitle)
            {
                $total_days = $entitle->no_of_days;
                $days_taken = 0;
                foreach($leaves as $leave)
                {
                    $starting_month = $entitle->starting_month;
                    $starting_month = sprintf("%02d", $starting_month);
                    if($current_month >= $starting_month)
                    {
                        if($entitle->period == '1 Year')
                        {
                            $starting_date = $current_year.'-'.$starting_month.'-01';
                        }
                        elseif($entitle->period == '6 Months')
                        {
                            if(($current_month - $starting_month) <= 6)
                            {
                                $starting_date = $current_year.'-'.$starting_month.'-01';
                            }
                            else
                            {
                                $starting_date = $current_year.'-'.($starting_month + 6).'-01';
                            }
                        }
                    }
                    else
                    {
                        if($entitle->period == '1 Year')
                        {
                            $starting_date = ($current_year-1).'-'.$starting_month.'-01';
                        }
                        elseif($entitle->period == '6 Months')
                        {
                            if(($starting_month - $current_month) <= 6)
                            {
                                $starting_date = date('Y-m-d', strtotime($current_year.'-'.$starting_month.'-01' . " - 6 months"));
                            }
                            else
                            {
                                $starting_date = date('Y-m-d', strtotime($current_year.'-'.$starting_month.'-01' . " + 6 months"));
                            }
                        }
                    }
                    $leave->created_at = date('Y-m-d', strtotime($leave->created_at));
                    if(($leave->entitled == $entitle->leave_name) && ($leave->created_at >= $starting_date) &&($leave->status == 1))
                    {
                        $days_taken = floatval($days_taken + $leave->duration);
                    }
                }
                $days_left = floatval($total_days - $days_taken);
                if(($days_taken == 0) || ($days_left > 0))
                {
                    $entitle->no_of_days = $days_left;
                    $valid_entiitlements[] = $entitle;
                }
            }
            $entitled = $valid_entiitlements;
            $is_admin = 0;
        }
        return view('pages.add_leaves',['users' => $users, 'entitled' =>$entitled, 'is_admin' => $is_admin]);
    }

    public function edit_leaves()
    {
        return view('pages.edit_employees');
    }

    public function post_leaves(Request $request)
    {
        $input = $request->all();
        unset($input['_token']);
        $date = str_replace('/', '-', $input['leave_from']);
        $input['leave_from'] = date('Y-m-d', strtotime($date));
        $date = str_replace('/', '-', $input['leave_to']);
        $input['leave_to'] = date('Y-m-d', strtotime($date));
        $input['created_at'] = date('Y-m-d H:i:s');
        $leave_from = $input['leave_from'];
        $leave_to = $input['leave_to'];
        $input_date_arr = Leave::displayDates($leave_from,$leave_to);
        $other_leaves = Leave::where('leave_to','>=',$leave_from)->where('status',1)->get();
        $leaves_count_arr = [];
        foreach($other_leaves as $leave)
        {
            $date_from = strtotime($leave->leave_from);
            $date_to = strtotime($leave->leave_to);
            $stepVal = '+1 day';
            while( $date_from <= $date_to ) {
                if(in_array($date_from,$input_date_arr))
                {
                    if(isset($leaves_count_arr[date('d-m-Y', $date_from)]))
                    {
                        $leaves_count_arr[date('d-m-Y', $date_from)]++;
                    }
                    else
                    {
                        $leaves_count_arr[date('d-m-Y', $date_from)] = 1;
                    }
                }
                $date_from = strtotime($stepVal, $date_from);
            }
        }
        $date = '';
        foreach( $leaves_count_arr as $count_key => $count)
        {
            if($count > 2)
            {
                $date = $count_key;
                break;
            }
        }
        if($date)
        {
            return redirect()->back()->with('message', '3 or more leaves have been granted on '.$date.'. Thus your leave could not be processed.');
        }
        else
        {
            Leave::insert($input);
            return redirect()->route('add_leaves');
        }
        
    }

    public function entitlements()
    {
        $entitlements = Entitlement::all();
        return view('pages.entitlements',['entitlements' => $entitlements]);
    }

    public function add_entitlement()
    {
        $months = array( 'January', 'February', 'March', 'April', 'May', 'June', 'July ', 'August', 'September', 'October', 'November', 'December', );
        return view('pages.add_entitlements',['months' => $months]);
    }

    public function edit_entitlement($id)
    {
        $entitlement = Entitlement::find($id);
        $months = array( 'January', 'February', 'March', 'April', 'May', 'June', 'July ', 'August', 'September', 'October', 'November', 'December', );
        return view('pages.edit_entitlements',['entitlement' => $entitlement, 'months' => $months]);
    }

    public function post_entitlement(Request $request)
    {
        $input = $request->all();
        unset($input['_token']);
        if(isset($input['id']))
        {
            $input['updated_at'] = date('Y-m-d H:i:s');
            $row_id = $input['id'];
            unset($input['id']);
            Entitlement::where('id', $row_id)->update($input);
        }
        else
        {
            $input['created_at'] = date('Y-m-d H:i:s');
            Entitlement::insert($input);
        }
        return redirect()->route('entitlements');
    }

    public function holidays()
    {
        $holidays = Holiday::all();
        return view('pages.holidays',['holidays' => $holidays]);
    }

    public function add_holidays()
    {
        return view('pages.add_holidays');
    }

    public function edit_holidays($id)
    {
        $holiday = Holiday::find($id);
        return view('pages.edit_holidays',['holiday' => $holiday]);
    }

    public function post_holidays(Request $request)
    {
        $input = $request->all();
        unset($input['_token']);
        $date = str_replace('/', '-', $input['holiday_date']);
        $input['holiday_date'] = date('Y-m-d', strtotime($date));
        if(isset($input['id']))
        {
            $row_id = $input['id'];
            unset($input['id']);
            Holiday::where('id', $row_id)->update($input);
        }
        else
        {
            Holiday::insert($input);
        }
        return redirect()->route('holidays');
    }

    public function approve_reject_leaves(Request $request)
    {
        $input = $request->all();
        unset($input['_token']);
        $approve = $input['approve'];
        $leave_id = $input['leave_id'];
        $leave = Leave::find($leave_id);
        if($approve == 1)
        {
            $leave->status = 1;
        }
        else
        {
            $leave->status = 2;
        }
        $leave->save();
    }
}
