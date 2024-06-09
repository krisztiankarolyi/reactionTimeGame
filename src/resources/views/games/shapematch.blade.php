<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" charset="utf-8">

		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

		<title>Shape Match</title>
	</head>

	<body style="background-color: black; overflow: hidden;">
 <form action="{{route('newrecord')}}" id="highscore" method="post">
        	@csrf
        	<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
        	<input type="hidden" name="gameid" id="gameid" value={{$id}}>
		<div class="bg-dark text-light row" id="topbar" style="padding: 10px; margin-bottom: 30px;">
			<div class="col-3">
				<span>Eddigi legjobb: </span>
				<strong>
					<input type="number" readonly="true" name="score" id="score" class="text-light bg-dark" style="border: none; cursor: none;">
				</strong> <span>ms</span>
			</div>
			<div class="col-3">
				<button class="btn btn-primary" id="save" style="display: none; cursor: hand;">Mentés</button>
			</div>
			<div class="col-3">
			<a href="{{route('games')}}" style="color: white">Vissza az oldalra</a>
			</div>
			<div class="col-3 text-right">
			<img src="{{Auth::user()->avatar}}" width="60px" height="60px" style="border-radius: 50%">
			</div>
		</div>
	</form>
	<!--------------------------topbar--------------------------------->
		<div id="canvas" style="background-color: black;">

			<div id="kezdokep" class="text-center text-light">
				<p>Ebben a játékban akkor kell kattintanod, ha a két alakzat megegyezik: pl. </p><br>
				<img src="{{ URL::asset('/shapes/tryangle.png') }}" width="100px" draggable = "false">
				<img style="margin-left: 15px;"src="{{ URL::asset('/shapes/tryangle.png') }}" width="100px" draggable = "false">
				 <br>

				<button class="btn btn-primary" style="margin-top: 60px; width:150px; height: 50px;" id="start">Mehet!</button>
			</div>
 <!--------------------------------homescreen----------------------------->
 <!-----------------------------------Game-------------------------------->
 			<div id="game" class="text-center text-light" style="cursor: crosshair; display: none; border: none; background-color: black;">
 				<strong><h1 style="font-size: 70px; margin-top: 50px;   text-shadow: 3px 3px black; padding: 20px;" id="text">Get Ready!</h1></strong><br>
 				<img id="first" src="" width="170px" draggable = "false"> <br> <br>
 				<img id="second" src="" width="170px" draggable = "false">

			</div>
<!------------------------------------result--------------------------->
			<div id="resultbox" style="display: none; text-align: center; padding: 20px; ">
				<h3 style=" padding: 10px;" id="result"></h3><br> <br>
				<button class="btn btn-primary" id="retry">Újra!</button>
			</div>
<!----------------------TOO SOON------------------------------------------------>
		<div id="toosoon" style="  display: none; text-align: center;">
				<h3 style="background-color: red; padding: 10px; font-size: 40px;" id="error">Túl korán kattintottál! </h3><br> <br>
				<button class="btn btn-primary" id="retry2">Újra!</button>
			</div>

 <!-----------------------------------------------------------scripts-------------->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
		</script>

	<script type="text/javascript">

		$(document).ready(function()
		{
			var match = false;
	    	$("#kezdokep").css("display", "block");
			var isTouchDevice = 'ontouchstart' in document.documentElement;
			var shapes = ["tryangle", "circle", "square", "star", "heart", "rombusz"];
			var highscore = 100000;
			$("#start").click( function()
			{
				$("#kezdokep").css("display", "none");
				$("#game").css("display", "block");
				$("#toosoon").css("display", "none");
				$("#text").css("display", "none");
				var match = false;
				run();

				async function run()
				{
					var rand = shapes[Math.floor(Math.random() * shapes.length)];
					$("#first").attr("src", "../shapes/"+rand+".png");
					var observerInterval = setInterval(function()
					{
						console.log("running...")
						var rand2 = shapes[Math.floor(Math.random() * shapes.length)];
						$("#second").attr("src", "../shapes/"+rand2+".png" );
						if(rand == rand2)
						{
							 match = true; clearInterval(observerInterval);
							 endgame();
						}
						else match = false;

						$(document).on("mousedown", function()
						{
							if(!match) gameover();
							clearInterval(observerInterval);
						});

	    			}, 400);

	    		}


				async function endgame()
				{
					var start = new Date();
					$(document).on("mousedown", function()
					{
						var click = new Date();
						var reaction = click.getTime() - start.getTime();
						console.log("WIN: "+reaction);
						if(reaction < highscore)  highscore = reaction;
						$(document).off('mousedown');
						$("#score").val(highscore);
						$("#resultbox").css("background-color", "black");
						$("#resultbox").css("display", "block");
						$("#result").css("color", "white");
						$("#result").text("Eredményed: "+reaction+" ms !");
						$("#save").css("display", "block");

					});
				}

				async function gameover()
				{
	 				console.log("too soon");
	 				$("body").css("background-color", "black");
	 				$("resultbox").css("background-color", "black");
					$("#resultbox").css("display", "none");
					$("#game").css("display", "none");
					$("#kezdokep").css("display", "none");
					$("#toosoon").css("display", "block");
					$(document).off("mousedown");
				}
				$("#retry").click(function()
				{
					$("#fist").css("display", "none");
					var ja = $("#game").css("background-color");
					$("body").css("background-color", ja);
					$("#kezdokep").css("display", "none");
					$("#resultbox").css("display", "none");
					$("#game").css("display", "block");
					$("#toosoon").css("display", "none");
					$("#text").css("background-color","black");
						$("#text").text("Get Ready!");
						$("#game").css("background-color","black");
						$("body").css("background-color","black");
  					run();
				});
				$("#retry").off("mousedown");

				$("#retry2").click(function()
				{
					$("#fist").css("display", "none");
					var ja = $("#game").css("background-color");
					$("body").css("background-color", ja);
					$("#kezdokep").css("display", "none");
					$("#resultbox").css("display", "none");
					$("#game").css("display", "block");
					$("#toosoon").css("display", "none");
					$("#text").css("background-color","black");
						$("#text").text("Get Ready!");
						$("#game").css("background-color","black");
						$("body").css("background-color","black");
  					run();
				});
				$("#retry2").off("mousedown");

			});
		});


	</script>
	<script>
		$("#score").change(function{
			if($("#score").attr('readonly')==false)
				location.reload();
		});
document.onkeypress = function (event) {
event = (event || window.event);
if (event.keyCode == 123) {
return false;
}
}
document.onmousedown = function (event) {
event = (event || window.event);
if (event.keyCode == 123) {
return false;
}
}
document.onkeydown = function (event) {
event = (event || window.event);
if (event.keyCode == 123) {
return false;
}
}
</script>
	</body>
</html>
