<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Punch extends Model
{
    protected $fillable = [
        'userid', 'punch_year_month', 'punch_date', 'punch_time', 'description',
    ];
}
