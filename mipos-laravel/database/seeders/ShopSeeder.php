<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShopSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('shop')->insert([
            'shId' => 11, // Explicitly setting shId for the shop itself
            'shName' => 'Mi POS',
            'shAuxName' => 'Web',
            'shDoc' => '1085903578-11',
            'shTelf' => '3202807060',
            'shDir' => 'KRA. 33 # 23-51 B/ CENTRO NARIÑO - BOGOTA DC - COLOMBIA',
            'shMail' => 'ventas@mipos.pro',
            'shWeb' => 'www.mipos.pro',
            'shDesc' => 'Facilitamos tus ventas',
            'shColor' => '#BC1269',
            'shEnable' => 1,
        ]);
    }
}
