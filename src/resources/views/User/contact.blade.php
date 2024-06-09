	@extends('index')
@section('content')
<div class="text-dark container text-center" style="background-color: white; border:2px solid purple; padding: 3px;">
	<h3 >A fejlesztő (észrevétel, hibajelentés)</h3>
	<img src="{{ URL::asset('developer.jpeg') }}" style="border-radius: 50%; border:2px solid purple;" height="200px;" draggable="false" >
	<p><a target="blank" href="https://www.facebook.com/karolyikiki" style="text-decoration: none;">Károlyi Krisztián</a></p>
	<p><a href = "mailto: xkiki2001@gmail.com" style="text-decoration: none; color: black;">✉ xkiki2001@gmail.com</a></p>

</div>

<script>
	function show()
	{
		if(document.getElementById("account").style.display != "block")
			document.getElementById("account").style.display = "block";
		else
			document.getElementById("account").style.display = "none";
		window.scrollTo(0,document.body.scrollHeight);
	}
</script>
@endsection
