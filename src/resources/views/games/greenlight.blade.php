@auth	 
<meta name="viewport" content="width=device-width, user-scalable=no">
	 <div class="entire">
            <t>Teszteld a reakcióidőd.<br>Várd meg, amíg zöldre vált a képernyő, majd kattints, amilyen gyorsan csak tudsz.</t><br>
            <p>Ennyi ezredmásodperc alatt kellene lennie: <span style="color: red;">380ms</span></p>
            <button>Mehet</button>             
        </div>
        <div class="wait" style="cursor: crosshair;" dn>
           <h1> Várj... </h1>
        </div>
        <div class="tap" style="cursor: crosshair;" dn>
             <h1> KATTINTS!</h1>
        </div>
        <div class="toofast" dn>
            <t>Túl hamar nyomtad meg!<br>Akkor nyomd meg, amikor már zöld!</t>
            <button>Újra</button>
        </div>
        <div class="result" dn>
            <t>Ennyi időbe telt:  <res></res>ms</t>
            <hs dn>Új rekord!</hs>
            <button>Újra</button>
        </div>
        <form action="{{route('newrecord')}}" id="highscore" method="post">
        	@csrf
        	<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
        	<input type="hidden" name="gameid" id="gameid" value="1" />
        <div class="highscore">
             Jelenlegi legjobb idő: <input style="cursor: none;" type="number" readonly="true" name="score" id="score">ms
             <input type="submit" name="submit" id="submit" value="Eredmény mentése" title="Eredményeidnél lesz látható mentés után" >
              <a href="{{route('games')}}" style="color: yellow;">Vissza az oldalra</a>
         </div>
       
     </form>

         <script type="text/javascript">
var isTouchDevice = 'ontouchstart' in document.documentElement;
         	
var timer; 
var reaction; 
var highscore = 0; 
var init = true; 
var savebtn = document.getElementById("submit");

window.onload=()=>{ 
if(!isTouchDevice)
{
   submit.style.visibility = "hidden";
    var entire = document.getElementsByClassName("entire")[0];
    var entirebtn = entire.getElementsByTagName("button")[0];
    
    var wait = document.getElementsByClassName("wait")[0];
    
    var tap = document.getElementsByClassName("tap")[0];
    
    var toofast = document.getElementsByClassName("toofast")[0];
    var toofastbtn = toofast.getElementsByTagName("button")[0];
    
    var result = document.getElementsByClassName("result")[0];
    var resultbtn = result.getElementsByTagName("button")[0];
    var resultf = result.getElementsByTagName("res")[0];
    
    var highscoref = document.getElementById("score");

   
    entirebtn.onmousedown =()=>{
      entire.setAttribute("dn","");
      wait.removeAttribute("dn");
      timer = setTimeout(()=>{
         wait.setAttribute("dn","");
         tap.removeAttribute("dn");
         reaction = new Date(); 
      },Math.floor((Math.random() * 5) + 3)*Math.floor((Math.random() * 999) + 480));
    } 
    
    wait.onmousedown =()=>{ 
      clearTimeout(timer); 
      wait.setAttribute("dn","");
      toofast.removeAttribute("dn");
    }
    
    tap.onmousedown =()=>{
      var now = new Date(); 
      reaction = now.getTime() - reaction.getTime(); 
      tap.setAttribute("dn","");
      result.removeAttribute("dn");
      resultf.innerHTML = reaction; 
      if(highscore>reaction||init){ 
        highscore = reaction;
        highscoref.value = highscore; 
        result.getElementsByTagName("hs")[0].removeAttribute("dn");
      }
      init = false; 
      submit.style.visibility = "visible";
    }
    
    resultbtn.onmousedown =()=>{
      result.setAttribute("dn","");
      if(entire.hasAttribute("dn")){
        entire.removeAttribute("dn");
      }
      result.getElementsByTagName("hs")[0].setAttribute("dn","");
    }

    toofastbtn.onmousedown =()=>{
      toofast.setAttribute("dn","");
      if(entire.hasAttribute("dn")){
        entire.removeAttribute("dn");
      }
    }
}
else {
           submit.style.visibility = "hidden";
    var entire = document.getElementsByClassName("entire")[0];
    var entirebtn = entire.getElementsByTagName("button")[0];
    
    var wait = document.getElementsByClassName("wait")[0];
    
    var tap = document.getElementsByClassName("tap")[0];
    
    var toofast = document.getElementsByClassName("toofast")[0];
    var toofastbtn = toofast.getElementsByTagName("button")[0];
    
    var result = document.getElementsByClassName("result")[0];
    var resultbtn = result.getElementsByTagName("button")[0];
    var resultf = result.getElementsByTagName("res")[0];
    
    var highscoref = document.getElementById("score");

   
    entirebtn.ontouchstart =()=>{
      entire.setAttribute("dn","");
      wait.removeAttribute("dn");
      timer = setTimeout(()=>{
         wait.setAttribute("dn","");
         tap.removeAttribute("dn");
         reaction = new Date(); 
      },Math.floor((Math.random() * 5) + 3)*Math.floor((Math.random() * 999) + 480));
    } 
    
    wait.ontouchstart =()=>{ 
      clearTimeout(timer); 
      wait.setAttribute("dn","");
      toofast.removeAttribute("dn");
    }
    
    tap.ontouchstart =()=>{
      var now = new Date(); 
      reaction = now.getTime() - reaction.getTime(); 
      tap.setAttribute("dn","");
      result.removeAttribute("dn");
      resultf.innerHTML = reaction; 
      if(highscore>reaction||init){ 
        highscore = reaction;
        highscoref.value = highscore; 
        result.getElementsByTagName("hs")[0].removeAttribute("dn");
      }
      init = false; 
      submit.style.visibility = "visible";
    }
    
    resultbtn.ontouchstart =()=>{
      result.setAttribute("dn","");
      if(entire.hasAttribute("dn")){
        entire.removeAttribute("dn");
      }
      result.getElementsByTagName("hs")[0].setAttribute("dn","");
    }

    toofastbtn.ontouchstart =()=>{
      toofast.setAttribute("dn","");
      if(entire.hasAttribute("dn")){
        entire.removeAttribute("dn");
      }
    }
     }
}

         </script>
         <script>  
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
         <style type="text/css">*{
    font-family: "Open Sans", sans-serif; 
}

