<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{

    protected $table = 'shop';
    protected $primaryKey = 'shId';
    public $timestamps = false;

    protected $fillable = [
        'shName',
        'shAuxName',
        'shDoc',
        'shTelf',
        'shDir',
        'shMail',
        'shWeb',
        'shDesc',
        'shColor',
        'shEnable',
    ];
    //


    public function items()
    {
        return $this->hasMany(Item::class, 'shId', 'shId');
    }

    public function brands()
    {
        return $this->hasMany(Brand::class, 'shId', 'shId');
    }

    public function clients()
    {
        return $this->hasMany(Client::class, 'shId', 'shId');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'shId', 'shId');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'shId', 'shId');
    }
}
