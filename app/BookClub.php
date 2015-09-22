<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookClub extends Model
{
  protected $fillable = ['name','description','rules','user_id', 'is_closed'];

	public static $rules = [
		'name' => 'required|min:3|unique:book_clubs',
		'description' => 'required|min:10'
	];


  	public function getImageAttribute($image)
  	{
  		if(!$image){
  			return 'assets/default/bookclub.svg';
  		}
  		return $image;
  	}

  public function members(){
      return $this->belongsToMany('\App\User');
  }
  public function books(){
    return $this->belongsToMany('App\Book')->withPivot('status_id', 'owner_id');
  }
  public function admin(){
      return $this->belongsTo('\App\User','user_id');
  }

  public function scopeMy($query)
  {
      return $query->where('owner_id', '=', auth()->user()->id);
  }

  public function joinrequests(){
    return $this->hasMany('\App\RequestBookClub');
  }

  public function bookStatus($bookId)
  {
    return $this->belongsToMany('\App\BookStatus', 'book_book_club','book_club_id','status_id')
                ->where('owner_id',auth()->user()->id)
                ->where('book_id', $bookId)
                ->withPivot('owner_id', 'status_id')->first()
                ;
  }
  public function changeStatus($bookId, $ownerId, $status)
  {
    $statusId = \App\BookStatus::firstOrCreate(['name' => $status])->id;
    \DB::table('book_book_club')
          ->where('book_club_id', $this->id)
          ->where('book_id', $bookId)
          ->where('owner_id', $ownerId)
          ->update(['status_id' => $statusId]);

    return true;
  }



	public function setAvailabe($bookId, $ownerId)
	{
		return $this->changeStatus($bookId, $ownerId, 'Available');
	}

	public function setUnavailabe($bookId, $ownerId)
	{
		return $this->changeStatus($bookId, $ownerId, 'Unavailable');
	}



  public function isMember($user = null)
  {
      if(!$user) $user = auth()->user();
      if(count($user->bookclubs()->where('book_club_id','=',$this->id)->get()))
        return true;
      return false;
  }

}
