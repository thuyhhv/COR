<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            ['name' => 'review', 'slug' => 'review_product'],
            ['name' => 'update', 'slug' => 'update_product'],
            ['name' => 'delete', 'slug' => 'delete_product'],
            ['name' => 'restore', 'slug' => 'restore_product'],
        ]);
    }
}
