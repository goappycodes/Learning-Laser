<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entitlement extends Model
{
    protected $table = 'entitled_leaves';

    protected $fillable = [
        'leave_name', 'no_of_days', 'period', 'created_at', 'updated_at'
    ];


    public static function fetch_leaves()
    {

        $leave_rows = DB::select("Select DATE_FORMAT(  `leave_from` ,'%d-%m-%Y' )  as leave_from, DATE_FORMAT(  `leave_to` ,'%d-%m-%Y' )  as leave_to, duration, leave_subject , DATE_FORMAT(  l.`created_at` ,'%d-%m-%Y' )  as created_at, users.f_name, users.l_name, users.email, users.employee_id From leaves as l Left Join users ON l.user_id = users.id ");
        return $leave_rows;
    }
}
