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
        DB::table('enterprises')->insert([
            'name' => 'DigitalTempo',
            'ruc'=>'123456789',
            'cellphone'=>'0978657557',
            'address'=>'Quito',
            'legal_representative'=>'Jorge Salazar',
            'email'=>'digitaltempo@gmail.com',
        ]);
        //3
        DB::table('users')->insert([
            'name' => 'Roberto',
            'charge' => 'Boos',
            'ci' => '1234567789',
            'enterpriser_phone' => '0978657557',
            'email' => 'Roberto@gmail.com',
            'password' => Hash::make('digitaltempo2023%'),
        ]);
        //4
        DB::table('users')->insert([
            'name' => 'Luis',
            'charge' => 'Admin',
            'ci' => '12344567789',
            'enterpriser_phone' => '0978657557',
            'email' => 'Luis@gmail.com',
            'password' => Hash::make('digitaltempo2023%'),
        ]);
        //5
        DB::table('users')->insert([
            'name' => 'Jose',
            'charge' => 'Boss',
            'ci' => '123445ew67789',
            'enterpriser_phone' => '0978657557',
            'email' => 'jose@gmail.com',
            'password' => Hash::make('digitaltempo2023%'),
        ]);
        //6
        DB::table('users')->insert([
            'name' => 'Melany',
            'charge' => 'Admin',
            'ci' => '122344567789',
            'enterpriser_phone' => '0978657557',
            'email' => 'melany@gmail.com',
            'password' => Hash::make('digitaltempo2023%'),
        ]);
        //7
        DB::table('users')->insert([
            'name' => 'Julio',
            'charge' => 'Employee',
            'ci' => '1223424567789',
            'enterpriser_phone' => '0978657557',
            'email' => 'julio@gmail.com',
            'password' => Hash::make('digitaltempo2023%'),
        ]);
        //8
        DB::table('users')->insert([
            'name' => 'Pedro',
            'charge' => 'Employee',
            'ci' => '1223494567789',
            'enterpriser_phone' => '0978657557',
            'email' => 'pedro@gmail.com',
            'password' => Hash::make('digitaltempo2023%'),
        ]);
        //1
        DB::table('branches')->insert([
            'enterprise_id' => 1,
            'user_id' => 3,
            'name' => 'Digital Cumbaya',
        ]);
        //2
        DB::table('branches')->insert([
            'enterprise_id' => 1,
            'user_id' => 4,
            'name' => 'Digital Centro',
        ]);
        //1
        DB::table('departments')->insert([
            'branche_id' => 1,
            'user_id' => 4,
            'name' => 'Seguridad',
        ]);
        //2
        DB::table('departments')->insert([
            'branche_id' => 1,
            'user_id' => 4,
            'name' => 'Mensajeria',
        ]);
        //Calendar
        //1
        DB::table('calendars')->insert([
            'day' => 'monday',
            'time_in' => '08:30',
            'time_out' => '17:30',
        ]);
        //2
        DB::table('calendars')->insert([
            'day' => 'tuesday',
            'time_in' => '08:30',
            'time_out' => '17:30',
        ]);
        //3
        DB::table('calendars')->insert([
            'day' => 'wednesday',
            'time_in' => '08:30',
            'time_out' => '17:30',
        ]);
        //4
        DB::table('calendars')->insert([
            'day' => 'thursday',
            'time_in' => '08:30',
            'time_out' => '17:30',
        ]);
        //5
        DB::table('calendars')->insert([
            'day' => 'friday',
            'time_in' => '08:30',
            'time_out' => '17:30',
        ]);
        //6
        DB::table('calendars')->insert([
            'day' => 'saturday',
            'time_in' => '08:30',
            'time_out' => '17:30',
        ]);
        //7
        DB::table('calendars')->insert([
            'day' => 'sunday',
            'time_in' => '08:30',
            'time_out' => '17:30',
        ]);
        //
        DB::table('branche_calendar')->insert([
            'calendar_id' => 1,
            'branche_id' => 1,
        ]);
        // DB::table('user')->where('id', 3)->update([
        //     'branche_id' => 1
        // ]);
        // DB::table('user')->where('id', 7)->update([
        //     'branche_id' => 1
        // ]);
        // DB::table('user')->where('id', 8)->update([
        //     'branche_id' => 1
        // ]);
    }
}
