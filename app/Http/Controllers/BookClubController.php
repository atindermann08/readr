<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BookClubRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class BookClubController extends Controller
{

    public function __construct(){
      $this->middleware('auth', ['except' => ['index' , 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
      $bookclubs = \App\BookClub::with('books','members','admin')
                                  ->orderBy('user_id')
                                  ->get();
      // return response()->json($bookclubs);
      return view('bookclubs.index')
              ->with('bookclubs' , $bookclubs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
      $books = \Auth::user()->books()->lists('title','title');
      return view('bookclubs.create',compact('books'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(BookClubRequest $request)
    {
      // return $request->all();
      $request['user_id'] = auth()->user()->id;
      $request['is_closed'] = $request->input('is_closed', 0);
      $bookclub = \Auth::user()->bookclubs()->create($request->all());

      //$status_id = \App\BookStatus::findOrCreate(['name' => 'Available'])->id;
      //$bookclub->books()->attach($request->input('books'),['status_id' => $status_id]);

      $titles = $request->input('books');
      $status_id = \App\BookStatus::firstOrCreate(['name' => 'Available'])->id;
      if($titles){
        foreach ($titles as $title) {
          $book = \App\Book::firstOrCreate(['title' => ucfirst($title)]);
          auth()->user()->books()->detach($book->id);
          auth()->user()->books()->attach($book->id, ['status_id' => $status_id]);

          $bookclub->books()->detach($book->id);
          $bookclub->books()->attach($book->id, ['status_id' => $status_id, 'owner_id' => auth()->user()->id]);
        }
      }
      flash('Book Club Created.');
      return \Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
      $user = auth()->check()?auth()->user():new \App\User;
      $bookclub = \App\BookClub::find($id);
      if($bookclub){

        return view('bookclubs.show')
        ->with(compact('bookclub','user'));
      }

      flash()->error('Book Club does not exist.');
      return \Redirect::back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     *
     *
     * @param  int  $id
     * @return Response
     */
    public function joinclub($bookClubId)
    {
        auth()->user()->bookclubs()->attach($bookClubId);

        flash('Book Club Joined.');

        return \Redirect::back();
    }

    public function requestbook($bookId, $bookclubId)
    {
        flash('To be implemented.. Thanks for your patience');
      return \Redirect::back();
    }


}
