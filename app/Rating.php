<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
   public function article()
   {
      return $this->belongsTo('App\Article');
   }
}
