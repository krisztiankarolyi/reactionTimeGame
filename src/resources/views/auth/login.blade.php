@extends("index")
@section("content")
	<div class="container card" class="text-light" style="background-color: rgba(0,0,0,0.8); padding: 4%; border-radius: 1%; " id="login" >
		<login-form  class="text-light" _url="{{ route ('login') }}" _csrf="{{csrf_token()}}" _errors="{{json_encode($errors->all())}}">
		</login-form>
	</div>
	<br>
	<br>
@endsection