body {
	position: fixed;
    background: rgb(0,0,0);
    color: white;
    margin: 0;
    padding: 0;
    font-size: 20px;
    overflow: none;
}

div{
	
    align-items: center;
    display: flex;
    flex-direction: column;
    height: 100vh;
    justify-content: center;
    text-align: center;
    width: 100vw; 
    overflow: none;
}
.wait{
	
    background: rgb(195,0,0);
    color: #fff;
     overflow: none;
}

#submit
{

 background: rgb(12,85,225);
    border: none;
    border-radius: 3px;
    box-shadow: 0 0 10px rgba(0,0,0,0.3);
    color: #fff;
    cursor: pointer;
    margin: 10px;
    padding: 5px 12px;

}


.tap{
    background: green;
    color: #fff;
}

.highscore{
    background: rgb(35,35,35);
    color: #fff;
    display: block;
    font-size: 0.85em;
    height: auto;
    left: 0;
    padding: 4px;
    position: absolute; 
    top: 0;
    width: 100%;
}
.hs{
   color: rgb(12,85,225); 
    overflow: none;
}


footer{
	 overflow: none;
    background: rgb(205,205,205);
    bottom: 0;
    font-size: 0.85em;
    left: 0;
    padding: 0 4px;
    position: absolute; 
    text-align: center;
    width: calc(100% - 8px);
}
#score
{
	background: rgb(35,35,35);
	color: white;
	border: none;
	cursor: none;
	font-size: 20px;
	width: 70px;
}

button{
    background: rgb(12,85,225);
    border: none;
    border-radius: 3px;
    box-shadow: 0 0 10px rgba(0,0,0,0.3);
    color: #fff;
    cursor: pointer;
    font-size: 1em;
    margin: 10px;
    padding: 5px 12px;
    height: 60px; width: 150px;
}
a {
	color: white; text-decoration: none;
}

[dn]{
    display: none; 
     overflow: none;
}</style>
@endif