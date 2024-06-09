@extends('index')
@auth
@section('content')
<h3 class="text-light">Kattints egy dobozra a kezdéshez!</h3>
@foreach ($games as $game)
<a href="{{route('showgame', $game->name)}}">
<div id="{{$game->name}}" class="" style="background-color: #4169e1; color: white; padding: 10px; border: none;">
<img src="{{ URL::asset('/'.$game->name.'.png') }}" width="100px">
<h3 >{{$game->name}}</h3>
<p >{{$game->description}}</p>
</div>
</a><br>
@endforeach
@endsection
@endif