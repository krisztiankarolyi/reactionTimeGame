<?php
//URL::forceScheme('https');
use Illuminate\Support\Facades\Route;



Route::group(["namespace" => "App\Http\Controllers"], function() {
	Route::get("/", "UserController@index")->name("index");
	Route::get("/home", "UserController@home")->name("home");

	Route::get("/login", "UserController@login")->name("loginform");
	Route::post("/login", "UserController@auth")->name("login");

	Route::get("/registerform", "UserController@registerForm")->name("registerform");
	Route::post("/register", "UserController@register")->name("register");
	Route::post("/userupdate", "UserController@userUpdate")->name("userupdate");
	Route::get("/logout", "UserController@logout")->name("logout");
	Route::get('/get-users', "FrontendController@getUsers")->name("get-users");

	Route::get('/profile', "UserController@editprofile")->name("editprofile");
	Route::get('/friends', "UserController@friendspage")->name("friendspage");
	Route::post('/friends', "UserController@friendspage")->name("friendspage");
	Route::get('/games/{game}', "GameController@showgame")->name("showgame");
	Route::get('/games', "GameController@games")->name("games");
	Route::post('/newrecord', "GameController@newRecord")->name("newrecord");
	Route::post('/unfriend', "UserController@unfriend")->name("unfriend");
	Route::post('/addfriend', "UserController@addfriend")->name("addfriend");
	Route::post('/accept', "UserController@acceptfriend")->name("accept");
	Route::post('/decline', "UserController@declinefriend")->name("decline");
	Route::post('/declinefriend', "UserController@declinefriend")->name("declinefriend");

	Route::get('/results', "UserController@showres")->name("showres");

	Route::get('/ranking', "UserController@ranking")->name("ranking");
	Route::get('/contact', "UserController@contact")->name("contact");
	Route::get("/uprofile/{id}", "UserController@getProfile")->name("getprofile");
	Route::post('/report', "UserController@Report")->name("report");

	Route::post('/adminlogin', "AdminController@login")->name("a_login");
	Route::get('/exit', "AdminController@exit")->name("exit");
	Route::get('/controlpanel', "AdminController@showpanel")->name("showpanel");
	Route::post('/dboperation', "AdminController@dboperation")->name("dboperation");
	Route::post('/addgame', "AdminController@addgame")->name("addgame");
	Route::post('/delgame', "AdminController@delgame")->name("delgame");
	Route::post('/ban', "AdminController@ban")->name("ban");
	Route::post('/unblock', "AdminController@unblock")->name("unblock");
});
 