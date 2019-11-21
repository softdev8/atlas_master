<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FilterTypesSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $criterias = [
            /* type */
            [
                'title'         => 'Top',
                'flag'          => 'type',
                'min'           => null,
                'max'           => null,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'US',
                'flag'          => 'type',
                'min'           => null,
                'max'           => null,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Legal 500',
                'flag'          => 'type',
                'min'           => null,
                'max'           => null,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'In-House',
                'flag'          => 'type',
                'min'           => null,
                'max'           => null,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Other',
                'flag'          => 'type',
                'min'           => null,
                'max'           => null,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            /* ranking */
            [
                'title'         => '1-20',
                'flag'          => 'rank',
                'min'           => 1,
                'max'           => 20,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => '21-50',
                'flag'          => 'rank',
                'min'           => 21,
                'max'           => 50,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => '51-100',
                'flag'          => 'rank',
                'min'           => 51,
                'max'           => 100,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => '101-200',
                'flag'          => 'rank',
                'min'           => 101,
                'max'           => 200,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
        ];

        DB::table('filter_types')->insert($criterias);
    }
}
