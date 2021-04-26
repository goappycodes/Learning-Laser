<?php

namespace App\Http\Controllers;
use App\User;
use App\Salary;
use App\Role;
use App\Designation;
use App\Department;
use App\Payroll;
use App\Leave;
use App\Entitlement;
use DB;
use Auth;

use Illuminate\Http\Request;

class EmployeeController extends Controller
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
    public function employees()
    {
        $users = User::fetch_users();
        return view('pages.employees',['users' => $users]);
    }

    public function add_employees()
    {
        $roles = DB::select("select * from roles");
        $designations = DB::select("select * from designations");
        $departments = DB::select("select * from departments");
        $entitlements = DB::select("select * from entitled_leaves");
        return view('pages.add_employees',['roles' => $roles, 'designations' => $designations, 'departments' => $departments, 'entitlements' => $entitlements]);
    }

    public function edit_employees($id)
    {
        $user = User::find($id);
        $roles = DB::select("select * from roles");
        $designations = DB::select("select * from designations");
        $departments = DB::select("select * from departments");
        $entitlements = DB::select("select * from entitled_leaves");
        return view('pages.edit_employees',['user' => $user, 'roles' => $roles, 'designations' => $designations, 'departments' => $departments, 'entitlements' => $entitlements]);
    }

    public function post_employees(Request $request)
    {
        $input = $request->all();
        unset($input['_token']);
        $input['entitlements'] = json_encode($input['entitlements']);
        // echo '<pre>';
        // print_r($input);
        // exit;
        $date = str_replace('/', '-', $input['joining_date']);
        $input['joining_date'] = date('Y-m-d', strtotime($date));
        $date = str_replace('/', '-', $input['dob']);
        $input['dob'] = date('Y-m-d', strtotime($date));
        if(isset($input['id']))
        {
            $row_id = $input['id'];
            unset($input['id']);
            User::where('id', $row_id)->update($input);
        }
        else
        {
            User::insert($input);
        }
        return redirect()->route('employees');
    }

    public function salaries()
    {
        if(Auth::user()->isAdmin())
        {
            $salaries = Salary::fetch_user_salary();
        }
        else
        {
            $salaries = Salary::fetch_user_salary(Auth::user()->id);
        }
        $months = array( 'January', 'February', 'March', 'April', 'May', 'June', 'July ', 'August', 'September', 'October', 'November', 'December', );
        return view('pages.salaries',['salaries' => $salaries, 'months' => $months]);
    }

    public function add_salaries()
    {
        $users = DB::select("select * from users");
        $months = array( 'January', 'February', 'March', 'April', 'May', 'June', 'July ', 'August', 'September', 'October', 'November', 'December', );
        return view('pages.add_salary',['users' => $users, 'months' => $months]);
    }

    public function edit_salaries($id)
    {
        $salary = Salary::find($id);
        $users = DB::select("select * from users");
        $months = array( 'January', 'February', 'March', 'April', 'May', 'June', 'July ', 'August', 'September', 'October', 'November', 'December', );
        return view('pages.edit_salary',['users' => $users, 'months' => $months, 'salary' => $salary]);
    }

    public function post_salaries(Request $request)
    {
        $input = $request->all();
        unset($input['_token']);
        if(isset($input['id']))
        {
            $row_id = $input['id'];
            unset($input['id']);
            Salary::where('id', $row_id)->update($input);
        }
        else
        {
            Salary::insert($input);
        }
        return redirect()->route('salaries');
    }

    public function roles()
    {
        $roles = Role::all();
        return view('pages.roles',['roles' => $roles]);
    }

    public function add_roles()
    {
        return view('pages.add_roles');
    }

    public function edit_roles($id)
    {
        $role = Role::find($id);
        return view('pages.edit_roles',['role' => $role]);
    }

    public function post_roles(Request $request)
    {
        $input = $request->all();
        unset($input['_token']);
        if(isset($input['id']))
        {
            $row_id = $input['id'];
            unset($input['id']);
            Role::where('id', $row_id)->update($input);
        }
        else
        {
            Role::insert($input);
        }
        return redirect()->route('roles');
    }

    public function designations()
    {
        $designations = Designation::all();
        return view('pages.designations',['designations' => $designations]);
    }

    public function add_designations()
    {
        return view('pages.add_designations');
    }

    public function edit_designations($id)
    {
        $designation = Designation::find($id);
        return view('pages.edit_designations',['designation' => $designation]);
    }

    public function post_designations(Request $request)
    {
        $input = $request->all();
        unset($input['_token']);
        if(isset($input['id']))
        {
            $row_id = $input['id'];
            unset($input['id']);
            Designation::where('id', $row_id)->update($input);
        }
        else
        {
            Designation::insert($input);
        }
        return redirect()->route('designations');
    }

    public function departments()
    {
        $departments = Department::all();
        return view('pages.departments',['departments' => $departments]);
    }

    public function add_departments()
    {
        return view('pages.add_departments');
    }

    public function edit_departments($id)
    {
        $department = Department::find($id);
        return view('pages.edit_departments',['department' => $department]);
    }

    public function post_departments(Request $request)
    {
        $input = $request->all();
        unset($input['_token']);
        if(isset($input['id']))
        {
            $row_id = $input['id'];
            unset($input['id']);
            Department::where('id', $row_id)->update($input);
        }
        else
        {
            Department::insert($input);
        }
        return redirect()->route('departments');
    }

    public function payslip()
    {
        if(Auth::user()->isAdmin())
        {
            // $payrolls = Payroll::all();
            $payrolls = Payroll::fetch_payroll();
        }
        else
        {
            // $payrolls = Payroll::where('user_id',Auth::user()->id)->get();
            $payrolls = Payroll::fetch_payroll(Auth::user()->id);
        }
        $months = array( 'January', 'February', 'March', 'April', 'May', 'June', 'July ', 'August', 'September', 'October', 'November', 'December', );
        return view('pages.payslips',['payrolls' => $payrolls, 'months' => $months]);
    }

    public function add_payrolls()
    {
        $months = [];
        $months[date('Y-m'.'-01')] = date('F, Y');
        for ($i = 1; $i < 12; $i++) {
            $months[date('Y-m'.'-01', strtotime("-$i month"))] = date('F, Y', strtotime("-$i month"));
        }
        return view('pages.create_payroll',['months' => $months]);
    }

    public function edit_payrolls($id)
    {
        $payroll = Payroll::find($id);
        $users = DB::select("select * from users");
        $months = array( 'January', 'February', 'March', 'April', 'May', 'June', 'July ', 'August', 'September', 'October', 'November', 'December', );
        return view('pages.edit_payroll',['users' => $users, 'months' => $months, 'payroll' => $payroll]);
    }

    public function post_payrolls(Request $request)
    {
        $input = $request->all();
        unset($input['_token']);
        if(isset($input['id']))
        {
            $row_id = $input['id'];
            unset($input['id']);
            Payroll::where('id', $row_id)->update($input);
        }
        else
        {
            Payroll::insert($input);
        }
        return redirect()->route('payslips');
    }

    public function create_payrolls(Request $request)
    {
        $input = $request->all();
        unset($input['_token']);
        $input_date = $input['month'];
        $input_date_arr = explode('-',$input_date);
        $current_month = $input_date_arr[1];
        $current_year = $input_date_arr[0];
        $users = User::where('role_id',2)->get();
        foreach($users as $user)
        {
            $entitled_leaves = json_decode($user->entitlements);
            $entitlements = [];
            foreach($entitled_leaves as $entitled_id)
            {
                $entitlements[] = Entitlement::find($entitled_id);
            }
            $salary = Salary::where('user_id',$user->id)->first();
            $current_salary = $salary->current_salary;
            $joining_date = $user->joining_date;
            $leaves = Leave::where('user_id',$user->id)->where('status',1)->get();
            $total_deficit = 0;
            foreach($leaves as $leave)
            {
                $key = array_search($leave->entitled, $entitled_leaves);
                $entitle = $entitlements[$key];
                $starting_month = $entitle->starting_month;
                $starting_month = sprintf("%02d", $starting_month);
                $days_taken = 0;
                if($current_month >= $starting_month)
                {
                    if($entitle->period == '1 Year')
                    {
                        $starting_date = $current_year.'-'.$starting_month.'-01';
                        $ending_date = date('Y-m-d', strtotime($starting_date . " + 1 year"));
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
                        $ending_date = date('Y-m-d', strtotime($starting_date . " + 6 months"));
                    }
                }
                else
                {
                    if($entitle->period == '1 Year')
                    {
                        $starting_date = ($current_year-1).'-'.$starting_month.'-01';
                        $ending_date = date('Y-m-d', strtotime($starting_date . " + 1 year"));
                    }
                    elseif($entitle->period == '6 Months')
                    {
                        if(($starting_month - $current_month) <= 6)
                        {
                            // $starting_date = $current_year.'-'.$starting_month.'-01';
                            $starting_date = date('Y-m-d', strtotime($current_year.'-'.$starting_month.'-01' . " - 6 months"));
                        }
                        else
                        {
                            // $starting_date = $current_year.'-'.($starting_month + 6).'-01';
                            $starting_date = date('Y-m-d', strtotime($current_year.'-'.$starting_month.'-01' . " + 6 months"));
                        }
                        $ending_date = date('Y-m-d', strtotime($starting_date . " + 6 months"));
                    }
                }
                $leave->created_at = date('Y-m-d', strtotime($leave->created_at));
                if(($leave->entitled == $entitle->id) && (($leave->leave_from >= $starting_date)||($leave->leave_to <= $ending_date)) &&($leave->status == 1))
                {
                    if(($leave->leave_from >= $starting_date)&&($leave->leave_to <= $ending_date))
                    {
                        $days_taken = floatval($days_taken + $leave->duration);
                    }
                    elseif($leave->leave_from >= $starting_date)
                    {
                        $date1 = date_create($leave->leave_from);
                        $date2 = date_create($ending_date);
                        $days_taken = date_diff($date1,$date2);
                    }
                    elseif($leave->leave_to <= $ending_date)
                    {
                        $date1 = date_create($starting_date);
                        $date2 = date_create($leave->leave_to);
                        $days_taken = date_diff($date1,$date2);
                    }
                }
                
                if(($starting_month - $current_month == 1)||($starting_month == 1 && $current_month == 12))
                {
                    if($entitle->no_of_days < $days_taken)
                    {
                        $total_deficit += $days_taken - $entitle->no_of_days;
                    }
                }
            }

            if($total_deficit > 0)
            {
                $avg_one_day_salary = ($current_salary*12)/365;
                $net_payable = $current_salary - ($avg_one_day_salary * $total_deficit);
                $difference_any = $current_salary - $net_payable;
            }
            else
            {
                $net_payable = $current_salary;
                $difference_any = 0;
            }

            $insert_arr = array('user_id'=>$user->id, 'salary' => $current_salary, 'month' => $current_month, 'year' => $current_year, 'net_payable' => $net_payable, 'difference_any' => $difference_any);
            Payroll::where('month',$current_month)->where('year',$current_year)->delete();
            Payroll::insert($insert_arr);
        }
        return redirect()->route('payroll');
    }
}
