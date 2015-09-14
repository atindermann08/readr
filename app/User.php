<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token', 'activation_code'];

    public function bookclubs(){
        return $this->belongsToMany('\App\BookClub');
    }
    public function profile(){
        return $this->hasOne('\App\Profile');
    }

    public function books(){
      return $this->belongsToMany('\App\Book')->withPivot('status_id');
    }

    public function givenBooks(){
      return $this->belongsToMany('\App\Book', 'borrowed_books', 'owner_id')->withPivot('book_club_id', 'user_id');
    }

    public function booksInClubs(){
      return $this->belongsToMany('\App\Book', 'book_book_club', 'owner_id')->withPivot('book_club_id', 'owner_id');
    }

    public function ownedclubs(){
      return $this->hasMany('\App\BookClub');
    }

    public function notifications(){
      return $this->hasMany('\App\Notification');
    }

    public function borrowedBooks(){
      return $this->belongsToMany('\App\Book', 'borrowed_books', 'user_id')->withPivot('owner_id', 'book_club_id');
    }

    // public function scopeAvailable($query)
    // {
    //     $statusId = \App\BookStatus::where('name', 'Available')->first()->id;
    //     return $query->where('status_id', $statusId);
    // }
    //
    // public function scopeNotAvailable($query)
    // {
    //     $statusId = \App\BookStatus::where('name', 'Not Available')->first()->id;
    //     return $query->where('status_id', $statusId);
    // }

    public function isMember($bookClubId)
    {
        if(count($this->bookclubs()->where('book_club_id','=',$bookClubId)->get()))
          return true;
        return false;
    }

    public function isBookRequested($bookClubId, $bookId)
    {
      if(auth()->check() && count(\App\RequestBookClubBook::where('book_club_id', '=', $bookClubId)
                                      ->where('book_id', '=', $bookId)
                                      ->where('user_id', '=', auth()->user()->id)
                                      ->get()))
        return true;
      return false;
    }

    public function hasBorrowedBook($bookClubId, $bookId)
    {
        if(count($this->borrowedBooks()->where('book_club_id','=',$bookClubId)->where('book_id', '=', $bookId)->get()))
          return true;
        return false;
    }

  	public function isBorrowed($bookClubId, $bookId)
  	{
  		if($this->givenBooks()->where('book_club_id', $bookClubId)->where('book_id', $bookId)->get()->count())
  		  return true;
      return false;
  	}

  	public function isAvailable($bookClubId, $bookId)
  	{
      // dd($this->borrowedBooks()->get());
      $statusId = \App\BookStatus::where('name', 'Available')->first()->id;
  		if($this->booksInClubs()->where('book_club_id', $bookClubId)->where('book_id', $bookId)->where('status_id', $statusId)->get()->count())
  		  return true;
      return false;
  	}

  	public function isNotAvailable($bookClubId, $bookId)
  	{
      // dd($this->borrowedBooks()->get());
      $statusId = \App\BookStatus::where('name', 'Not Available')->first()->id;
  		if($this->booksInClubs()->where('book_club_id', $bookClubId)->where('book_id', $bookId)->where('status_id', $statusId)->get()->count())
  		  return true;
      return false;
  	}

    public function borrowBook($bookClubId, $bookId, $ownerId)
    {
      $this->borrowedBooks()->detach($bookId);
      return $this->borrowedBooks()->attach($bookId, ['owner_id' => $ownerId, 'book_club_id' => $bookClubId]);
    }

    public function bookRequest($bookClubId, $bookId)
    {
        return \App\RequestBookClubBook::where('book_club_id', '=', $bookClubId)
                                        ->where('book_id', '=', $bookId)
                                        ->where('user_id', '=', auth()->user()->id)
                                        ->first();
    }

    public function isJoinRequestSent($bookClubId)
    {
        if(auth()->check() && count(\App\RequestBookClub::where('book_club_id', '=', $bookClubId)
                                        ->where('user_id', '=', auth()->user()->id)
                                        ->get()))
          return true;
        return false;
    }

    public function isClubAdmin($bookClubId)
    {
      $bookclub = \App\BookClub::with('admin')->findOrFail($bookClubId);
      if(auth()->user()->id == $bookclub->admin->id )
        return true;
      return false;
    }

    public function joinClub($bookClubId)
    {
        $this->bookclubs()->detach($bookClubId);
        return $this->bookclubs()->attach($bookClubId);
    }

    public function sendJoinRequest($bookClubId)
    {
      \App\RequestBookClub::where('book_club_id', '=', $bookClubId)
                                      ->where('user_id', '=', auth()->user()->id)
                                      ->delete();

      $bookclub = \App\BookClub::findOrFail($bookClubId);
      return $bookclub->joinrequests()->create([
            'book_club_id' => $bookClubId,
            'user_id' => auth()->user()->id
            ]);
    }

    public function sendBookRequest($bookClubId ,$bookId, $userId)
    {
      \App\RequestBookClubBook::where('book_club_id', '=', $bookClubId)
                                      ->where('book_id', '=', $bookId)
                                      ->where('user_id', '=', auth()->user()->id)
                                      ->where('owner_id', '=', $userId)
                                      ->delete();

      $bookclub = \App\BookClub::findOrFail($bookClubId);
      return auth()->user()->bookClubBookRequestsSent()->create([
            'book_club_id' => $bookClubId,
            'book_id' => $bookId,
            'owner_id' => $userId,
            ]);
    }

    public function bookClubBookRequestsSent(){
      return $this->hasMany('\App\RequestBookClubBook', 'user_id');
    }

    public function bookClubBookRequestsReceived(){
      return $this->hasMany('\App\RequestBookClubBook', 'owner_id')->get();//->where('type', 'RequestBookClubBook');
    }



    public function joinRequest($bookClubId)
    {
        return \App\RequestBookClub::where('book_club_id', '=', $bookClubId)
                                        ->where('user_id', '=', auth()->user()->id)
                                        ->first();
    }

    public function ownBook($bookId)
    {
        if(count($this->books()->where('book_id','=',$bookId)->get()))
          return true;
        return false;
    }

    public function ownBookClubBook($bookClubId, $bookId)
    {
        if(count(\DB::select('select * from book_book_club where book_id = '.$bookId.' and book_club_id ='.$bookClubId.' and owner_id = '.auth()->user()->id.';')))
          return true;
        return false;
    }

    public function clubJoinRequestsReceived(){
      $bookclubs = $this->ownedclubs()->lists('id');
      $requests = \App\RequestBookClub::whereIn('book_club_id', $bookclubs)->get();

      return $requests;
    }

    public function clubJoinRequestsSent(){
      return $this->hasMany('\App\RequestBookClub');
    }


    public function setProfileImage($image)
    {
      $img = \Image::make($image);

      // resize image
      $img->fit(600, 600);

      // save image
      $path = 'public/assets/images/profiles/' . $user->id . $user->name . '.jpg';
      $img->save($path);
      return $path;
    }


    // public function bookStatusInClub($bookId, $bookClubId)
    // {
    //   $this->belongsToMany('\App\BookClub', 'book_book_club','book_id','book_club_id')
    //             ->where('owner_id',auth()->user()->id)
    //             ->withPivot('owner_id', 'status_id')
    //             ;
    //   $statusId =
    //   $return $statusId;
    // }

//replaced with notification model and relation with user
    // public function notifications()
    // {
    //   $bookclubs = $this->ownedclubs()->lists('id');
    //   $count = \App\RequestBookClub::whereIn('book_club_id', $bookclubs)->get()->count();
    //   $requests = 'Request';
    //
    //   $notifications = [];
    //   if($count)
    //   {
    //     $requests = ($count>1)?'Requests':$requests;
    //     $join_notification = [
    //                       'type' => 'Book Club Joining '.$requests,
    //                       'count' => $count
    //                     ];
    //     $notifications = [$join_notification];
    //   }
    //
    //   return $notifications;
    // }

}
