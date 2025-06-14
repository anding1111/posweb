<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            // 'id' column (Laravel's default PK for users table) will auto-increment.
            'uId' => 1000, // Custom identifier from original schema
            'uFullName' => 'MI POS',
            'uName' => 'admin',
            'uPassword' => Hash::make('admin'),
            'uType' => 'admin',
            'uFlag' => 1,
            'softDelete' => 0,
            'uAddedBy' => 1000, // Assuming this refers to a uId
            'uEntryDate' => '2021-04-25',
            'shId' => 11, // Foreign key to shops table
        ]);
    }
}
