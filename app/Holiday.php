<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    protected $table = 'holidays';

    protected $fillable = [
        'holiday_date', 'holiday_name', 'created_at','updated_at'
    ];
}
