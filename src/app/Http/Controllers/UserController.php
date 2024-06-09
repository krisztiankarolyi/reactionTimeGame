<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Business\UserBusiness;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Record;
use App\Models\Friendship;
use App\Models\Game;
use App\Models\Report;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


class UserController extends Controller
{
    public function index()
    {
    	 if (Auth::check())
       {
         $user = Auth::user();
         $all = Record::orderBy('date', 'desc')->skip(0)->take(10)->get();
         $tosend = [];
         $friendship = [];
          $friendships = Friendship::all();  
          foreach($all as $rec) 
          // check if the user of the record is friend of logged in user, only the friends' records will count on ranking
          {               
              foreach($friendships as $friendship)
              {
                  if(($rec->userid == $friendship->first_user && 
                      $user->id == $friendship->second_user )||
                       ($rec->userid == $friendship->second_user && 
                      $user->id == $friendship->first_user ))
                      {
                          if($friendship->status == "confirmed" && $friendship->checkboth() == 0) array_push($tosend, $rec);
                      }
              }
              if($rec->userid == $user->id) array_push($tosend, $rec);
          }
        return view("welcome", ['recents' => $tosend]);
       }
        
       else
        return view("index");
    }


     public function home()
    {
        if (Auth::check())
          return view("welcome");

        else
         return view("index");
    }

    public function login()
    {
      if (Auth::check()) 
        {       
          return view("index"); 
        }

      else return 
        view("auth.login");
    }

    public function auth(Request $request)
    {
    	return (new UserBusiness())->auth($request);
    }
     public function userUpdate(Request $request)
    {
        return (new UserBusiness())->userUpdate($request);
    }
      public function write($results)
    {
      $content = "játék;idő(ms);dátum\n";  
      foreach($results as $result)
      {
        $content = $content.$result->game->name.";".$result->score.";".$result->date."\n";  
      }

     Storage::disk('public')->put($this->clean(Auth::user()->name).'_results.csv', "\xEF\xBB\xBF" . $content);
      
    }

    function clean($string)
    {
     $string = str_replace(' ', '-', $string); 
       return strtr($string,'áàáâãäçèéêëìíîïñòóőôõöùúûüýÿÀÁÁÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓŐÔÕÖÙÚÛÜÝ','aaaaaaceeeeiiiinoooooouuuuyyAAAAAAACEEEEIIIINOOOOOOUUUUY');
    }

    public function logout()
    {
      
    	Auth::logout();
    	return redirect()->route('login');

    }

    public function registerForm(User $user)
    {
      return (new \App\Business\UserBusiness())->registerForm($user);
    }

    public function register(Request $request)
    {
        return (new \App\Business\UserBusiness())->register($request);
    }

    public function editprofile(Request $Request)
    {
        if(Auth::check())
        {
            return view ("User.profile");
        }
        else return redirect()->route('login');
    }

     public function friendspage(Request $request)
    {
        if(Auth::check())
        {
            $user = Auth::user();
            $friends = $user->friends->where('blocked', '0');
            $requests = [];

            $requests = Friendship::where('second_user', $user->id)->where('status', 'pending')->get();

            $sent = Friendship::where('first_user', $user->id)->where('status', 'pending')->get();

            if($request->text != null)
            {
                $users = User::where('name', trim($request->text))->orWhere('email',trim($request->text))->where('blocked', '0')->get();
                
                return view('User.friends')->with(['friends'=>$friends,'users'=>$users,'pendings'=> $requests, 'sent'=>$sent]);
            }
            else 
            {
                $users = [];            
                return view('User.friends')->with(['friends'=>$friends,'users'=>$users,
                    'pendings'=> $requests, 'sent'=>$sent ]);
            }
        }
        else  
          return redirect()->route('login');
    }

    public function showres (Request $request)
    {
        if(Auth::check())
        {
          if($request->orderby != null && $request->selectedgame != null) //ha van beállított szűrő
          {
             $orderby = explode(";", $request->orderby);
             $selectedgame = $request->selectedgame;   

             if($selectedgame!="all")
               $results = Record::where('userid', Auth::user()->id)->where('gameid', $selectedgame)->orderby($orderby[1], $orderby[0])->get();        
            else 
                $results = Record::where('userid', Auth::user()->id)->orderby($orderby[1], $orderby[0])->get();     
             $games = Game::all();
             $best = Record::where('userid', Auth::user()->id)->min('score');
              $this->write($results);
              $url = Storage::url(Auth::User()->name.'_results.csv');
            return view('User.results', ['games' => $games], ['results' => $results, 'url' => $url]);
          
          }   
          else //ha nincs szűrő vagy először nyílik meg az oldal
          {

            $orderby = ['date', 'asc'];
            $results = Record::where('userid', Auth::user()->id)->orderby($orderby[0], $orderby[1])->get();
            $games = Game::all();
            $best = "ja";
             $this->write($results);
             $url = Storage::url(Auth::User()->name.'_results.csv');
             return view('User.results', ['games' => $games], ['results' => $results, 'url' => $url]);
             
          }  
         

        }
        else
        {
           return redirect()->route('login');
        }
  

    }


    public function unfriend(Request $request)
    {
         return (new UserBusiness())->unfriend($request);
    }

    public function addfriend(Request $request)
    {
         return (new UserBusiness())->addfriend($request);
    }

     public function acceptfriend(Request $request)
    {
         return (new UserBusiness())->acceptfriend($request);
    }

     public function declinefriend(Request $request)
    {
         return (new UserBusiness())->declinefriend($request);
    }
    
     public function ranking(Request $request)
    {
         return (new UserBusiness())->ranking($request);
    }
     public function contact(Request $request)
    {
         return view('User.contact');
    }
    public function getProfile(Request $request, $id)
    {
         $user = User::find($id);
         if($id != Auth::user()->id && ($user != null && $user->blocked == 0))
         return (new UserBusiness())->getProfile($request, $id);   
         else return redirect('/');    
    }
    public function Report(Request $request)
    {
        if(Auth::check())
        {
          $msg = [];
          $report = new Report();
          $report->reporterid = $request->reporterid;
          $report->reportedid = $request->reportedid;
          $report->details = $request->details;
          $user = User::find($request->reportedid);
          $user->reports = $user->reports + 1;
          $user->save();
          if($report->save()) array_push($msg, "A bejelentésed elküldtük!");
          else array_push($msg, "A bejelentésed nem sikerült elküldeni!");

          return \Redirect::back()->withErrors($msg);
        }
    }
    

} 
 