<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class BookRating extends Model
{
  public function books(){
      return $this->hasMany('Book');
  }
}
