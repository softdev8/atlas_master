<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesSeeders::class);
        $this->call(CompanySeeders::class);
        $this->call(FilterPqeSeeders::class);
        $this->call(FilterTypesSeeders::class);
        $this->call(FirmsSeeders::class);
        $this->call(FirmSalariesSeeders::class);
        $this->call(CountriesSeeders::class);
        $this->call(RegionsSeeders::class);
        $this->call(CitiesSeeders::class);
        $this->call(UsersSeeders::class);
        $this->call(AreasSeeders::class);
        $this->call(SpecialismSeeders::class);
        $this->call(SubSpecSeeders::class);
        $this->call(FirmLocationsSeeders::class);
    }
}
