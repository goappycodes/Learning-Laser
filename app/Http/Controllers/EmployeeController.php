<?php

namespace App\Http\Controllers;
use App\User;
use App\Salary;
use App\Role;
use App\Designation;
use App\Department;
use DB;

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

    public function edit_employees()
    {
        return view('pages.edit_employees');
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
        User::insert($input);
        return redirect()->route('add_employees');
    }

    public function salaries()
    {
        $salaries = Salary::fetch_user_salary();
        $months = array( 'January', 'February', 'March', 'April', 'May', 'June', 'July ', 'August', 'September', 'October', 'November', 'December', );
        return view('pages.salaries',['salaries' => $salaries, 'months' => $months]);
    }

    public function add_salaries()
    {
        $users = DB::select("select * from users");
        $months = array( 'January', 'February', 'March', 'April', 'May', 'June', 'July ', 'August', 'September', 'October', 'November', 'December', );
        return view('pages.add_salary',['users' => $users, 'months' => $months]);
    }

    public function post_salaries(Request $request)
    {
        $input = $request->all();
        unset($input['_token']);
        Salary::insert($input);
        return redirect()->route('add_salaries');
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

    public function post_roles(Request $request)
    {
        $input = $request->all();
        unset($input['_token']);
        Role::insert($input);
        return redirect()->route('add_roles');
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

    public function post_designations(Request $request)
    {
        $input = $request->all();
        unset($input['_token']);
        Designation::insert($input);
        return redirect()->route('add_designations');
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

    public function post_departments(Request $request)
    {
        $input = $request->all();
        unset($input['_token']);
        Department::insert($input);
        return redirect()->route('add_departments');
    }
}
