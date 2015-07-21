<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['getLogout','activateAccount']]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }


    public function postRegister(Request $request)
    {
        //return \Redirect::back()->with('message','register function hijacked');
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $activation_code = str_random(60);

        $user = new \App\User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->activation_code = $activation_code;

        if ($user->save()) {
          $data = array(
                      'name' => $user->name,
                      'code' => $activation_code,
                      );
          \Mail::send('emails.activate', $data, function($message) use ($user) {
                      $message->to($user->email, $user->name)->subject('Please activate your account.');
                });
          \Auth::login($user);
          return view('auth.activate');
        }
        else {
          flash('Your account couldn\’t be created please try again');
          return redirect()->back()->withInput();
        }
    }

    public function activateAccount($activationCode)
    {
      $user = \App\User::where('activation_code','=',$activationCode)->first();
      if($user)
      {
        $user->active = 1;
        $user->activation_code = '';

        if($user->save())
        {
            \Auth::login($user);
            \Mail::send('emails.welcome', ['name' => $user->name], function($message) use ($user) {
                        $message->to($user->email,  $user->name)->subject('Account activated successfully!');
                  });
            flash('Congrats, Your account activated successfully.');
            return redirect('/');
        }

      }
      flash('Account could not be activated, please try again.');
      return redirect('/');
    }
}
