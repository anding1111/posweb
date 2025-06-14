<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory; // Included in properties

    protected $table = 'client';
    protected $primaryKey = 'cId';
    public $timestamps = false;

    protected $fillable = [
        'cName',
        'cDoc',
        'cTelf',
        'cDir',
        'cEmail',
        'cViewInv',
        'cAddedBy',
        'cEntryDate',
        'clEnable',
        'shId',
    ];
    //


    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shId', 'shId');
    }
}
