<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FirmLocationsSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $locations = [
            [
                'firm_id'       => 1, /* Taylor Wessing */
                'country_id'    => 1,
                'region_id'     => 1,
                'city_id'       => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'firm_id'       => 2, /* Freshfields Bruckhaus Deringer */
                'country_id'    => 1,
                'region_id'     => 1,
                'city_id'       => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'firm_id'       => 3, /* Lewis Silkin */
                'country_id'    => 1,
                'region_id'     => 1,
                'city_id'       => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'firm_id'       => 4, /* HFW */
                'country_id'    => 1,
                'region_id'     => 1,
                'city_id'       => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'firm_id'       => 4, /* HFW */
                'country_id'    => 2,
                'region_id'     => 15,
                'city_id'       => 4,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'firm_id'       => 5, /* Eversheds Sutherland */
                'country_id'    => 1,
                'region_id'     => 9,
                'city_id'       => 3,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'firm_id'       => 6, /* Fieldfisher */
                'country_id'    => 1,
                'region_id'     => 1,
                'city_id'       => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'firm_id'       => 7, /* CMS */
                'country_id'    => 1,
                'region_id'     => 1,
                'city_id'       => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'firm_id'       => 7, /* CMS */
                'country_id'    => 1,
                'region_id'     => 2,
                'city_id'       => 2,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],

            [
                'firm_id'       => 8, /* Bryan Cave Leighton Paisner */
                'country_id'    => 1,
                'region_id'     => 1,
                'city_id'       => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'firm_id'       => 9, /* Hogan Lovells */
                'country_id'    => 1,
                'region_id'     => 1,
                'city_id'       => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
        ];

        DB::table('firm_locations')->insert($locations);
    }
}
