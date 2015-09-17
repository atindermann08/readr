<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\StatusSubmitRequest;
use App\Http\Requests\CommentPostRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Status;

class DiscussionController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {
      $statuses = Status::with('likes', 'comments.user', 'user.profile')->latest('updated_at')->get();
      return view('discussions.index')->with(compact('statuses'));
    }

    public function store(StatusSubmitRequest $request)
    {
      $status = \App\Status::create($request->all());
      auth()->user()->statuses()->save($status);
      flash()->success('Posted Successfully');
      return redirect()->back();
    }


    public function likeStatus($statusId)
    {
      auth()->user()->likedStatuses()->detach($statusId);
      auth()->user()->likedStatuses()->attach($statusId);
      flash()->success('You Liked Status');
      return redirect()->back();
    }

    public function unlikeStatus($statusId)
    {
      auth()->user()->likedStatuses()->detach($statusId);
      flash('You Unliked Status');
      return redirect()->back();
    }

    public function likeComment($statusId)
    {
      auth()->user()->likedComments()->detach($statusId);
      auth()->user()->likedComments()->attach($statusId);
      flash()->success('You Liked Status');
      return redirect()->back();
    }

    public function unlikeComment($statusId)
    {
      auth()->user()->likedComments()->detach($statusId);
      flash('You unliked Status');
      return redirect()->back();
    }

    public function storeComment($statusId, CommentPostRequest $request)
    {
      $comment = \App\Comment::create($request->all());
      auth()->user()->statusComments()->save($comment);
      // $status = \App\Status::findOrFail($statusId);
      // $status->comments()->attach($comment->id);
      $comment->status()->attach($statusId);

      flash()->success('Comment Posted Successfuly');
      return redirect()->back();
    }
}
