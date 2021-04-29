<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Leave;
use App\Entitlement;
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
        $user_rows = DB::select("Select u.id, f_name, l_name, email, employee_id, entitlements,role_id, department_id, designation_id, DATE_FORMAT(  `joining_date` ,'%d-%m-%Y' )  as joining_date, CASE WHEN gender = 1 THEN 'Male' ELSE 'Female' END as gender, DATE_FORMAT(  `dob` ,'%d-%m-%Y' )  as dob, ph_no, local_address, permanent_address, roles.role_name, departments.department_name, designations.designation_name From users as u Left Join roles ON u.role_id = roles.id Left Join departments ON u.department_id = departments.id Left Join designations ON u.designation_id = designations.id ");
        foreach($user_rows as $row)
        {
            $entitlements = json_decode($row->entitlements, true);
            $entitle_text = '';
            foreach($entitlements as $entitlement_id)
            {
                $entitle = Entitlement::find($entitlement_id);
                $total_alloted = $entitle->no_of_days;
                $entitle_name = $entitle->leave_name;
                $starting_month = $entitle->starting_month;
                $starting_month = sprintf("%02d", $starting_month);
                $current_month = date('m');
                $current_year = date('Y');
                if($current_month >= $starting_month)
                {
                    if($entitle->period == '1 Year')
                    {
                        $starting_date = $current_year.'-'.$starting_month.'-01';
                        $ending_date = date('Y-m-d', strtotime($starting_date . " + 1 year"));
                    }
                    elseif($entitle->period == '6 Months')
                    {
                        if(($current_month - $starting_month) <= 6)
                        {
                            $starting_date = $current_year.'-'.$starting_month.'-01';
                        }
                        else
                        {
                            $starting_date = $current_year.'-'.($starting_month + 6).'-01';
                        }
                        $ending_date = date('Y-m-d', strtotime($starting_date . " + 6 months"));
                    }
                }
                else
                {
                    if($entitle->period == '1 Year')
                    {
                        $starting_date = ($current_year-1).'-'.$starting_month.'-01';
                        $ending_date = date('Y-m-d', strtotime($starting_date . " + 1 year"));
                    }
                    elseif($entitle->period == '6 Months')
                    {
                        if(($starting_month - $current_month) <= 6)
                        {
                            $starting_date = date('Y-m-d', strtotime($current_year.'-'.$starting_month.'-01' . " - 6 months"));
                        }
                        else
                        {
                            $starting_date = date('Y-m-d', strtotime($current_year.'-'.$starting_month.'-01' . " + 6 months"));
                        }
                        $ending_date = date('Y-m-d', strtotime($starting_date . " + 6 months"));
                    }
                }
                $total_leaves = 0;
                $leaves = Leave::where('user_id',$row->id)->where('status',1)->where('entitled',$entitlement_id)->where('leave_from','>=',$starting_date)->where(function($q) use ($starting_date, $ending_date){
                    $q->where('leave_from','>=',$starting_date)
                      ->orWhere('leave_to','<',$ending_date);
                })->get();

                foreach($leaves as $leave)
                {
                    if(($leave->leave_from >= $starting_date)&&($leave->leave_to <= $ending_date))
                    {
                        $total_leaves += $leave->duration;
                    }
                    elseif($leave->leave_from >= $starting_date)
                    {
                        $date1 = date_create($leave->leave_from);
                        $date2 = date_create($ending_date);
                        $total_leaves += date_diff($date1,$date2);
                    }
                    elseif($leave->leave_to <= $ending_date)
                    {
                        $date1 = date_create($starting_date);
                        $date2 = date_create($leave->leave_to);
                        $total_leaves += date_diff($date1,$date2);
                    }
                }

                $entitle_text .= $entitle_name." - (".$total_leaves." out of ".$total_alloted.")\n";
            }
            $row->leaves = $entitle_text;
        }
        return $user_rows;
    }

    public function isAdmin() {
        return $this->role_id === 1;
     }
 
     public function isUser() {
        return $this->role_id === 2;
     }
}
