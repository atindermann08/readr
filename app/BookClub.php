<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookClub extends Model
{
  public function users(){
      return $this->belongsToMany('User');
  }
  public function books(){
      return $this->belongsToMany('Book');
  }
}
