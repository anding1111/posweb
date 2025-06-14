<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{

    protected $table = 'suppliers';
    protected $primaryKey = 'sId';
    public $timestamps = false;

    protected $fillable = [
        'sName',
        'sDoc',
        'sTelf',
        'sDir',
        'sAddedBy',
        'sEntryDate',
        'shId',
    ];

    protected $casts = [
        'sEntryDate' => 'datetime',
    ];
    //
}
