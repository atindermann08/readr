<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Http\Requests\PasswordUpdateRequest;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['getChange', 'postChange']]);
    }

    public function getChange()
    {
      return view('auth.updatepassword');
    }


    public function postChange(PasswordUpdateRequest $request)
    {
      if(\Hash::check($request->input('current_password'), auth()->user()->password))
      {
        auth()->user()->password = crypt($request->input('new_password'));
        auth()->user()->save();
        flash()->success('Password updated successfully.');
        return \Redirect::back();
      }
      flash()->error('Please try again with correct current password.');
      return \Redirect::back();
    }

}
