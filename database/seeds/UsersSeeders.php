<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UsersSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = [
            [
                'name'              => 'administrator',
                'email'             => 'administrator@gmail.com',
                'password'          => $password = bcrypt('administrator'),
                'remember_token'    => str_random(10),
                'role_id'           => 5,
                'csv'               => true,
                'status'            => 1,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ],
        ];

        DB::table('users')->insert($users);
        //factory(User::class, 50)->create();
    }
}
