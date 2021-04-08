<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Leave extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'leaves';

    protected $fillable = [
        'user_id', 'leave_from', 'leave_to', 'duration','leave_subject','created_at','updated_at'
    ];


    public static function fetch_leaves()
    {

        $leave_rows = DB::select("Select DATE_FORMAT(  `leave_from` ,'%d-%m-%Y' )  as leave_from, DATE_FORMAT(  `leave_to` ,'%d-%m-%Y' )  as leave_to, duration, leave_subject , DATE_FORMAT(  l.`created_at` ,'%d-%m-%Y' )  as created_at, users.f_name, users.l_name, users.email, users.employee_id, entitled_leaves.leave_name as entitled From leaves as l Left Join users ON l.user_id = users.id Left Join entitled_leaves ON l.entitled = entitled_leaves.id");
        return $leave_rows;
    }
}
