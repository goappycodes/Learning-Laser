<?php

namespace App\Http\Controllers;
use App\User;
use App\Leave;
use App\Entitlement;
use App\Holiday;
use DB;
use Illuminate\Http\Request;

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
        $leaves = Leave::fetch_leaves();
        return view('pages.leaves',['leaves' => $leaves]);
    }

    public function add_leaves()
    {
        $users = DB::select("select * from users");
        $entitled = DB::select("select * from entitled_leaves");
        return view('pages.add_leaves',['users' => $users, 'entitled' =>$entitled]);
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
        Leave::insert($input);
        return redirect()->route('add_leaves');
    }

    public function entitlements()
    {
        $entitlements = Entitlement::all();
        return view('pages.entitlements',['entitlements' => $entitlements]);
    }

    public function add_entitlement()
    {
        return view('pages.add_entitlements');
    }

    public function edit_entitlement()
    {
        return view('pages.edit_entitlements');
    }

    public function post_entitlement(Request $request)
    {
        $input = $request->all();
        unset($input['_token']);
        Entitlement::insert($input);
        return redirect()->route('add_entitlement');
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

    public function post_holidays(Request $request)
    {
        $input = $request->all();
        unset($input['_token']);
        $date = str_replace('/', '-', $input['holiday_date']);
        $input['holiday_date'] = date('Y-m-d', strtotime($date));
        Holiday::insert($input);
        return redirect()->route('add_holidays');
    }
}
