<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    protected $table = 'notification';
    protected $primaryKey = 'nId';
    public $timestamps = false;

    protected $fillable = [
        'nToWhom',
        'nFromWhom',
        'newUserId',
        'nMessage',
        'nDate',
        'delete',
        'shId',
    ];
    //
}
