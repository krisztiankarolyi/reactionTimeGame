<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Game;

class Record extends Model
{

    public $timestamps = false;
    protected $table = 'records';

    protected $fillable = ['userid', 'gameid', 'score', 'date'];

     public function game()
    {
       return $this->hasOne( Game::class, 'id', 'gameid' );
    }

      public function user()
    {
       return $this->hasOne( User::class, 'id', 'userid' );
    }

}
