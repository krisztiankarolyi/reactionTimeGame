<?php  

namespace App\Business;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use \App\Models\User;
use \App\Models\Record;
use \App\Models\Game;
use \App\Models\Friendship;
use Illuminate\Support\Facades\DB;

class UserBusiness extends BaseBusiness
{
	public function auth(Request $request)
	{
		$msg = [];
		if(Auth::attempt($request->only("email", "password")))
		{
        $user = User::where('email', $request->email)->first();
            if($user->blocked) 
                return redirect()->route('login')->withErrors($msg);
            else 
            {
			 Auth::user();
			 return (new UserController())->index();
            }
		}
		else 
		{
		  return redirect()->intended('login')->withErrors("Helytelen email vagy jelszó!");
		} 
	}

	public function register(Request $request)
	{
		$ip_addresses = [];
		$daily_registers = 0;
		$error = false;
        $messages = [];
        if($request->password != $request->password2)
        {
        	array_push($messages, "A két jelszó nem egyezik!");  
        	return view('auth.register')->withErrors($messages);
        }
        else 
        {	
        	$user = new User;
	        $user->name = $request->name;
	        $user->email = $request->email;
	        $user->password = bcrypt($request->password);
	        $user->birthday = $request->birthday;
	        $user->gender = $request->gender; 
	        $user->timestamps = false;
	        $user->avatar = "https://cdn.icon-icons.com/icons2/1378/PNG/512/avatardefault_92824.png";

	        if (User::where('email', $request->email)->first()) 
	        {
	   			array_push($messages, "Az email már foglalt!");  
	        	return view('auth.register')->withErrors($messages);
			}

			else 
			{
				foreach($ip_addresses as $ip)
				{
					if($ip == $request->ip())
						$daily_registers++;
				}

				if($daily_registers<= 3)
				{
		       		$error = !$user->save();
		          	if(!$error)
		          	{	
		          		array_push($ip_addresses, $request->ip());  
		        		array_push($messages, "Sikeres regisztráció, kérlek lépj be!");  	        		
		        		return view('auth.login')->withErrors($messages);
		        	}		
			        else 
			        {
			            array_push($messages, "Sikertelen regisztráció! :-(");    
			        }
			    }

			    else
			    {
			    	array_push($messages, "Ma már meghaladta a napi 3 regisztrációt!");  
			    	return view('auth.login')->withErrors($messages);  
			    }
   			 }
    	}
	}

	public function registerForm(User $user)
	{	
		if(Auth::check())
		{
		  Auth::logout();
		  $messages = [];
		  return view("auth.register", ["error"=>$messages]);	
		}

	    else
	    {
		  $messages = [];
		  return view("auth.register", ["error"=>$messages]);	
		}
	}

	
 public function userUpdate(Request $request)
{

        $user = User::find(Auth::user()->id);       
        $messages = [];
        $user->name = $request->name;

        if (User::where('email', $request->email)->first() && $user->email != $request->email) 
	    {
	   		array_push($messages, "Az email már foglalt!");  
	        return redirect()->route('editprofile')->withErrors($messages);
		}
		else
        {
            $user->email = $request->email;
            $user->avatar = $request->avatar;  

   		    if ($request->newpsw == $request->newpsw2)
   		    {
    	        if($request->newpsw != "" ) 
    	        {
    	          $user->password = bcrypt($request->newpsw);
    	          array_push($messages, "A jelszó megváltozott!");
    	        }
               $error = !$user->save();

                if(!$error)
                {
                	array_push($messages, "Sikeres mentés!");
                }
                else
                {
                	array_push($messages, "Sikertelen mentés!");
                }
             }

            else 
            {
             	array_push($messages, "Sikertelen mentés!");
              	array_push($messages, "nem egyezik a két jelszó!");
            }

       return redirect()->route('editprofile')->withErrors($messages);
       
        }
    }

