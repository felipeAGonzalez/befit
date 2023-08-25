<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Soporte',
            'subsidiary_id' => 1,
            'position' => 'ROOT',
            'shift' => 'none',
            'email' => 'befit@gmail.com',
            'password' => Hash::make('apocalipsis'),
        ]);
    }
}
