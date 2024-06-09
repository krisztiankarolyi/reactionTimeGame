<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Record;
use App\Models\Game;

class GameController extends Controller
{
    public function showgame(Request $request, $game)
    {
        if(Auth::check())
        {

            $id = Game::where('name', $game)->first();
             return view ("games.".$game, ['id' => $id->id]);
        }
        else
           view("auth.login");
    }

      public function games(Request $request)
    {
        $games = Game::all();
    	if(Auth::check())
    	   return view('games.games', ['games' => $games ]);

    	else
    	   view("auth.login");
    }

    public function newRecord(Request $request, User $user, Game $game)
    {
    	$errors = [];
    	if($request->score != null)
    	{
	    	$timestamps = false;  
	    	$record = new Record();
	    	$user = Auth::user();
	    	$record->userid = $user->id;
            $game = Game::find($request->gameid);
	    	$record->gameid = $request->gameid; 
	    	$record->score = $request->score;
	    	$record->date = Carbon::now();
            if(is_numeric($record->score) && $record->score > 100)
            {
                if($record->save())
                {
                 array_push($errors, "Sikeres mentés! :)");
                }
                else 
                {
                 array_push($errors, "Valami hiba történt, próbáld újra később, vagy vedd fel a <a href='#'>kapcsolatot</a> a fejlesztővel!");
                }
            }
	    	
    	}  	
    	else  array_push($errors, "Még nincs eredményed!");

    	return redirect()->route('showgame', $game->name)->withErrors($errors);
    }
}
