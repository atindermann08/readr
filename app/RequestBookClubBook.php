<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestBookClubBook extends Model
{
      protected $fillable = ['book_club_id','user_id', 'owner_id', 'book_id'];

      public function requestee(){
        return $this->belongsTo('\App\User', 'user_id');
      }

      // public function owner(){
      //   return $this->belongsTo('\App\User', 'owner_id');
      // }

      public function bookclub(){
        return $this->belongsTo('\App\BookClub', 'book_club_id');
      }

      public function owner(){
        return $this->belongsTo('\App\User', 'owner_id');
      }
      public function book(){
        return $this->belongsTo('\App\Book', 'book_id');
      }
}
