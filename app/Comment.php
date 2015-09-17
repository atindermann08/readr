<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $touches = ['status'];

    protected $fillable = ['body'];
    public function user(){
        return $this->belongsTo('\App\User');
    }
    public function status(){
        return $this->morphedByMany('\App\Status', 'subject', 'commentables');
    }

    public function likes()
    {
        return $this->morphToMany('\App\User', 'subject', 'likes');
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
