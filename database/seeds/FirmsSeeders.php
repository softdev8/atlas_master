<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class FirmsSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $firms = [
            [
                'title'         => 'Taylor Wessing',
                'type'          => 1,
                'ranking'       => 6,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Freshfields Bruckhaus Deringer',
                'type'          => 1,
                'ranking'       => 6,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Lewis Silkin',
                'type'          => 1,
                'ranking'       => 7,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'HFW',
                'type'          => 1,
                'ranking'       => 6,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Eversheds Sutherland',
                'type'          => 1,
                'ranking'       => 7,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Fieldfisher',
                'type'          => 1,
                'ranking'       => 8,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'CMS',
                'type'          => 1,
                'ranking'       => 8,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Bryan Cave Leighton Paisner',
                'type'          => 2,
                'ranking'       => 8,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Hogan Lovells',
                'type'          => 2,
                'ranking'       => 7,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
        ];

        DB::table('firms')->insert($firms);
    }
}
