@extends('index')
@auth 
@section('content')
<h2 class="text-center text-light">
	Üdvözöl a ReactGame!<br><br>
	<img draggable="false" src="{{URL::asset('/car.png')}}">
</h2><br>
<h4 class="text-center text-light">Válassz egy opciót a fenti menüből!</h4>
<div class="container">
@if(count($recents) > 0)
<h2 class="text-center text-light">Legutóbbi események</h2>
	@foreach($recents as $recent)
	<div class="text-dark text-center" style="border: 2px dotted white; font-family: monospace;  background-image: url({{URL::asset('/bg.png')}}); padding: 10px; margin: 1% 10% 1% 10%; font-size: 20px; background-repeat: round;">
		<div class="text-left">
		<img draggable="false" src="{{$recent->user->avatar}}" width="50px" height="50px"> </div>
		<p>{{$recent->user->name}}  {{$recent->score}}ms eredményt ért el {{$recent->game->name}} játékban {{$recent->date}}-kor.</p>
</div><br>
	@endforeach
@endif
</div>
@endsection
@endif