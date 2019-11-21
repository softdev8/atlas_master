<?php

use Illuminate\Database\Seeder;

class CompanySeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Company::class, 5)->create();
    }
}
