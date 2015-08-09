<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FeedbackRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class FeedbackController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $user = new \App\User;
        if(auth()->check()){
          $user = auth()->user();
        }
        return view('feedback', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(FeedbackRequest $request)
    {

      \App\Feedback::create($request->all());

      $data = array(
                  'name' => $request->input('name')
                  );
      \Mail::send('emails.feedback', $data, function($message) use ($request) {
                  $message->to($request->input('email'), $request->input('name'))->subject('Thanks for feedback!');
            });
      \Mail::send('emails.feedback', $data, function($message) use ($request) {
                  $message->to(\Config::get('mail.admin_email'), $request->input('name'))->subject('Someone left feedback on liverogo! check out');
            });
      flash('Thanks for your valuable feedback.');
      return \Redirect::back();
    }

}
