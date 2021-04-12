<?php

namespace App\Http\Controllers;
use App\User;
use App\Salary;
use App\Role;
use App\Designation;
use App\Department;
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
}
