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
	// public function setStatusIdAttribute($id)
	// {
	// 	$this->attributes['status_id'] = $id?$id:1;
	// }

	// public function setOwnerIdAttribute($id)
	// {
	// 	$this->attributes['owner_id'] = $id?$id:auth()->user()->id;
	// }

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

	public function owners(){
      return $this->belongsToMany('\App\User')->withPivot('status_id');
  }
	public function bookclubs(){
      return $this->belongsToMany('\App\BookClub')->withPivot('owner_id', 'status_id');
  }

	public function status($bookId, $modelType, $modelId){
		$model = $modelType::find($modelId);
		$status_id = $model->books()->where('book_id','=',$bookId)->first()->pivot->status_id;
		$status = \App\BookStatus::find($status_id);
		return $status;
	}
	public function statusInClub($bookId, $clubId)
	{
		return $this->status($bookId, 'App\BookClub', $clubId);
	}
	public function statusWithUser($bookId, $userId = 0)
	{
		if(!$userId && auth()->check()){ $userId = auth()->user()->id; }
		return $this->status($bookId, 'App\User', $userId);
	}

	public function ownerstatus()
	{
		$result = [];
		foreach($this->owners as $owner)
		{
			$result[] = $this->statusWithUser($this->id,$owner->id);
		}
		$result = collect($result)->groupBy('name');

		$statuses = collect();
		foreach ($result as $key => $value) {
			$statuses->put($key ,count($value));
		}
		return $statuses;
	}
	public function clubstatus()
	{
		$result = [];
		foreach($this->bookclubs as $bookclub)
		{
			$result[] = $this->statusInClub($this->id,$bookclub->id);
		}
		$result = collect($result)->groupBy('name');

		$statuses = collect();
		foreach ($result as $key => $value) {
			$statuses->put($key ,count($value));
		}
		return $statuses;
	}

	public function findOrCreateByName($name)
	{
		//to be implemented
		return false;
	}

}
