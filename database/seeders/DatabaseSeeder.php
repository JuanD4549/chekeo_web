<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(TestSeeder::class);
        //$this->call(RoleSeeder::class);
        //$this->call(PermissionSeeder::class);
        // DB::table('model_has_roles')->insert([
        //     'role_id' => 1,
        //     'model_type' => 'App\Models\User',
        //     'model_id' => 1,
        // ]);
    }
}
