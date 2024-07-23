<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Roberto',
            'ci'=>'1234567789',
            'enterpriser_phone'=>'0978657557',
            'email'=>'Roberto@gmail.com',
            'password'=>Hash::make('digitaltempo2023%'),
        ]);
        DB::table('users')->insert([
            'name' => 'Luis',
            'ci'=>'12344567789',
            'enterpriser_phone'=>'0978657557',
            'email'=>'Luis@gmail.com',
            'password'=>Hash::make('digitaltempo2023%'),
        ]);
        DB::table('enterprises')->insert([
            'name' => 'DigitalTempo',
            'ruc'=>'123456789',
            'cellphone'=>'0978657557',
            'address'=>'Quito',
            'legal_representative'=>'Jorge Salazar',
            'email'=>'digitaltempo@gmail.com',
        ]);
        DB::table('branches')->insert([
            'enterprise_id' => 1,
            'user_id' => 3,
            'name' => 'Cumbaya',
        ]);
        DB::table('departments')->insert([
            'branche_id' => 1,
            'user_id' => 4,
            'name' => 'Seguridad',
        ]);
        //Calendar
        DB::table('calendars')->insert([
            'day' => 'monday',
            'time_in' => '08:30',
            'time_out' => '17:30',
        ]);
        DB::table('calendars')->insert([
            'day' => 'tuesday',
            'time_in' => '08:30',
            'time_out' => '17:30',
        ]);
        DB::table('calendars')->insert([
            'day' => 'wednesday',
            'time_in' => '08:30',
            'time_out' => '17:30',
        ]);
        DB::table('calendars')->insert([
            'day' => 'thursday',
            'time_in' => '08:30',
            'time_out' => '17:30',
        ]);
        DB::table('calendars')->insert([
            'day' => 'friday',
            'time_in' => '08:30',
            'time_out' => '17:30',
        ]);
        DB::table('calendars')->insert([
            'day' => 'saturday',
            'time_in' => '08:30',
            'time_out' => '17:30',
        ]);
        DB::table('calendars')->insert([
            'day' => 'sunday',
            'time_in' => '08:30',
            'time_out' => '17:30',
        ]);
    }
}
