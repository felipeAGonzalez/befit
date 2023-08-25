<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SubsidiarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('subsidiary')->insert([
            'name' => 'Sucursal Base',
            'address' => 'Av. Siempre Viva 123',
            'zip_code' => '58000',
            'phone_number' =>'555512355',
            'logo' =>'null'
        ]);
    }
}
