@extends ('index')
@auth
@section ('content')
<div style="background-image: url({{URL::asset('/award.jpg')}});">
	<form action="{{route('ranking')}}" method="get" class="text-center" style="padding: 20px;">	

		<label for="selectedgame" class="text-light bg-dark" style=" padding: 2px; margin-top: 4px;">Játék: </label><br>
		<select id="game" name="game" class="selectpicker form-control">
			@foreach ($games as $game)		
				<option value="{{$game->id}}">
					{{$game->name}}
				</option>
			@endforeach
		</select>	
			<br>
		<input type="submit" value="Mutasd" class="btn btn-primary form-control">
	</form><br>


	<h3 class="text-center  text-light" style="background-color: rgba(0,0,0,0.5);">Ranglista ({{$selectedgame}})</h3>

		<div class="row" onmousedown="event.preventDefault ? event.preventDefault() : event.returnValue = false" id="row" style="margin-left: 10px; margin-right: 10px;">	
			<div class="col-3 text-center text-light" style="font-size: 20px;">	
				<label style="margin-top: 15px;"> Helyezés </label>
			</div>

			<div class="col-6 text-center" style="font-size: 20px; margin-top: 15px;">
				<label class="text-white"> Játékos </label>
			</div>

			<div class="col-3 text-center" style="font-size: 20px; margin-top: 15px;">
				<label class="text-white"> Idő (ms) </label>
			</div>
		</div> 

	@foreach($records as $record)
		@if($record->userid == Auth::user()->id)
		<div class="row" onmousedown="event.preventDefault ? event.preventDefault() : event.returnValue = false" id="row" style="background-color: rgba(196, 230, 252, 0.52); padding: 10px; margin-left: 10px; margin-right: 10px;">
			@if($loop->index+1 == 1)
				<div class="col-3 bg-warning text-center" style="font-size: 20px;">	
					<label style="margin-top: 15px;"> {{ $loop->index+1 }} </label>
				</div>
			@elseif($loop->index+1 == 2) 
				<div class="col-3 text-center bg-secondary" style="font-size: 20px;">	
				<label style="margin-top: 15px;"> {{ $loop->index+1 }} </label>
				</div>
			@elseif($loop->index+1 == 3) 
				<div class="col-3 text-center" style="background-color: #cd7f32; font-size: 20px;" >	
					<label style="margin-top: 15px;"> {{ $loop->index+1 }} </label>
				</div>
			@else
				<div class="col-3 text-center" style="font-size: 20px;">	
					<label style="margin-top: 15px;" class="text-light"> {{ $loop->index+1 }} </label>
				</div>
			@endif
				<div class="col-3 text-center">

					<a href="{{route('getprofile', $record->user->id)}}"><img src="{{$record->user->avatar}}" width="65px" height="65px" style="border: 1px solid white; border-radius: 50%;"></a>
				</div>
				<div class="col-3 text-center" style="font-size: 20px; margin-top: 15px;">
					<label class="text-white"> {{$record->user->name}} </label>
				</div>
				<div class="col-3 text-center" style="font-size: 20px; margin-top: 15px;">
					<label class="text-white "> {{$record->ja}} </label>
				</div>
		</div>

		@else 
		<div class="row" onmousedown="event.preventDefault ? event.preventDefault() : event.returnValue = false" id="row" style="background-color: rgba(0,1,0,0.56); padding: 10px; margin-left: 10px; margin-right: 10px;" >
			@if($loop->index+1 == 1)
				<div class="col-3 bg-warning text-center" style="font-size: 20px;">	
				<label style="margin-top: 15px;"> {{ $loop->index+1 }} </label>
			</div>
			@elseif($loop->index+1 == 2) 
				<div class="col-3 text-center bg-secondary" style="font-size: 20px;">	
				<label style="margin-top: 15px;"> {{ $loop->index+1 }} </label>
			</div>
			@elseif($loop->index+1 == 3) 
				<div class="col-3 text-center" style="background-color: #cd7f32; font-size: 20px;" >	
				<label style="margin-top: 15px;"> {{ $loop->index+1 }} </label>
			</div>
			@else
				<div class="col-3 text-center" style="font-size: 20px;">	
				<label style="margin-top: 15px;" class="text-light"> {{ $loop->index+1 }} </label>
			</div>
			@endif
			<div class="col-3 text-center">

				<a href="{{route('getprofile', $record->user->id)}}"><img src="{{$record->user->avatar}}" width="65px" height="65px" style="border: 1px solid white; border-radius: 50%;"></a>
			</div>
			<div class="col-3 text-center"" style="font-size: 20px; margin-top: 15px;">
				<label class="text-white"> {{$record->user->name}} </label>
			</div>
			<div class="col-3 text-center"" style="font-size: 20px; margin-top: 15px;">
				<label class="text-white"> {{$record->ja}} </label>
			</div>
		</div>
		@endif
		<br>
	@endforeach
</div>
@endsection
@endif
