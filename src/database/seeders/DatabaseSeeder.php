<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Database\factories\UserFactory;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
          
            $this->call(UserSeeder::class);
            $this->call(GameSeeder::class);
            // \App\Models\User::factory(10)->create();

    }
}
