
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

	public static $rules = [
		'title' => 'required|min:3|unique:books',
		'description' => 'required|min:10',
    'author' => 'required',
    'publisher' => 'required',
    'category' => 'required',
    'language' => 'required',
    'release_date' => 'required',
    'photo' => 'required',
	];

  /*
  * Relationships
  */
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

  public function users(){
      return $this->belongsToMany('User');
  }
  public function bookclubs(){
      return $this->belongsToMany('BookClub');
  }
}