    public function unfriend(Request $request)
    {
    	$messages = [];
        if(Auth::check())
        {
        	$user = Auth::user();
        	$tounfriend = $request->friendid;
        	$todeluser = User::find($tounfriend);
        	$todelete = Friendship::where([
        		'first_user' => $user->id,
        		'second_user' => $tounfriend,
        	])->orWhere([
        		'second_user' => $user->id,
        		'first_user' => $tounfriend,
        	])->first();

            if($request->id != null)
                $todelete = Friendship::find($request->id);

        	if($todelete != null)
        	{    
              //array_push($messages, $todeluser->name." Már nem a barátod!");    
        	  $todelete->delete();   	  
       		}
       		else array_push($messages, "Hiba történt!");

        	return redirect('friends')->withErrors($messages);

        }
    }

    public function addfriend(Request $request)
    {
    	$acteduser = Auth::user();
    	$user2 = User::find($request->userid);
    	$messages = [];
    	$friendship = new Friendship;
    	$friendship->first_user = $acteduser->id;
    	$friendship->acted_user = $acteduser->id;
    	$friendship->second_user = $user2->id;
    	$friendship->status = "pending";
        //check if the friendship aldready exists
    	$test = Friendship::where('first_user', '=', $friendship->first_user)->
    						where('second_user', '=',$friendship->second_user)->first();
    	$test2 = Friendship::where('first_user', '=', $friendship->second_user)->
    						where('second_user', '=',$friendship->first_user)->first();
    	
    	if($test == null && $test2 == null) $friendship->save();
    	array_push($messages, $user2->name." be lett jelölve!");
    	
    	return redirect('friends')->withErrors($messages);
    }

     public function acceptfriend(Request $request)
    {
    	$messages = [];
    	$friendship = Friendship::find($request->id);
    	$friendship->status = "confirmed";
    	$friendship->save();  	

    	/*$friendship2 = new Friendship;  //a barátság kétirányú mentése egyelőre felesleges, mindkét irányból megkapja a user->friend függvény
    	$friendship2->first_user = $friendship->second_user;
    	$friendship2->second = $friendship->first_user;
    	$friendship2->acteduser = $friendship->acteduser;
    	$friendship2->status = "confirmed";
    	$friendship2->save();
    	*/

    	return redirect('friends')->withErrors($messages);
    }

    public function declinefriend(Request $request)
    {
    	$messages = [];
    	$friendship = Friendship::find($request->id);
        if($friendship->status == 'pending')
    	   $friendship->delete();    	
    	return redirect('friends')->withErrors($messages);
    }

    public function ranking(Request $request)
    {
       if($request->game != null) $selectedgame = $request->game;
       else $selectedgame = 1; 

       $selectedgame = +$selectedgame;
       $game = Game::find($selectedgame)->name;
        $games = Game::all();
    	$user = Auth::user();
    	$all = Record::select('userid')
		->addSelect(Record::raw('min(score) as ja'))
		->from('records')
        ->where('gameid', $selectedgame)
		->groupBy('userid')
		->orderBy('ja')
		->get();
		$tosend = [];
        $friendship = [];

        foreach($all as $rec)   
                    // check if the user of the record is friend of logged in user, only the friends' records will count on ranking
        {   
        $friendships = Friendship::all();  
            foreach($friendships as $friendship)
            {
                if($friendship->checkboth() == 0)
                {
                   if(($rec->userid == $friendship->first_user && 
                    $user->id == $friendship->second_user )||
                     ($rec->userid == $friendship->second_user && 
                    $user->id == $friendship->first_user ))
                    {
                        if($friendship->status == "confirmed")
                         array_push($tosend, $rec);
                    } 
                }       
            }
            if($rec->userid == $user->id) array_push($tosend, $rec);
        }

		return view("User.ranking", ["records"=>$tosend, "games"=>$games, "selectedgame" => $game]);	
    }
    public function getProfile(Request $request, $id)
    {
        try
        {
         $user = User::find($id);
         if($user != null)
         {
             return view("User.uprofile", ['user' => $user]);
         }
         else echo "nem található a játékos";
             
        }
        catch(Exception $e)
        {
            echo "nem található a játékos";
        }

          
    }
}