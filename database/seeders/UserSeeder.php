<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'DigitalTempo',
            'charge'=>'Root',
            'ci'=>'123456789',
            'enterpriser_phone'=>'0978657557',
            'email'=>'digitaltempo@gmail.com',
            'password'=>Hash::make('digitaltempo2023%'),
        ]);
        DB::table('users')->insert([
            'name' => 'Juan Diego',
            'charge'=>'Boos',
            'ci'=>'123456799',
            'enterpriser_phone'=>'0978657557',
            'email'=>'juandiego402@gmail.com',
            'password'=>Hash::make('digitaltempo2023%'),
        ]);
    }
}
