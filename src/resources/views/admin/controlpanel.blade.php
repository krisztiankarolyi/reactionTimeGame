 @extends('index')
 @section('content')
 <a href="{{route('exit')}}">KILÉPÉS</a>
 			<div  class="bg-danger">
 				<p class="text-warning">Figyelem! Ajánlott asztali gépről, vagy laptopról megtekinteni az oldalt, mobilon egyes elemek a reszponzív elrendezéstől függetlenül rosszul jelenthetnek meg!</p>
				@foreach($errors->all() as $error)
					<p style=" padding: 10px; "><strong> {{$error}} </strong></p>
				@endforeach
			</div>
	<div class="container card" style="border: 2px solid black; font-family: monospace; background-color: white; padding: 1%; border-radius: 1%; font-size: 1.3em;" id="console">
			<h3 class="bg-primary">Adatbázis-kezelő</h3>
			<p class="text-dark">Figyelem! Ezen műveletek elvégzéséhez csak admin joggal rendelkező személy jogosult!</p>
			<form  id="dbactions" method="POST" action="{{route('dboperation')}}" style=" padding: 5px; font-size: 1.3em;" >
				 @csrf
                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}">
			<div class="radio">
			  <label class="text-dark"> Adatbázis felépítése & feltöltése alapvető adatokkal, illetve a meglévő visszaállítása alap állapotra</label>
			</div>

			<input placeholder="admin jelszó" id="password" name="password" type="password" required="required" class="form-control"><br>
			<input type="submit" value="Művelet elvégzése" class="btn btn-primary form-control" style="font-size: 1em; border: 1px solid black;">
			</form>
	</div>
<br><br>
	<div class="container card" style=" border: 2px solid black; background-color: white; padding: 1%; border-radius: 1%; font-size: 1 em;" id="newgame">
			<h3 class="bg-success">Reportok</h3>
			<p >Itt láthatóak a bejelentések </p>
			 <input type="text" onkeyup="filter()" id="search" maxlength="50" class="form-control" placeholder="Keresés"> <br> 
			<form  id="reports" method="POST" action=""
			autocomplete="off"  style=" padding: 5px; font-size: 1.0em; height: 
               	300px; overflow: scroll;">
				 @csrf  <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}">
				
				 <div class="row" style="background-color:  blue; color: white; border: 2px solid black;">
               		<div class="col-2 text-center" style="border-right: 1px solid black;">
               			Dátum
               		</div>
               		<div class="col-3 text-center" style="border-right: 1px solid black;">
               			Bejelentő
               		</div>
               		<div class="col-3 text-center" style="border-right: 1px solid black;">
               			Bejelentett
               		</div>
               		<div class="col-4 text-center" style="border-right: 1px solid black;">
               			Indok
               		</div>
               	</div>
               	<ul id="list" style="list-style-type: none; margin-left: 1; padding-left: 1px;"> 
	               	@foreach ($reports as $report)
		            <li>
		               	<div class="row" style="">
		               		<div class="col-2" style="">
		               			{{$report->date}}
		               		</div>
		               		<div class="col-3" style="">
		               			{{$report->reporter->email}}
		               		</div>
		               		<div class="col-3" style="">
		               			{{$report->reported->email}}
		               		</div>
		               		<div class="col-4" style="">
		               			{{$report->details}}
		               		</div>
		               	</div>
	               </li>
	               	@endforeach
               </ul>
			</form>
	</div><br><br>

	<div class="container card" style="border: 2px solid black; font-family: monospace; background-color: white; padding: 1%; border-radius: 1%; font-size: 1.3em;" id="newgame">
			<h3 class="bg-danger">Játékos blokkolása/feloldása</h3>
			<p class="text-dark">Figyelem! a játékos nem fog végleg törlődni fog a rendszerből! Csak indokolt esetben (pl. csalás) ajánlott bannolni! Bármikor visszaállítható a játékos profilja.</p>
			<p>Blokk magyarázat: 1=igen, 0=nem</p>
			<form  id="dbactions" method="POST" action="{{route('ban')}}"
			autocomplete="off"  style=" padding: 5px; font-size: 1.3em;" >
				 @csrf
                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}">	
			<select name="player" id="player" class="form-control">
				@foreach($users as $user)
					<option value="{{$user->id}}">{{$user->name}} - {{$user->email}} - Blokk: {{$user->blocked}}) Reportok: {{$user->reports}}</option>}
				@endforeach
			</select><br>
			<input autocomplete="off" placeholder="admin jelszó" id="password" name="password" type="password" autocomplete="off" required="required" class="form-control"><br>
			<input type="submit" value="Blokkolás" class="btn btn-danger form-control" style="font-size: 1em; border: 1px solid black;">
			<input type="submit" formaction="{{route('unblock')}}" value="Feloldás" class="btn btn-success form-control" style="font-size: 1em; border: 1px solid black;">
			</form>
	</div><br><br>

	<script>
		function filter() 
		{
		    var input, filter, ul, li, a, i, txtValue;
		    input = document.getElementById("search");
		    filter = input.value.toLowerCase();
		    ul = document.getElementById("list");
		    li = ul.getElementsByTagName("li");
		    for (i = 0; i < li.length; i++) {
		        a = li[i].getElementsByTagName("div")[0];
		        txtValue = a.textContent || a.innerText;
		        if (txtValue.toLowerCase().indexOf(filter) > -1) {
		            li[i].style.display = "";
		        } else {
		            li[i].style.display = "none";
		        }
		    }
		}
	</script>

 @endsection