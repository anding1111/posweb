<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('suppliers')->insert([
            // 'sId' will auto-increment if defined as such (PK)
            'sName' => 'Sin Proveedor',
            'sDoc' => 888888888,
            'sTelf' => 55555555,
            'sDir' => 'xxxxxxxxx',
            'sAddedBy' => '1000', // Assuming this refers to a uId
            'sEntryDate' => '2021-04-25 17:36:28',
            'shId' => 11, // Foreign key to shops table
        ]);
    }
}
