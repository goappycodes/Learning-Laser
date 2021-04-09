<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'users';

    protected $fillable = [
        'f_name', 'l_name', 'email', 'password','employee_id','role_id','department_id','designation_id','joining_date','gender','dob','ph_no','local_address','permanent_address','created_at','updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function fetch_users()
    {
        $user_rows = DB::select("Select u.id, f_name, l_name, email, employee_id, role_id, department_id, designation_id, DATE_FORMAT(  `joining_date` ,'%d-%m-%Y' )  as joining_date, CASE WHEN gender = 1 THEN 'Male' ELSE 'Female' END as gender, DATE_FORMAT(  `dob` ,'%d-%m-%Y' )  as dob, ph_no, local_address, permanent_address, roles.role_name, departments.department_name, designations.designation_name From users as u Left Join roles ON u.role_id = roles.id Left Join departments ON u.department_id = departments.id Left Join designations ON u.designation_id = designations.id ");
        return $user_rows;
    }

    public function isAdmin() {
        return $this->role_id === 1;
     }
 
     public function isUser() {
        return $this->role_id === 2;
     }
}
