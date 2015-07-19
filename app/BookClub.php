<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookClub extends Model
{
  protected $fillable = ['name','description','rules','user_id'];

	public static $rules = [
		'name' => 'required|min:3|unique:book_clubs',
		'description' => 'required|min:10'
	];

  public function members(){
      return $this->belongsToMany('\App\User');
  }
  public function books(){
    return $this->morphToMany('App\Book', 'bookable')->withPivot('status_id');
  }
  public function admin(){
      return $this->belongsTo('\App\User');
  }
}
