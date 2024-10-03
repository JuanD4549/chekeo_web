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
        //1
        DB::table('users')->insert([
            'name' => 'admin',
            'password' => Hash::make('digitaltempo2023%'),
        ]);
        //DB::table('employees')->insert([
        //    'name' => 'DigitalTempo',
        //    'charge' => 'Root',
        //    'ci' => '123456789',
        //    'enterpriser_phone' => '0978657557',
        //]);
        //2
        DB::table('users')->insert([
            'name' => '123456799',
            'password' => Hash::make('digitaltempo2023%'),
        ]);
        DB::table('employees')->insert([
            'name' => 'Juan Diego',
            'charge' => 'Boos',
            'ci' => '123456799',
            'enterpriser_phone' => '0978657557',
            'email' => 'juandiego402@gmail.com',
            'user_id' => 2,
        ]);
        //3
        DB::table('users')->insert([
            'name' => '1234567789',
            'password' => Hash::make('digitaltempo2023%'),
        ]);
        DB::table('employees')->insert([
            'name' => 'Roberto',
            'charge' => 'Boos',
            'ci' => '1234567789',
            'enterpriser_phone' => '0978657557',
            'email' => 'Roberto@gmail.com',
            'user_id' => 3,
        ]);
        //4
        DB::table('users')->insert([
            'name' => '12344567789',
            'password' => Hash::make('digitaltempo2023%'),
        ]);
        DB::table('employees')->insert([
            'name' => 'Luis',
            'charge' => 'Admin',
            'ci' => '12344567789',
            'email' => 'Luis@gmail.com',
            'enterpriser_phone' => '0978657557',
            'user_id' => 4,
        ]);
        //5
        DB::table('users')->insert([
            'name' => '123445ew67789',
            'password' => Hash::make('digitaltempo2023%'),
        ]);
        DB::table('employees')->insert([
            'name' => 'Jose',
            'charge' => 'Boss',
            'ci' => '123445ew67789',
            'email' => 'jose@gmail.com',
            'enterpriser_phone' => '0978657557',
            'user_id' => 5,
        ]);
        //6
        DB::table('users')->insert([
            'name' => '122344567789',
            'password' => Hash::make('digitaltempo2023%'),
        ]);
        DB::table('employees')->insert([
            'name' => 'Melany',
            'charge' => 'Admin',
            'ci' => '122344567789',
            'email' => 'melany@gmail.com',
            'enterpriser_phone' => '0978657557',
            'user_id' => 6,
        ]);
        //7
        DB::table('users')->insert([
            'name' => '1223424567789',
            'password' => Hash::make('digitaltempo2023%'),
        ]);
        DB::table('employees')->insert([
            'name' => 'Julio',
            'charge' => 'Employee',
            'ci' => '1223424567789',
            'email' => 'julio@gmail.com',
            'enterpriser_phone' => '0978657557',
            'user_id' => 7,
        ]);
        //8
        DB::table('users')->insert([
            'name' => '1223494567789',
            'password' => Hash::make('digitaltempo2023%'),
        ]);
        DB::table('employees')->insert([
            'name' => 'Pedro',
            'charge' => 'Employee',
            'ci' => '1223494567789',
            'enterpriser_phone' => '0978657557',
            'email' => 'pedro@gmail.com',
            'user_id' => 8,
        ]);
    }
}
