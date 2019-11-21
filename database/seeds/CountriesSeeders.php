<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CountriesSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $countries = [
            [
                'title'         => 'United Kingdom',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'United States',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
        ];

        DB::table('countries')->insert($countries);
    }
}
