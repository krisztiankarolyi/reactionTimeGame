
var timer; 
var reaction; 
var highscore = 0; 
var init = true; 


window.onload=()=>{ 



    var entire = document.getElementsByClassName("entire")[0];
    var entirebtn = entire.getElementsByTagName("button")[0];
    
    var wait = document.getElementsByClassName("wait")[0];
    
    var tap = document.getElementsByClassName("tap")[0];
    
    var toofast = document.getElementsByClassName("toofast")[0];
    var toofastbtn = toofast.getElementsByTagName("button")[0];
    
    var result = document.getElementsByClassName("result")[0];
    var resultbtn = result.getElementsByTagName("button")[0];
    var resultf = result.getElementsByTagName("res")[0];
    
    var highscoref = document.getElementsByClassName("highscore")[0].getElementsByTagName("res")[0];

   
    entirebtn.onclick=()=>{
      entire.setAttribute("dn","");
      wait.removeAttribute("dn");
      timer = setTimeout(()=>{
         wait.setAttribute("dn","");
         tap.removeAttribute("dn");
         reaction = new Date(); 
      },Math.floor((Math.random() * 8) + 4)*Math.floor((Math.random() * 999) + 501));
    } 
    
    wait.onclick=()=>{ 
      clearTimeout(timer); 
      wait.setAttribute("dn","");
      toofast.removeAttribute("dn");
    }
    
    tap.onclick=()=>{
      var now = new Date(); 
      reaction = now.getTime() - reaction.getTime(); 
      tap.setAttribute("dn","");
      result.removeAttribute("dn");
      resultf.innerHTML = reaction; 
      if(highscore>reaction||init){ 
        highscore = reaction;
        highscoref.innerHTML = highscore; 
        result.getElementsByTagName("hs")[0].removeAttribute("dn");
      }
      init = false; 
    }
    
    resultbtn.onclick=()=>{
      result.setAttribute("dn","");
      if(entire.hasAttribute("dn")){
        entire.removeAttribute("dn");
      }
      result.getElementsByTagName("hs")[0].setAttribute("dn","");
    }

    toofastbtn.onclick=()=>{
      toofast.setAttribute("dn","");
      if(entire.hasAttribute("dn")){
        entire.removeAttribute("dn");
      }
    }
}