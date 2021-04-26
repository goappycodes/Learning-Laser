<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $table = 'payrolls';

    protected $fillable = [
        'user_id', 'salary', 'month', 'payment_method', 'note', 'created_at','updated_at'
    ];

    public static function fetch_payroll($id=null)
    {
        if($id == null)
        {
            $payroll_rows = DB::select("Select p.*, users.joining_date, salaries.appraisal_month From payrolls as p Left Join users ON p.user_id = users.id Left Join salaries ON salaries.user_id = users.id");
        }
        else
        {
            $payroll_rows = DB::select("Select p.*, users.joining_date, salaries.appraisal_month From payrolls as p Left Join users ON p.user_id = users.id Left Join salaries ON salaries.user_id = users.id where p.user_id = ".$id);
        }
        return $payroll_rows;
    }
}
