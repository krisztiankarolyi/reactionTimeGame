<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use \App\Models\uzemanyagok;
use \App\Models\autok;
use \App\Models\User;


class FrontendController extends Controller
{
    public function index()
    {
    	return view('index');
    }
}
