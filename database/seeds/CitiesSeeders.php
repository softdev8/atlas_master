<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CitiesSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = [
            [
                'title'         => 'London',
                'country_id'    => 1,
                'region_id'     => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Bristol',
                'country_id'    => 1,
                'region_id'     => 2,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Manchester',
                'country_id'    => 1,
                'region_id'     => 9,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Houston',
                'country_id'    => 2,
                'region_id'     => 15,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
        ];

        DB::table('cities')->insert($cities);
    }
}
