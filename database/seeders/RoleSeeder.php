<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            'name' => 'admin_user',
            'guard_name' => 'web',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('roles')->insert([
            'name' => 'guard_user',
            'guard_name' => 'web',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
