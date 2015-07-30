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
      return $this->belongsToMany('App\Book')->withPivot('status_id');
    }

    public function ownedclubs(){
      return $this->hasMany('App\BookClub');
    }


    public function isMember($bookClubId)
    {
        if(count($this->bookclubs()->where('book_club_id','=',$bookClubId)->get()))
          return true;
        return false;
    }

    public function isJoinRequestSent($bookClubId)
    {
        if(auth()->check() && count(\App\RequestBookClub::where('book_club_id', '=', $bookClubId)
                                        ->where('user_id', '=', auth()->user()->id)
                                        ->get()))
          return true;
        return false;
    }
    public function joinRequest($bookClubId)
    {
        return \App\RequestBookClub::where('book_club_id', '=', $bookClubId)
                                        ->where('user_id', '=', auth()->user()->id)
                                        ->first();
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
      $bookclub->joinrequests()->create([
            'book_club_id' => $bookClubId,
            'user_id' => auth()->user()->id
            ]);
    }


    public function ownBook($bookId)
    {
        if(count($this->books()->where('book_id','=',$bookId)->get()))
          return true;
        return false;
    }

    public function clubJoinRequestsReceived(){
      return $this->hasMany('\App\RequestBookClub');
    }

    public function clubJoinRequestsSent(){
      return $this->hasMany('\App\RequestBookClub');
    }

    public function notifications()
    {
      $bookclubs = $this->ownedclubs()->lists('id');
      $count = \App\RequestBookClub::whereIn('user_id', $bookclubs)->get()->count();
      $requests = 'Request';

      $notifications = [];
      if($count)
      {
        $requests = ($count>1)?'Requests':$requests;
        $join_notification = [
                          'type' => 'Book Club Joining '.$requests,
                          'count' => $count
                        ];
        $notifications = [$join_notification];
      }

      // foreach($this->ownedclubs as $bookclub)
      // {
      //
      // }
      // dd($notifications);
      return $notifications;
    }

}
