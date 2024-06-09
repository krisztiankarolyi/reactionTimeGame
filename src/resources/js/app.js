require('./bootstrap');
window.$ = window.jQuery = require('jquery');
window.Vue = require('vue');

Vue.component("login-form", require("./components/LoginForm.vue").default);
Vue.component("register-form", require("./components/RegisterForm.vue").default);

$(document).ready(function(){
	if($("#login").length>0){
	var login = new Vue({
		el: '#login'

	});
}

	$("#nyito1").on("click", function(){

		if( $('#dropdown1').css('display') == "none" )
		{
		$("#dropdown1").css("display", "block");
		$("#dropdown2").css("display", "none");
		$("#dropdown2").css("display", "none");
		}
		else 
		$("#dropdown1").css("display", "none");
	});

	$("#nyito2").on("click", function(){

		if( $('#dropdown2').css('display') == "none" )
		{
		$("#dropdown2").css("display", "block");
		$("#dropdown1").css("display", "none");
		$("#dropdown3").css("display", "none");
		}
		else 
		$("#dropdown2").css("display", "none");
	});

	$("#nyito3").on("click", function(){

		if( $('#dropdown3').css('display') == "none" )
		{
		$("#dropdown3").css("display", "block");
		$("#dropdown1").css("display", "none");
		$("#dropdown2").css("display", "none");
		}
		else 
		$("#dropdown3").css("display", "none");
	});

});