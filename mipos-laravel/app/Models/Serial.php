<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Serial extends Model
{

    protected $table = 'serials';
    protected $primaryKey = 'seId';
    public $timestamps = false;

    protected $fillable = [
        'pId',
        'sId',
        'seSerial',
        'seAddedBy',
        'seDate',
        'seDateSale',
        'shId',
    ];

    protected $casts = [
        'seDate' => 'datetime',
        'seDateSale' => 'datetime',
    ];
    //
}
