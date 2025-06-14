<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Localvalue extends Model
{

    protected $table = 'localvalues';
    protected $primaryKey = 'vaId';
    public $timestamps = false;

    protected $fillable = [
        'vaData',
    ];
    //
}
