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
      $bookclub = \App\BookClub::findOrFail($id);
      $books = $user->books->lists('title', 'id');
      $show_route = 'bookclubs.books.show';
      return view('bookclubs.show')
              ->with(compact('bookclub','user', 'books', 'show_route'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $bookclub = \App\BookClub::findOrFail($id);
        $books = \Auth::user()->books()->lists('title','title');
        return view('bookclubs.edit',compact('books', 'bookclub'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        $bookclub = \App\BookClub::findOrFail($id);

        $request['is_closed'] = $request->input('is_closed', 0);
        $bookclub->update($request->all());


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
        flash('Book Club updated.');
        return \Redirect::back();
    }


    public function requestbook($bookId, $bookclubId)
    {
        flash('To be implemented.. Thanks for your patience');
      return \Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function showbook($bookClubId, $bookId)
    {
      //return \App\Book::
        $user = auth()->check()?auth()->user():new \App\User;
        $book = \App\Book::with('authors','publisher','category', 'language')->findOrFail($bookId);
        $statuses = $book->clubstatus();
        $bookclub = \App\BookClub::findOrFail($bookClubId);
        $request_route = 'bookclubs.books.requestbook';
        return view('bookclubs.books.show')
              ->with(compact('book', 'bookclub' ,'user', 'statuses', 'request_route'));
    }

    /**
     *
     *
     * @param  int  $id
     * @return Response
     */
    public function joinclub($bookClubId)
    {
      //check for open and closed club and if closed create request to be approved by admin
        // auth()->user()->joinClub($bookClubId);

        $bookclub = \App\BookClub::findOrFail($bookClubId);
        if($bookclub->is_closed)
        {
          auth()->user()->sendJoinRequest($bookClubId);
          flash('Request sent for joining BookClub.');
          return \Redirect::back();
        }
        else {
          auth()->user()->joinClub($bookClubId);
          flash('Book Club Joined. Add your book collection to share with other members.');
          return redirect()->route('bookclubs.books.add',$bookClubId);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function addBooks($bookClubId)
    {
        $bookclub = \App\BookClub::findOrFail($bookClubId);
        $books = auth()->user()->books;
        return view('bookclubs.books.add')
              ->with(compact('bookclub', 'books'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function acceptJoinRequest($requestId)
    {
        $request = \App\RequestBookClub::with('requestee')->findOrFail($requestId);
        $request->requestee->joinClub($request->book_club_id);
        $request->delete();
        //fire event send mail;
        flash('Request Accepted succesfully.');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function rejectJoinRequest($requestId)
    {
        \App\RequestBookClub::findOrFail($requestId)->delete();
        flash('Request Rejected succesfully.');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function storeBooks($bookClubId, Request $request)
    {
        $bookclub = \App\BookClub::findOrFail($bookClubId);
        $status_id = \App\BookStatus::firstOrCreate(['name' => 'Available'])->id;

        $bookIds = $request->input('bookIds');
        // dd($request->all());
        foreach($bookIds as $bookId)
        {
          $bookclub->books()->detach($bookId);
          $bookclub->books()->attach($bookId, ['status_id' => $status_id, 'owner_id' => auth()->user()->id]);
        }
        flash('Books added successfully.');
        return redirect()->back();
    }
}
