<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestBookClub extends Model
{
    protected $fillable = ['book_club_id','user_id'];

    public function requestee(){
      return $this->belongsTo('\App\User', 'user_id');
    }

    // public function owner(){
    //   return $this->belongsTo('\App\User', 'owner_id');
    // }

    public function bookclub(){
      return $this->belongsTo('\App\BookClub', 'book_club_id');
    }
}
