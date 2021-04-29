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
        'user_id', 'leave_from', 'leave_to', 'duration','leave_subject','status','created_at','updated_at'
    ];


    public static function fetch_leaves($id = null)
    {
        if($id)
        {
            $leave_rows = DB::select("Select l.id, DATE_FORMAT(  `leave_from` ,'%d-%m-%Y' )  as leave_from, DATE_FORMAT(  `leave_to` ,'%d-%m-%Y' )  as leave_to, duration, leave_subject , DATE_FORMAT(  l.`created_at` ,'%d-%m-%Y' )  as created_at, l.status, users.f_name, users.l_name, users.email, users.employee_id, entitled_leaves.leave_name as entitled From leaves as l Left Join users ON l.user_id = users.id Left Join entitled_leaves ON l.entitled = entitled_leaves.id where users.id=".$id);
        }
        else
        {
            $leave_rows = DB::select("Select l.id, DATE_FORMAT(  `leave_from` ,'%d-%m-%Y' )  as leave_from, DATE_FORMAT(  `leave_to` ,'%d-%m-%Y' )  as leave_to, duration, leave_subject , DATE_FORMAT(  l.`created_at` ,'%d-%m-%Y' )  as created_at, l.status, users.f_name, users.l_name, users.email, users.employee_id, entitled_leaves.leave_name as entitled From leaves as l Left Join users ON l.user_id = users.id Left Join entitled_leaves ON l.entitled = entitled_leaves.id");
        }
        return $leave_rows;
    }

    public static function displayDates($date1, $date2, $format = 'Y-m-d' )
    {
        $dates = array();
        $current = strtotime($date1);
        $date2 = strtotime($date2);
        $stepVal = '+1 day';
        while( $current <= $date2 ) {
            $dates[] = date($format, $current);
            $current = strtotime($stepVal, $current);
        }
        return $dates;
    }
}
