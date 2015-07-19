<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

	protected $fillable = ['title','description','author_id','publisher_id','category_id','language_id','release_date','image'];

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

  public function author(){
      return $this->belongsTo('\App\Author');
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
  // public function bookstatuses(){
  //     return $this->hasManyThrough('\App\BookStatus','\App\Bookable','book_id','bookable_id');
  // }
	public function bookstatuses(){
			$statuses = [];
			
	    return $statuses;
	}

  public function owners(){
      return $this->morphedByMany('\App\User','bookable')->withPivot('status_id');
  }
	public function bookclubs(){
      return $this->morphedByMany('\App\BookClub','bookable')->withPivot('status_id');
  }

}
