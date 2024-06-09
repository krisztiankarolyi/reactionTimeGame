<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Friendship extends Model
{
    use HasFactory;

    public function getuser($id)
    {
    	$user = User::find($id);
    	 return $user;
    }

    public function checkboth() //check if there is a blocked user in the relationship
    {
    	$status = false;
    	$user1 = User::find($this->first_user)->blocked;
    	$user2 = User::find($this->second_user)->blocked;
    	$status = ($user1 || $user2);
    	 return $status;
    }
   
}
