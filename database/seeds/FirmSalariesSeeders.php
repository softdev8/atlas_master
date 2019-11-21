<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FirmSalariesSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $salaries = [
            [
                'firm_id'       => 1,
                'pqe'           => 'NQ',
                'min'           => 10000,
                'max'           => 20000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'firm_id'       => 1,
                'pqe'           => '1',
                'min'           => 20000,
                'max'           => 30000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'firm_id'       => 1,
                'pqe'           => '2',
                'min'           => 30000,
                'max'           => 40000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'firm_id'       => 1,
                'pqe'           => '3',
                'min'           => 40000,
                'max'           => 50000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],

            [
                'firm_id'       => 2,
                'pqe'           => 'NQ',
                'min'           => 10000,
                'max'           => 20000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'firm_id'       => 2,
                'pqe'           => '1',
                'min'           => 20000,
                'max'           => 30000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'firm_id'       => 2,
                'pqe'           => '2',
                'min'           => 30000,
                'max'           => 40000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'firm_id'       => 2,
                'pqe'           => '3',
                'min'           => 40000,
                'max'           => 50000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],


            [
                'firm_id'       => 3,
                'pqe'           => 'NQ',
                'min'           => 10000,
                'max'           => 20000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'firm_id'       => 3,
                'pqe'           => '1',
                'min'           => 20000,
                'max'           => 35000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'firm_id'       => 3,
                'pqe'           => '2',
                'min'           => 35000,
                'max'           => 45000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'firm_id'       => 3,
                'pqe'           => '3',
                'min'           => 50000,
                'max'           => 60000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
        ];

        DB::table('firm_salaries')->insert($salaries);
    }
}
