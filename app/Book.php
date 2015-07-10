<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

  public function category(){
      return $this->belongsTo('Category');
  }

  public function authors(){
      return $this->belongsToMany('Author');
  }
  public function language(){
      return $this->belongsTo('Language');
  }
  public function bookstatus(){
      return $this->belongsTo('BookStatus');
  }
  public function bookrating(){
      return $this->belongsTo('BookRating');
  }

  public function bookclubs(){
      return $this->belongsToMany('BookClub');
  }
}
