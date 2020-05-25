<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckIp extends Model
{
    //
    protected $fillable = [
        'ip', 'iswhite',
    ];
}
