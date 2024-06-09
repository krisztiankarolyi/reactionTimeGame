@extends('index')
@auth
@section('content')
<div class="text-light container card text-center" style="background-color: rgba(0,0,0,0.8); padding: 4%; border-radius: 1%; " id="data" name="data">
	<h2>Játékos profilja</h2>
		<div class="row">
			<div class="col-12">
			<img draggable="false" src="{{$user->avatar}}" alt="A kép betöltése siekertelen" height="200px" width="200px"
			style="border: 2px solid white; border-radius: 50%; margin-bottom: 20px;">
			</div>
		</div>
			<div class="row">
				<div class="col-12">
					<h4>Név: {{$user->name}}<br></h4>
				</div>
				<div class="col-12">
					<h4>Email: {{$user->email}}</h4>
				</div>		
				<div class="col-12">
					<h4>Nem: {{$user->gender}}</h4>
				</div>		
				<div class="col-12">
					<h4>Születési dátum: {{$user->birthday}} ({{$user->age()}} éves)</h4>
				</div>								
			</div>
		</div>
		<a onclick="show();" href="#report">report</a>
		@foreach($errors->all() as $error)
			<p class="text-danger">{{$error}}</p>
		@endforeach
	</div>
	<form method="POST" action="{{route('report')}}" style="display: none" id="report" style="margin-left: 4%; margin-right: 4%;">
		@csrf
  		<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}">
		<input type="hidden" value="{{$user->id}}" name="reportedid">
		<input type="hidden" value="{{Auth::user()->id}}" name="reporterid">
		<textarea name="details" class="form-control" maxlength="200" ="" placeholder="Bejelntés oka (Kérem, kifogástalan szöveget mellőzze!) (Max. 200 karakter)"></textarea><br>
		<input type="submit" class="btn btn-danger form-control" value="Játékos jelentése">
	</form><br>


	<script>
		function show()
		{
			if(document.getElementById("report").style.display == "none")			
			document.getElementById("report").style.display = "block";
			else document.getElementById("report").style.display = "none";
			document.getElementById("report").style.margin = "0% 4% 0% 4%";
		}
	</script>
@endsection
@endif