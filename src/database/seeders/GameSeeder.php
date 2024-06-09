<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
           DB::table('games')->insert([
            'name' => "greenlight",
            'description' => "Ebben a játékban meg kell várnod, amíg a kijelző színe pirosról zöldre vált, és minél előbb meg kell nyomnod egy gombot. Próbáld ki!"
        ]);
            DB::table('games')->insert([
            'name' => "colormatch",
            'description' => "Ebben a játékban meg kell várnod, amíg a háttér színe és a benne lévő megegyező lesz. Próbáld ki!"
        ]);
              DB::table('games')->insert([
            'name' => "colormatch_hard",
            'description' => "Ebben a játékban meg kell várnod, amíg a háttér színe és a benne lévő megegyező lesz. Ez a nehezebb verzió, ugyanis a szöveg és a háttér is mindig változik. Próbáld ki!"
        ]);
                DB::table('games')->insert([
            'name' => "shapematch",
            'description' => "Ebben a játékban akkor kell kattintanod, ha a két alakzat megegyezik"
        ]);
    }
}
