<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;

class LoanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('loans')->insert([
            "amount" => 8.50,
            "firstName" => "Rob",
            "title" => "Kabel TV",
            "createdAt" => Carbon::now('Europe/Amsterdam'),

            "lastName" => "van Dijk",
            "phoneNumber" => "06123123123",  
            
            "user_id" => 1,
        ]);
        DB::table('loans')->insert([
            "amount" => 9.99,
            "firstName" => "Rob",
            "title" => "Kabel TV",
            "createdAt" => Carbon::now('Europe/Amsterdam'),

            "lastName" => "van Dijk",
            "phoneNumber" => "06123123123",  

            "user_id" => 1,
        ]);
        DB::table('loans')->insert([
            "amount" => 91.99,
            "firstName" => "Rob",
            "title" => "Kabel TV",
            "createdAt" => Carbon::now('Europe/Amsterdam'),

            "lastName" => "van Dijk",
            "phoneNumber" => "06123123123",  
            "payedOn" => Carbon::yesterday(),
            "user_id" => 1
        ]);
    }
}
