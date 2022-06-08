<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('123123123'),
                'created_at' => now(),
                'updated_at' => now(),
                'email_verified_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'test',
                'email' => 'test@gmail.com',
                'password' => bcrypt('123123123'),
                'created_at' => now(),
                'updated_at' => now(),
                'email_verified_at' => now(),
            ],
        ]);
    }
}
