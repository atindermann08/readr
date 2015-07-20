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
    protected $hidden = ['password', 'remember_token'];

    public function bookclubs(){
        return $this->belongsToMany('\App\BookClub');
    }
    public function profile(){
        return $this->hasOne('\App\Profile');
    }

    public function books(){
      return $this->morphToMany('App\Book', 'bookable')->withPivot('status_id');
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

    public function ownBook($bookId)
    {
        if(count($this->books()->where('book_id','=',$bookId)->get()))
          return true;
        return false;
    }

    public function activate($code)
    {
      $user = $this->where('activation_code','=',$code)->first();
      // if($user)
      // {
        $user->active = 1;
        $user->activation_code = '';

        if($user->save())
        {
            \Auth::login($user);
            \Mail::send('emails.welcome', ['name' => $user->name], function($message) use ($user) {
                        $message->to($user->email, 'Account activated successfully!');
                  });
        }

        return true;
      // }
      return false;
    }
}
