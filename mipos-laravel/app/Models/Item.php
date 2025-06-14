<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory; // Included in properties

    protected $table = 'items';
    protected $primaryKey = 'pId';
    public $timestamps = false;

    protected $fillable = [
        'pBarCode',
        'pName',
        'pIdBrand',
        'pQuantity',
        'pCost',
        'pPrice',
        'pEnable',
        'shId',
    ];
    //


    public function brand()
    {
        return $this->belongsTo(Brand::class, 'pIdBrand', 'bId');
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shId', 'shId');
    }
}
