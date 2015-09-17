<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
<<<<<<< HEAD

  public function getImageAttribute($image)
  {
    if(!$image){
      return 'assets/img/book.jpg';
    }
    return $image;
  }

  public function getThumbImageAttribute($image)
  {
      if(!$image){
        return 'assets/img/book.jpg';
      }
      return $image;
  }

=======
  
>>>>>>> status post and view
  public function user(){
      return $this->belongsTo('\App\User');
  }
}
