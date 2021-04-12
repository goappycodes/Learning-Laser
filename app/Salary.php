<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Salary extends Model
{
    protected $table = 'salaries';

    protected $fillable = [
        'user_id', 'previous_salaray', 'current_salary', 'appraisal_month', 'note', 'created_at','updated_at'
    ];

    public static function fetch_user_salary($id=null)
    {
        if($id == null)
        {
            $salary_rows = DB::select("Select s.*, users.f_name, users.l_name From salaries as s Left Join users ON s.user_id = users.id");
        }
        else
        {
            $salary_rows = DB::select("Select s.*, users.f_name, users.l_name From salaries as s Left Join users ON s.user_id = users.id where s.user_id = ".$id);
        }
        return $salary_rows;
    }
}
