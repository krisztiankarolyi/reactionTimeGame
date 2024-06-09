<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    public $timestamps = false;
    protected $table = 'reports';

     protected $fillable = ['reporterid', 'reportedid', 'details', 'date'];

      public function reporter()
    {
       return $this->hasOne( User::class, 'id', 'reporterid' );
    }

       public function reported()
    {
       return $this->hasOne( User::class, 'id', 'reportedid' );
    }
}
