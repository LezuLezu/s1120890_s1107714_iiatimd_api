<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            "name" => "Zoë van Dijk",
            "email" => "s1107714@student.hsleiden.nl",
            "password" => bcrypt("123"),
        ]);
    }
}
