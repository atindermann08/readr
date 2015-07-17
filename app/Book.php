<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

	protected $fillable = ['name','description','author_id','publisher_id','category_id','language_id','realease_date','image'];

	public static $rules = [
		'title' => 'required|min:3|unique:books',
		'description' => 'required|min:10',
    'author' => 'required',
    'publisher' => 'required',
    'category' => 'required',
    'language' => 'required',
    'release_date' => 'required|date',
	];

	public function setReleaseDateAttribute($date)
	{
		$this->attributes['release_date'] = Carbon::parse($date);
	}

  /*
  * Relationships
  */
  public function category(){
      return $this->belongsTo('\App\Category');
  }
	public function publisher(){
      return $this->belongsTo('\App\Publisher');
  }
  public function authors(){
      return $this->belongsToMany('\App\Author');
  }
  public function language(){
      return $this->belongsTo('\App\Language');
  }
  public function bookstatus(){
      return $this->belongsTo('\App\BookStatus');
  }
  public function bookrating(){
      return $this->belongsTo('\App\BookRating');
  }

  public function users(){
      return $this->belongsToMany('\App\User');
  }
  public function bookclubs(){
      return $this->belongsToMany('\App\BookClub');
  }
}
