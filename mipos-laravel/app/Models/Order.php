<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $table = 'orders';
    protected $primaryKey = 'cmId';
    public $timestamps = false;

    protected $fillable = [
        'invId',
        'pId',
        'cId',
        'pPrice',
        'pQty',
        'inCost',
        'pMount',
        'cPayment',
        'bDate',
        'inSerial',
        'orEnable',
        'shId',
    ];

    protected $casts = [
        'bDate' => 'datetime',
    ];
    //


    public function client()
    {
        return $this->belongsTo(Client::class, 'cId', 'cId');
    }

    public function item()
    {
        // Assuming pId in orders table refers to items.pId
        return $this->belongsTo(Item::class, 'pId', 'pId');
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shId', 'shId');
    }
}
