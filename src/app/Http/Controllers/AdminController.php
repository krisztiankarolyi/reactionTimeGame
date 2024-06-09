<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Business\UserBusiness;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Record;
use App\Models\Report;
use App\Models\Friendship;
use App\Models\Game;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Artisan;
use Illuminate\Database\Seeder;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{

    public function login(Request $request) 
    {            
        if(Hash::check( $request->psw, env("ADMIN_PSW") ) && $request->uname == "admin")
        {
            Session::put('valid', true);
            return redirect()->route('showpanel');
        }
        else
        {
            $msg = ["Hibás név vagy jelszó!"];
            return view('admin.login')->withErrors($msg);
        }
    }

    public function exit(Request $request)
    {
        Session::forget('valid');
        return redirect('controlpanel');
    }

    public function showpanel(Request $request)
    {
        if( Session::get('valid') == true)
        {
                        if(Auth::check()) Auth::logout();
            if(Schema::hasTable('reports')) $reports = Report::all(); else  $reports = [];
            if(Schema::hasTable('users')) $users = User::all(); else $users = [];
            return view('admin.controlpanel', ['reports'=>$reports, 'users'=>$users]);

        }
        else
        {
             $msg = ["Jelentkezz be!"];
             return view('admin.login')->withErrors($msg);
        }

    }

      public function delgame(Request $request)
    {
        $msg = [];
        if($request->password == "v8w8He3NsKEsC8q6")
        {
            $game = Game::find($request->game);
            $records = Record::where('gameid')->delete();
          //unlink('views/games/'. $game->name . '.blade.php');
             if($game->delete())
                array_push($msg, $game->name." sikeresen törölve!");
             else
                array_push($msg, "Törlés sikertelen!");
        }
        else 
        {
            array_push($msg, "Helytelen jelszó");
        }
        return redirect('controlpanel')->withErrors($msg);
    }

      public function addgame(Request $request)
    {
        $msg = [];      
        if($request->password == "v8w8He3NsKEsC8q6")
        {
            $game = new Game();
            $game->name = $request->name;
            $game->description = $request->desc;
            $game->timestamps = false;
            if($game->save()) 
            {
                array_push($msg, "A játék sikeresen létrehozva!");
                fopen( resource_path( 'views/games/'. $request->name . '.blade.php' ), 'w' );
            }

            else array_push($msg, "Nem sikerült a játék mentése!");
        }
        else 
        {
            array_push($msg, "Helytelen jelszó");
        }
        return redirect('controlpanel')->withErrors($msg);
    }

     public function dboperation(Request $request)
    {
    	$msg = [];
    	if($request->password == "v8w8He3NsKEsC8q6")
    	{
    		try 
            {        
             
                Auth::logout();
                Artisan::call('migrate:reset', ['--force'  => true]);
                array_push($msg, "Tisztítás indítása...");
                array_push ($msg, "[DONE]---A DB táblái törölve!");
                                array_push($msg, "Migráció indítása..."); 
                Artisan::call('migrate', ['--force'  => true]);
                array_push($msg, "[DONE]---Seeder futtatása..."); 
                Artisan::call('db:seed', [ '--force' => true]);
                array_push($msg, "[DONE]---A DB használatra kész!");                            
            }
            catch(Exception $ja)
            {
                array_push($msg, $ja);
            }
    	}
    	else
    	{
            array_push($msg, "Helytelen jelszó!");
    		Artisan::call('migrate', array('--path' => 'app/migrations', '--force' => true));
    	}
    	return redirect('controlpanel')->withErrors($msg);
    }
    
    public function ban(Request $request)
    {
        $msg = [];
        if($request->password == "v8w8He3NsKEsC8q6")
        {
            $user = User::find($request->player);
            $user->block();
            array_push($msg, "A játékos blokkolva!" );
           
        }
        else array_push($msg, "Helytelen jelszó!");

        return redirect('controlpanel')->withErrors($msg);
    }

    public function unblock(Request $request)
    {
        $msg = [];
        if($request->password == "v8w8He3NsKEsC8q6")
        {
            $user = User::find($request->player);
            $user->unblock();
            array_push($msg, "A játékos feloldva!" );
           
        }
        else array_push($msg, "Helytelen jelszó!");

        return redirect('controlpanel')->withErrors($msg);
    }
}

    
