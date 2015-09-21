<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {
      $profile = auth()->user()->profile;
      $user = auth()->user();
      return view('profile.show')->with(compact('profile', 'user'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        // view('profile.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
      $profile = auth()->user()->profile;
      $user = auth()->user();
      return view('profile.edit')->with(compact('profile', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, ProfileUpdateRequest $request)
    {
        // // dd($request);
        // if(!$request->file('image')->isValid()){
        //   flash()->error('File not uploaded');
        //   return \Redirect::back();
        // }
        $user = auth()->user();
        $profile = $user->profile;
        $user->name = $request->input('name');
        $profile->mobile = $request->input('mobile');
        $profile->about = $request->input('about');

        if($request->hasFile('image')){
          $this->setProfileImage($profile, $request);
        }
        $profile->save();
        $user->save();

        flash()->success('Profile Successfully updated.');
        return \Redirect::route('profile.index');
    }

    private function setProfileImage($profile, ProfileUpdateRequest $request)
    {
      $path = 'assets/profile-images/' . auth()->user()->id . '_large.jpg';
      $image = $request->file('image')->move(public_path('assets/profile-images/'), auth()->user()->id . '_large.jpg');

        try {
            $img = \Image::make($image->getRealPath());//, auth()->user()->id . '_large.jpg');
            // $file = Input::file('image');
            // // ...
            $filename = $image->getRealPath() . auth()->user()->id . '_large.jpg';
            // Image::make($file->getRealPath());;
            $img->fit(200, 200);
            $img->save($filename);
        } catch (Exception $e) {
            flash($path);
            return Redirect::back()->withErrors('Error: ' . $e->getMessage());
        }
        $thumb_path = 'assets/profile-images/' . auth()->user()->id . '_thumb.jpg';
        $img->fit(35, 35);
        $img->save($thumb_path);

      // $path = $user->setProfileImage($image);
      $profile->image = $path;
      $profile->thumb_image = $thumb_path;
      $profile->save();
    }

}
