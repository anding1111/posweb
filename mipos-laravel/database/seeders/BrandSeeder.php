<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('brands')->insert([
            // 'bId' will auto-increment if defined as such (PK)
            'bName' => 'Sin Marca',
            'shId' => 11, // Foreign key to shops table
        ]);
    }
}
