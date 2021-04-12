<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminAuthenticated​;
use App\Http\Middleware\UserAuthenticated;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');

Route::group(array('middleware' => [AdminAuthenticated​::class],'prefix' => 'employee'), function()
{
	Route::get('/', 'EmployeeController@employees')->name('employees');

	Route::get('/add', 'EmployeeController@add_employees')->name('add_employees');

	Route::get('/edit/{id}', 'EmployeeController@edit_employees')->name('edit_employees');

	Route::post('/emp-post', 'EmployeeController@post_employees')->name('post_employees');
	
});

Route::group(array('prefix' => 'holiday'), function()
{
	Route::get('/', 'LeaveController@holidays')->name('holidays')->middleware(UserAuthenticated::class);

	Route::get('/add', 'LeaveController@add_holidays')->name('add_holidays')->middleware(AdminAuthenticated​::class);

	Route::get('/edit/{id}', 'LeaveController@edit_holidays')->name('edit_holidays')->middleware(AdminAuthenticated​::class);

	Route::post('/post', 'LeaveController@post_holidays')->name('post_holidays')->middleware(AdminAuthenticated​::class);

});

Route::group(array('prefix' => 'leave'), function()
{
	Route::get('/', 'LeaveController@leaves')->name('leaves')->middleware(UserAuthenticated::class);

	Route::get('/add', 'LeaveController@add_leaves')->name('add_leaves')->middleware(UserAuthenticated::class);

	Route::get('/edit', 'LeaveController@edit_leaves')->name('edit_leaves')->middleware(UserAuthenticated::class);

	Route::post('/post', 'LeaveController@post_leaves')->name('post_leaves')->middleware(UserAuthenticated::class);

	Route::get('/entitlement', 'LeaveController@entitlements')->name('entitlements')->middleware(UserAuthenticated::class);

	Route::get('/add-entitlement', 'LeaveController@add_entitlement')->name('add_entitlement')->middleware(AdminAuthenticated​::class);

	Route::get('/edit-entitlement/{id}', 'LeaveController@edit_entitlement')->name('edit_entitlement')->middleware(AdminAuthenticated​::class);

	Route::post('/post-entitlement', 'LeaveController@post_entitlement')->name('post_entitlement')->middleware(AdminAuthenticated​::class);

	Route::post('/approve-reject-leaves', 'LeaveController@approve_reject_leaves')->name('approve_reject_leaves')->middleware(AdminAuthenticated​::class);
});

Route::group(array('prefix' => 'salary'), function()
{
	Route::get('/', 'EmployeeController@salaries')->name('salaries')->middleware(UserAuthenticated::class);

	Route::get('/add', 'EmployeeController@add_salaries')->name('add_salaries')->middleware(AdminAuthenticated​::class);

	Route::get('/edit/{id}', 'EmployeeController@edit_salaries')->name('edit_salaries')->middleware(AdminAuthenticated​::class);

	Route::post('/post', 'EmployeeController@post_salaries')->name('post_salaries')->middleware(AdminAuthenticated​::class);
});

Route::group(array('middleware' => [AdminAuthenticated​::class],'prefix' => 'role'), function()
{
	Route::get('/', 'EmployeeController@roles')->name('roles');

	Route::get('/add', 'EmployeeController@add_roles')->name('add_roles');

	Route::get('/edit/{id}', 'EmployeeController@edit_roles')->name('edit_roles');

	Route::post('/post', 'EmployeeController@post_roles')->name('post_roles');
});

Route::group(array('middleware' => [AdminAuthenticated​::class],'prefix' => 'designation'), function()
{
	Route::get('/', 'EmployeeController@designations')->name('designations');

	Route::get('/add', 'EmployeeController@add_designations')->name('add_designations');

	Route::get('/edit/{id}', 'EmployeeController@edit_designations')->name('edit_designations');

	Route::post('/post', 'EmployeeController@post_designations')->name('post_designations');
});

Route::group(array('middleware' => [AdminAuthenticated​::class],'prefix' => 'department'), function()
{
	Route::get('/', 'EmployeeController@departments')->name('departments');

	Route::get('/add', 'EmployeeController@add_departments')->name('add_departments');

	Route::get('/edit/{id}', 'EmployeeController@edit_departments')->name('edit_departments');

	Route::post('/post', 'EmployeeController@post_departments')->name('post_departments');
});
