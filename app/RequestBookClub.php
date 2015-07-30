<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestBookClub extends Model
{


    public function requestee(){
      return $this->belongsTo('\App\User');
    }

    public function owner(){
      return $this->belongsTo('\App\User', 'owner_id');
    }

    public function bookclub(){
      return $this->belongsTo('\App\BookClub');
    }
}
