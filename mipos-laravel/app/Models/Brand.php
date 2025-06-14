<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory; // Included in properties

    protected $table = 'brands';
    protected $primaryKey = 'bId';
    public $timestamps = false;

    protected $fillable = [
        'bName',
        'shId',
    ];
    //


    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shId', 'shId');
    }
}
