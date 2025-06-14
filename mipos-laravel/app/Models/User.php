<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail; // Remove if not using email verification
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // If using Sanctum for API tokens

class User extends Authenticatable // Add 'implements MustVerifyEmail' if needed
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users'; // Explicitly set for clarity, matches migration.
    // Primary key 'id' is default.
    public $timestamps = false; // Original table has 'uEntryDate', not Laravel's timestamps.

    protected $fillable = [
        'uId',
        'uFullName',
        'uName',        // For login, often mapped to 'username' or 'email' in Laravel auth.
        'uPassword',    // This will store the hashed password.
        'uType',
        'uFlag',
        'softDelete',   // Consider Laravel's SoftDeletes trait for 'deleted_at'.
        'uAddedBy',
        'uEntryDate',
        'shId',
        // 'email', // Missing in original table. Required for MustVerifyEmail.
    ];

    protected $hidden = [
        'uPassword',
        // 'remember_token', // Column not in original table. Add if using remember_me.
    ];

    protected $casts = [
        // 'email_verified_at' => 'datetime', // Column not in original table.
        'uEntryDate' => 'date',
        'uFlag' => 'boolean',
        // 'uPassword' => 'hashed', // Laravel 10+ feature. For Laravel 11, 'password' attribute is auto-hashed.
                                     // If using 'uPassword', a mutator is needed for auto-hashing if not named 'password'.
    ];

    // If using Laravel's default authentication, it expects a 'password' field for hashing.
    // To use 'uPassword' with default hashing mechanisms, you might need this mutator:
    public function setUPasswordAttribute($value)
    {
        $this->attributes['uPassword'] = bcrypt($value);
    }

    // If authenticating with 'uName' instead of 'email':
    // public function findForPassport($username) // Example for Passport
    // {
    //     return $this->where('uName', $username)->first();
    // }

    // If using Sanctum and authenticating with 'uName' (custom username field for Sanctum)
    // You might need to customize how Sanctum finds the user if 'email' is not used.
    // This is often handled in the AuthServiceProvider or by overriding Sanctum's token creation/validation logic.
    // For basic API token authentication where you manually create tokens, this model setup is okay.
}



    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shId', 'shId');
    }
}
