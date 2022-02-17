<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert([
            'name' => 'Новый',
            'type' => 1
        ]);

        DB::table('statuses')->insert([
            'name' => 'В работе',
            'type' => 1
        ]);

        DB::table('statuses')->insert([
            'name' => 'Завершен',
            'type' => 1
        ]);

        DB::table('statuses')->insert([
            'name' => 'Новый',
            'type' => 3
        ]);

        DB::table('statuses')->insert([
            'name' => 'В работе',
            'type' => 3
        ]);

        DB::table('statuses')->insert([
            'name' => 'Завершен',
            'type' => 3
        ]);

        DB::table('statuses')->insert([
            'name' => 'Завершен',
            'type' => 2
        ]);

        DB::table('statuses')->insert([
            'name' => 'Завершен',
            'type' => 2
        ]);

        DB::table('statuses')->insert([
            'name' => 'Завершен',
            'type' => 2
        ]);
    }
}
