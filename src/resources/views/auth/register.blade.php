@extends("index")
@section("content")
<br>
	<div class="container card" class="text-light" style="background-color: rgba(0,0,0,0.8); padding: 4%; border-radius: 1%; " id="login" >
		<register-form  class="text-light" _url="{{ route ('register') }}" _csrf="{{csrf_token()}}" _errors="{{json_encode($errors->all())}}">			
		</register-form>
	</div>
	<br><br>
@endsection
