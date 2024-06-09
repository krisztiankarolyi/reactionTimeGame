@extends('index')
@auth
@section('content')
	<div class="container" id="main">
    @foreach ($errors as $error)
    <p class="text-danger">{{ $error }}</p>
    @endforeach

    <!----------------------------- BARÁTOK LISTÁJA------------------------->

		<div id="myfriends" class="text-light" style="border: 1px solid white;background-color: #4169e1; padding: 4%; border-radius: 1%; ">
			<h3>Az én barátaim</h3><br>
    @if (count($friends) > 0)
		  @foreach ($friends as $friend)
        @if($friend->blocked == 0)
       <div class="row">
            <div class="col-9" onmousedown="event.preventDefault ? event.preventDefault() : event.returnValue = false">
              <form method="post" action="{{route('unfriend')}}">
                @csrf
                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}">
                <input type="hidden" name="friendid" id="friendid" value="{{ $friend->id }}">
                <a href="{{route('getprofile', $friend->id)}}"><img draggable="false" src="{{$friend->avatar}}" height="50px" width="50px">
                <label class="text-light"> &nbsp;&nbsp;&nbsp;{{ $friend->name }}&nbsp;&nbsp;&nbsp; </label></a>

            </div>
            <div class="col-2">
                <input type="submit" value="X" style="height: 50px; width: 50px;" class="btn btn-danger" id="unfriend">
              </form> 
            </div>
        </div>
            <br>
            @endif
      @endforeach
    @else <p>Nincsenek barátaid jelenleg</p>
    @endif
		</div>
		<br>

<!----------------------------- BARÁTI KÉRÉSEK LISTÁJA-------->
@if( count($pendings) > 0 )
		<div id="requests" class="text-light container card text-center" style="background-color: #4169e1; border:1px solid white; padding: 1%; border-radius: 1%; ">
			<h3>Baráti jelölések (nekem Küldöttek)</h3>

			@foreach ($pendings as $pending)
        @if ($pending->checkboth() == 0)
        <div class="row">
            <div class="col-7" onmousedown="event.preventDefault ? event.preventDefault() : event.returnValue = false">
              <form method="post">
                @csrf
                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}">
                <input type="hidden" name="id" id="id" value="{{ $pending->id }}">
               <a href="{{route('getprofile', $pending->acted_user)}}"> <img draggable="false" src="{{$pending->getuser($pending->acted_user)->avatar}}" height="50px" width="50px">
                <label class="text-light"> &nbsp;&nbsp;&nbsp;{{ $pending->getuser($pending->acted_user)->name }}&nbsp;&nbsp;&nbsp; </label></a>
            </div>
                <div class="col-2">
                   <input type="submit" value="✔" formaction="{{route('accept')}}" style="height: 50px; width: 50px; font-size: 25px;" class="btn btn-success text-center">
               </div>
                <div class="col-2">
                   <input type="submit" value="✗" formaction="{{route('decline')}}" style="height: 50px; width: 50px; font-size: 25px;" class="btn btn-danger text-center">
                </div>
              </form>
          
        </div>
        <br>
        @endif
      @endforeach
		</div><br>
    @endif

    <!--------------------------------------------------------------------->
    @if( count($sent) > 0 )
        <div id="requests" class="text-light container card text-center" style="background-color: #4169e1; padding: 1%; border-radius: 1%; border:1px solid white;">
      <h3>Baráti jelölések (Tőlem küldöttek)</h3>

      @foreach ($sent as $pending)
        @if( $pending->checkboth() == 0)
        <div class="row">
            <div class="col-7" onmousedown="event.preventDefault ? event.preventDefault() : event.returnValue = false">
              <form method="post">
                @csrf
                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}">
                <input type="hidden" name="id" id="id" value="{{ $pending->id }}">
               <a href="{{route('getprofile', $pending->second_user)}}"> <img draggable="false" src="{{$pending->getuser($pending->second_user)->avatar}}" height="50px" width="50px">
                <label class="text-light"> &nbsp;&nbsp;&nbsp;{{ $pending->getuser($pending->second_user)->name }}&nbsp;&nbsp;&nbsp; </label></a>
            </div>
                <div class="col-4">
                <input formaction="{{route('unfriend')}}" type="submit" value="Mégsem" class="btn btn-warning"> 
                </div>
              </form>
          
        </div>
        <br>
        @endif
      @endforeach
    </div><br> 
    @endif

<!----------------------------barátok keresése------------------------------>

		<form id="searchuser" method="post" aciton="{{route('friendspage')}}" class="text-light container text-center">
			<h3>Barát hozzáadása</h3>

			<div class="row">
				@csrf
  					<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}">
	 		 	<input class="col-8 form-control" type="text" placeholder="Keresés email vagy név alapján" id="text" name="text"
	  		  aria-label="Search">
	  			<input type="submit" class="form-control btn btn-primary col-4" value="Keres">
  			</div>
  			
		</form><br>
		@if ($users != null)
		@foreach ($users as $user)
				@if($user->email != Auth::user()->email && !$user->blocked)
  					<form id="resultbox" class="row" method="post" action="{{route('addfriend')}}
            ">
  					<div class="col-8" onmousedown="event.preventDefault ? event.preventDefault() : event.returnValue = false">
  					@csrf
  					<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}">
            <input type="hidden" name="userid" id="userid" value="{{ $user->id }}">
  				<a href="{{route('getprofile', $user->id)}}">	<img  draggable="false" src="{{$user->avatar}}" height="50px" width="50px">
  					<label class="text-light"> &nbsp;&nbsp;&nbsp;{{$user->name}}&nbsp;&nbsp;&nbsp; </label></a>
  					</div>
  					<div class="col-2">

  					<input type="submit" value="+" style="height: 50px; width: 50px;" class="btn btn-success">
  					</div>
  					</form><br>
  				@endif

  			@endforeach
  			@else 
  			<p class="text-light">Keress egy barátot!</p>
  			@endif

	</div>
@endsection
@endif
