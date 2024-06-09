<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //$users = factory(App\User::class, 3)->make();

          DB::table('users')->insert
          ([
            'name' => "admin",
            'email' => "admin@reactgame.com",
            'password' => "$2y$10$1xOD5Qn0vjnZBjD0poEAbu7eCQ6dgXIVMO6clT88L1.PJkylTDjwS",
            'gender' => "ferfi",
            'birthday' => Carbon::now(),
            'avatar' => "https://pbs.twimg.com/profile_images/821849411991044096/lQFa_Vly_400x400.jpg"
        ]);

            DB::table('users')->insert
          ([
            'name' => "Ferenc",
            'email' => "ferenc@reactgame.com",
            'password' => "$2y$10$1xOD5Qn0vjnZBjD0poEAbu7eCQ6dgXIVMO6clT88L1.PJkylTDjwS",
            'gender' => "ferfi",
            'birthday' => Carbon::now(),
            'avatar' => "https://cdn.nwmgroups.hu/s/img/i/1209/20120927-kiegyezes-i-ferenc-jozsef-magyar-kiraly4.jpg"
        ]);

    }
}
