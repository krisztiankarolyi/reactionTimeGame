@extends ('index')
@auth
@section ('content')
<a href="{{$url}}">Eredményeidet ide kattintva letöltheted CSV állományban</a>
<form action="{{route('showres')}}" method="get" class="text-center" >	
		<label for="orderby" class="text-white">Rendezés: </label><br>
		<select id="orderby" name="orderby" class="selectpicker form-control">		
			<option value="asc;score">Eredmény szerint növekvő</option>
			<option value="desc;score">Eredmény szerint csökkenő</option>
			<option value="asc;date">Dátum szerint növekvő</option>
			<option value="desc;date" >Dátum szerint csökkenő</option>
		</select>
	<br>

		<label for="selectedgame" class="text-white" style="margin-top: 4px;">Játék: </label><br>
		<select id="selectedgame" name="selectedgame" class="selectpicker form-control">
			<option value="all" >Összes</option>
			@foreach ($games as $game)		
			<option value="{{$game->id}}"
				>{{$game->name}}</option>
			@endforeach
		</select>	
<br>
<input type="submit" value="Szűrés" class="btn btn-primary form-control">
</form><br>

@foreach ($results as $result)
<div class="text-dark text-center" style="border: 2px dotted white; font-family: monospace;  background-image: url({{URL::asset('/bg.png')}}); padding: 30px; margin: 1% 10% 1% 10%; font-size: 20px; background-repeat: round;">
<div>Játék▶️: {{$result->game->name}}</div> 
<div>Idő🕑: {{$result->score}}ms</div>
<div>Dátum: {{$result->date}}</div>
</div><br>
@endforeach
@endif
@endsection


