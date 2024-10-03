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
            'ruc' => '123456789',
            'cellphone' => '0978657557',
            'address' => 'Quito',
            'legal_representative' => 'Jorge Salazar',
            'email' => 'digitaltempo@gmail.com',
        ]);
        
        //1
        DB::table('branches')->insert([
            'enterprise_id' => 1,
            'employee_id' => 3,
            'name' => 'Digital Cumbaya',
        ]);
        //2
        DB::table('branches')->insert([
            'enterprise_id' => 1,
            'employee_id' => 4,
            'name' => 'Digital Centro',
        ]);
        //1
        DB::table('departments')->insert([
            'branche_id' => 1,
            'employee_id' => 4,
            'name' => 'Seguridad',
        ]);
        //2
        DB::table('departments')->insert([
            'branche_id' => 1,
            'employee_id' => 4,
            'name' => 'Mensajeria',
        ]);
        //Places

        DB::table('places')->insert([
            'branche_id'=>1,
            'name'=>'Puesta Principal',
            'type'=>'false',
        ]);
        DB::table('places')->insert([
            'branche_id'=>1,
            'name'=>'Puesta Secundaria',
            'type'=>'false',
        ]);
        //Calendar
        //1
        DB::table('calendars')->insert([
            'name' => 'Calendar',
            'monday' => json_encode([
                'time_in' => '08:30',
                'time_out' => '17:30'
            ]),
            'tuesday' => json_encode([
                'time_in' => '08:30',
                'time_out' => '17:30'
            ]),
            'wednesday' => json_encode([
                'time_in' => '08:30',
                'time_out' => '17:30'
            ]),
            'thursday' => json_encode([
                'time_in' => '08:30',
                'time_out' => '17:30'
            ]),
            'friday' => json_encode([
                'time_in' => '08:30',
                'time_out' => '17:30'
            ]),
            'saturday' => json_encode([
                'time_in' => '08:30',
                'time_out' => '17:30'
            ]),
            'sunday' => json_encode([
                'time_in' => '08:30',
                'time_out' => '17:30'
            ]),

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
