<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::Table('users')->insert([
            'name' => 'Admin',
            'email' => 'gnak1@gmail.com',
            'password' => bcrypt('password'),
        ]);
    }
}
