<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

  public function getImageAttribute($image)
  {
    if(!$image){
      return 'assets/profile-images/profile.svg';
    }
    return $image;
  }

  public function getThumbImageAttribute($image)
  {
      if(!$image){
        return 'assets/profile-images/profile.svg';
      }
      return $image;
  }

  public function user(){
      return $this->belongsTo('\App\User');
  }
}
