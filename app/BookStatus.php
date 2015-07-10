<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookStatus extends Model
{
  public function book(){
      return $this->hasMany('Book');
  }
}
