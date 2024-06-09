
<!DOCTYPE html>
<html lang="hu">
<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
  <style>
      .ja{
    
    list-style: none;
    margin-bottom: 20px;

  }
   a:hover{text-decoration: none;}
   .ja:hover {background-color: rgba(0,0,0,0.3);
    padding: 20px; border: 1px solid white;}
    .active-pink-2 input.form-control[type=text]:focus:not([readonly]) {
    border-bottom: 1px solid #f48fb1;
    box-shadow: 0 1px 0 0 #f48fb1;
  }
  .active-pink input.form-control[type=text] {
    border-bottom: 1px solid #f48fb1;
    box-shadow: 0 1px 0 0 #f48fb1;
  }
  .active-purple-2 input.form-control[type=text]:focus:not([readonly]) {
    border-bottom: 1px solid #ce93d8;
    box-shadow: 0 1px 0 0 #ce93d8;
  }
  .active-purple input.form-control[type=text] {
    border-bottom: 1px solid #ce93d8;
    box-shadow: 0 1px 0 0 #ce93d8;
  }
  .active-cyan-2 input.form-control[type=text]:focus:not([readonly]) {
    border-bottom: 1px solid #4dd0e1;
    box-shadow: 0 1px 0 0 #4dd0e1;
  }
  .active-cyan input.form-control[type=text] {
    border-bottom: 1px solid #4dd0e1;
    box-shadow: 0 1px 0 0 #4dd0e1;
  }
  .active-cyan .fa, .active-cyan-2 .fa {
    color: #4dd0e1;
  }
  .active-purple .fa, .active-purple-2 .fa {
    color: #ce93d8;
  }
  .active-pink .fa, .active-pink-2 .fa {
    color: #f48fb1;
  }
  #resultbox:hover{
    background-color: rgba(0,0,0,0.6);
  }

  
  </style>
<link rel="icon" href="car.png">
	<link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" >
	<title>ReactGame</title>
	<meta name='viewport' 
     content='width=device-width, initial-scale=1.0, maximum-scale=1.0, 
     user-scalable=0' charset="utf-8" >
</head>


	<!-- navbar -->

	<nav class="navbar navbar-expand-lg navbar-dark text-light sticky-top"  onmousedown="return false" style="background-color: #4169e1;">
  <p class="navbar-brand">ReactGame</p>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav" id="ja">
      <li class="nav-item active">
        <a class="nav-link" href="{{ route('index') }}">Főoldal <span class="sr-only">(current)</span></a>
      </li>
      @auth
          <a href="{{route('editprofile')}}" title="Profil szerkesztése">
       <li class="nav-item">
      <img src="{{Auth::user()->avatar}}" height="50px" width="50px" style="border-radius: 50%;">
    </li>
       <li class="nav-item">
        <li class="nav-item">
        <a class="nav-link" href="{{route('editprofile')}}">{{Auth::user()->name}}</a>
         </li>
       </li> </a>
        <a class="nav-link" href="{{route('logout')}}">Kilépés</a>
         </li>
          <li class="nav-item"> <a class="nav-link" href="{{route('showres')}}">Eredményeim</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{route('ranking') }}">Ranglista</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{route('friendspage')}}">Barátok</a></li>
             <strong> <li class="nav-item"> <a class="nav-link" href="{{route('games')}}">Új játék</a></li></strong>
      @else 
      <li>
       <a class="nav-link" href="{{ route('login')}}" title="Autók hozzádása illetve módosítása belépést igényel">Belépés</a>
      </li>
            <li class="nav-item">
        <a class="nav-link" href="{{route('registerform')}}">Regisztráció</a>
      </li>
      @endif
      </li>
            <li class="nav-item">
        <a class="nav-link" href="{{route('contact')}}">kapcsolat</a>
      </li>
      <h3  class="text-center text-light text-white margin">{Online reakcióidős játék}</h3>
    </ul>
  </div>
</nav>
<!--- end navbar -->

<br>
<body style="background-color: black;">
<div class="container" id="main">
<br>

@auth
@else
   <br>
   <h3 class="text-light text-center">Üdvözöllek az oldalon! Kérlek <a href="{{route('login')}}">lépj be</a>, vagy <a href="{{route('registerform')}}">regisztrálj</a>!</h3> 
@endif
@yield("content")
  </div>
</body>

<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>
<script type="text/javascript">

     $(document).ready(function(){
       $("#editform").css("display", "none");
       $("#data").css("display", "block");


      $("#edit").on("click", function(){
        $("#editform").css("display", "block");
        $("#data").css("display", "none");
      });


      $("#cancel").on("click", function(){
        $("#editform").css("display", "none");
        $("#data").css("display", "block");
      });

    });

</script> 
</html>