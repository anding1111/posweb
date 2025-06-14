<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logouttime extends Model
{

    protected $table = 'logouttime';
    // Primary key is 'id', Laravel's default.
    public $timestamps = false;

    protected $fillable = [
        'uId',
        'logoutTime',
        'shId',
    ];
    //
}
