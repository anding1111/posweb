<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{

    protected $table = 'purchases';
    protected $primaryKey = 'puId';
    public $timestamps = false;

    protected $fillable = [
        'suId',
        'puTotal',
        'puPayment',
        'puAddedBy',
        'puDate',
        'puInvPurchase',
        'puDetail',
        'shId',
    ];

    protected $casts = [
        'puDate' => 'datetime',
    ];
    //
}
