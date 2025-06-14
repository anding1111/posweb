<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logintime extends Model
{

    protected $table = 'logintime';
    // Primary key is 'id', which is Laravel's default. No need to specify.
    public $timestamps = false;

    protected $fillable = [
        'uId',
        'loginTime',
        'shId',
    ];
    //
}
