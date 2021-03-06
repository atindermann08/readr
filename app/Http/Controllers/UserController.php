<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{


    /**
     * Show the form for registring new user.
     *
     * @return Response
     */
    public function create()
    {
        return "Register here";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the user profile.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return "User profile of ".$id;
    }

    /**
     * Show the form for editing the user profile.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified user profile in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }


    /**
    * show login form.
    *
    * @param  int  $id
    * @return Response
    */
    public function login()
    {
      return view("users.login");

    }


    /**
    * perform login.
    *
    * @param  int  $id
    * @return Response
    */
    public function doLogin()
    {

    }

    /**
    * perform login.
    *
    * @param  int  $id
    * @return Response
    */
    public function showNotifications()
    {
      $clubRequests = auth()->user()->clubJoinRequestsReceived();
      $bookRequests = auth()->user()->bookClubBookRequestsReceived();
      // dd($bookRequests);
      // $requests->load('bookclub', 'requestee');
      // return ($requests);
      return view('notifications')
                ->with(compact('clubRequests', 'bookRequests'));
    }

}
