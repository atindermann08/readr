<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = ['body'];

    public function user(){
        return $this->belongsTo('\App\User');
    }
    public function likes()
    {
        return $this->morphToMany('\App\User', 'subject', 'likes');
    }

    public function comments()
    {
        return $this->morphToMany('\App\Comment', 'subject', 'commentables');
    }

    public function isLiked()
    {
      return $this->isLikedBy(auth()->user());
    }
    public function isLikedBy($user)
    {
      if(count($this->likes()->where('user_id',$user->id)->get()))
        return true;
      return false;
    }
}
