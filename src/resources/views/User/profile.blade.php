@extends('index')
@auth
@section('content')
	<div class="text-light container card text-center" style="background-color: rgba(0,0,0,0.8); padding: 4%; border-radius: 1%; " id="data" name="data" >
		  @foreach ($errors->all() as $error)
      <p class="bg-info

      ">{{ $error }}</p>
  @endforeach
		<div class="row">
			<div class="col-12">
			<img draggable="false" src="{{Auth::user()->avatar}}" alt="A kép betöltése siekrt elen" height="200px" width="200px"
			style="border: 2px solid white; border-radius: 50%; margin-bottom: 20px;">
			</div>
		</div>
			<div class="row">
				<div class="col-12">
					<h4>Név: {{Auth::user()->name}}<br></h4>
				</div>
				<div class="col-12">
					<h4>Email: {{Auth::user()->email}}</h4>
				</div>		
				<div class="col-12">
					<h4>Nem: {{Auth::user()->gender}}</h4>
				</div>		
				<div class="col-12">
					<h4>Születési dátum: {{Auth::user()->birthday}}</h4>
				</div>		
				<div class="col-12">
					<button class="btn btn-primary" id="edit" name="edit">Adatok szerkesztése</button>
				</div>					
			</div>
		</div>
		
	</div>
		<br>
	<form action="{{route('userupdate')}}" method="POST" name="editform" id="editform">
				@csrf
		<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
		<div class="text-light container card text-center" style=" padding: 4%; border-radius: 1%; background-color: rgba(0,0,0,0.8); " id="edit" name="edit" >
			 <label for="name" class="text-light" >Név: </label>
    		<input type="text" required="required" class="form-control" id="name" name="name" value="{{Auth::user()->name}}">
    		<label for="email" class="text-light" >Email: </label>
    		<input type="text" required="required" class="form-control" id="email" name="email" value="{{Auth::user()->email}}">
    		<label for="name" class="text-light" title="Másold be a képed linkjét, és meg fog jelenni!" >Avatar URL: </label>
    		<input type="text" required="required" class="form-control" id="avatar" name="avatar" value="{{Auth::user()->avatar}}">
    		<p class="bg-warning text-dark">Figyelem! Csak akkor töltsd ki az új jelszó mezőt, ha megszeretnéd változtatni a jelszavad!</p>
    		<label for="newpsw" class="text-light" >Új jelszó: </label>
    		<input type="password" class="form-control" id="newpsw" name="newpsw" placeholder="">
    		<label for="newpsw2" class="text-light" >Új jelszó megerősítése: 
    		</label>
    		<input type="password" class="form-control" id="newpsw2" name="newpsw2" placeholder=""><br><br>
    		<div class="row">
    			<div class="col-6">
    		<input type="submit" class="btn btn-success form-control" name="saveprofile" id="saveprofile" value="Mentés">
    			</div>
    		<div class="col-6">
    		<input type="button" class="btn btn-warning form-control" name="cancel" id="cancel" value="Mégsem">
    		</div>
    		</div>
		</div>
	</form>	

@endsection
@endif