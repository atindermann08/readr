<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\StatusSubmitRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Status;

class DiscussionController extends Controller
{
    public function index()
    {
      $statuses = Status::with('user.profile')->get();
      return view('discussions')->with(compact('statuses'));
    }

    public function store(StatusSubmitRequest $request)
    {
      $status = \App\Status::create($request->all());
      auth()->user()->statuses()->save($status);
      flash()->success('Posted Successfully');
      return redirect()->back();
    }
}
