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

          \DB::table('book_book_club')
                ->where('book_club_id', $bookclub->id)
                ->where('book_id', $book->id)
                ->where('owner_id', auth()->user()->id)
                ->delete();
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

            \DB::table('book_book_club')
                  ->where('book_club_id', $bookclub->id)
                  ->where('book_id', $book->id)
                  ->where('owner_id', auth()->user()->id)
                  ->delete();
            $bookclub->books()->attach($book->id, ['status_id' => $status_id, 'owner_id' => auth()->user()->id]);
          }
        }
        flash('Book Club updated.');
        return \Redirect::back();
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function showBook($bookClubId, $bookId)
    {
      //return \App\Book::
        $user = auth()->check()?auth()->user():new \App\User;
        $book = \App\Book::with('authors','publisher','category', 'language')->findOrFail($bookId);
        $statuses = $book->clubStatus($bookClubId);
        $bookclub = \App\BookClub::findOrFail($bookClubId);
        $request_route = 'bookclubs.books.requestbook';
        $book_statuses = \App\BookStatus::all()->lists('name', 'id');
        return view('bookclubs.books.show')
              ->with(compact('book', 'bookclub' ,'user', 'statuses', 'request_route', 'book_statuses'));
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
          $request = auth()->user()->sendJoinRequest($bookClubId);

          //generate Notification later extract and make use of events
          $notification = $bookclub->admin->notifications()->create([
              'text' => auth()->user()->name . ' sent request to join ' . $bookclub->name,
              'url' => route('notifications'),
              'request_id' => $request->id,
              'type' => 'RequestBookClub',
              'is_read' => false
            ]);
          $notification->save();

          $data = array(
                      'name' =>  $bookclub->admin->name,
                      'requesteeName' => auth()->user()->name,
                      'bookClubName' => $bookclub->name,
                      );

          \Mail::send('emails.bookclubs.joinrequest.received', $data, function($message) use ( $bookclub) {
                      $message->to($bookclub->admin->email, $bookclub->admin->name)
                              ->subject('Hi ' . $bookclub->admin->name . ', ' . auth()->user()->name . 'wants to join ' . $bookclub->name . ' BookClub.');
                });


          flash('Request sent for joining BookClub.');
          return \Redirect::back();
        }
        else
        {
          auth()->user()->joinClub($bookClubId);
          flash('Book Club Joined. Add your book collection to share with other members.');
          return redirect()->route('bookclubs.show',$bookClubId);
        }
    }


    public function requestbook($bookClubId, $bookId, $userId)
    {
        $bookclub = \App\BookClub::findOrFail($bookClubId);
        $book = \App\Book::findOrFail($bookId);
        if($bookclub->isMember())
        {
          $request = auth()->user()->sendBookRequest($bookClubId, $bookId, $userId);
          $owner = \App\User::findOrFail($userId);
          //generate Notification later extract and make use of events
          $notification = $owner->notifications()->create([
              'text' => auth()->user()->name.' sent request for ' . $book->title . $bookclub->name . ' in book club.',
              'url' => route('notifications'),
              'type' => 'RequestBookClubBook',
              'request_id' => $request->id,
              'is_read' => false
            ]);
          $notification->save();

          $data = array(
                      'name' =>  $owner->name,
                      'requesteeName' => auth()->user()->name,
                      'bookName' => $book->name,
                      'bookClubName' => $bookclub->name,
                      );

          \Mail::send('emails.bookclubs.bookrequest.received', $data, function($message) use ($owner, $book, $bookclub) {
                      $message->to($owner->email, $owner->name)->subject('Hi '. $owner->name . ', ' . auth()->user()->name . ' wants to borrow ' . $book->name . ' in ' . $bookclub->name . ' BookClub.');
                });

          flash('Request sent for Book.');
          return \Redirect::back();
        }
        else
        {
          flash('You need to join this club before requesting books.');
          return redirect()->back();
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
        //fire event send mail;
        //generate Notification later extract and make use of events
        \App\Notification::where('request_id', $request->id)->first()->delete();
        $notification = $request->requestee->notifications()->create([
            'text' => 'Your request to join '.$request->bookclub->name.' was accepted.',
            'url' => route('notifications.destroy', 1),
            'is_read' => false
          ]);
        $notification->url = route('notifications.destroy', $notification->id);
        $notification->save();
        $request->delete();


        $data = array(
                    'name' => $request->requestee->name,
                    'bookClubName' => $request->bookclub->name,
                    'bookClubId' => $request->bookclub->id,
                    );

        \Mail::send('emails.bookclubs.joinrequest.accepted', $data, function($message) use ($request) {
                    $message->to($request->requestee->email, $request->requestee->name)
                            ->subject('Hi ' . $request->requestee->name . ' Your BookClub Joining request Accepted!');
              });

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
        $request = \App\RequestBookClub::findOrFail($requestId);
        \App\Notification::where('request_id', $requestId)->first()->delete();
        $notification = $request->requestee->notifications()->create([
            'text' => 'Your request to join '.$request->bookclub->name.' was rejected or canceled.',
            'url' => route('notifications.destroy', 1),
            'is_read' => false
          ]);
        $notification->url = route('notifications.destroy', $notification->id);
        $notification->save();
        // dd($notification);

        $request->delete();
        //generate Notification later extract and make use of events


        flash('Request Rejected succesfully.');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function acceptBookRequest($requestId)
    {
        $request = \App\RequestBookClubBook::with('requestee')->findOrFail($requestId);
        $request->requestee->borrowBook($request->book_club_id, $request->book->id, $request->owner->id);
        //fire event send mail;
        //generate Notification later extract and make use of events
        \App\Notification::where('request_id', $request->id)->first()->delete();
        $notification = $request->requestee->notifications()->create([
            'text' => 'Your request for ' . $request->book->title . ' from BookClub ' . $request->bookclub->name . ' was accepted.',
            'url' => route('notifications.destroy', 1),
            'is_read' => false
          ]);
        $notification->url = route('notifications.destroy', $notification->id);
        $notification->save();

        $book = $request->bookclub->changeStatus($request->book->id, $request->owner->id, 'Not Available');


        $data = array(
                    'name' => $request->requestee->name,
                    'bookName' => $request->book->name,
                    'ownerName' => auth()->user()->name,
                    );

        \Mail::send('emails.bookclubs.bookrequest.accepted', $data, function($message) use ($request) {
                    $message->to($request->requestee->email, $request->requestee->name)
                            ->subject('Hi ' . $request->requestee->name . ' Your request for ' . $request->book->name . ' is accepted!');
              });

        $request->delete();
        flash('Request Accepted succesfully.');
        return redirect()->back();
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function bookReceived($bookClubId, $bookId, $ownerId)
    {
      $bookclub = \App\BookClub::findOrFail($bookClubId);
      $bookclub->changeStatus($bookId, $ownerId, 'Available');
      auth()->user()->givenBooks()->where('book_club_id', $bookClubId)->detach($bookId);
      flash('Book Received succesfully.');
      return redirect()->back();
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function rejectBookRequest($requestId)
    {
        $request = \App\RequestBookClubBook::findOrFail($requestId);
        \App\Notification::where('request_id', $requestId)->first()->delete();
        $notification = $request->requestee->notifications()->create([
            'text' => 'Your request for ' . $request->book->title . ' from BookClub ' . $request->bookclub->name . ' was rejected or canceled.',
            'url' => route('notifications.destroy', 1),
            'is_read' => false
          ]);
        $notification->url = route('notifications.destroy', $notification->id);
        $notification->save();
        // dd($notification);

        $request->delete();
        //generate Notification later extract and make use of events


        flash('Request Rejected succesfully.');
        return redirect()->back();
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function storeBook($bookClubId, Request $request)
    {
        $bookclub = \App\BookClub::findOrFail($bookClubId);
        $status_id = \App\BookStatus::firstOrCreate(['name' => 'Available'])->id;

        $bookIds = $request->input('bookIds');
        // dd($request->all());
        foreach($bookIds as $bookId)
        {
          \DB::table('book_book_club')
                ->where('book_club_id', $bookClubId)
                ->where('book_id', $bookId)
                ->where('owner_id', auth()->user()->id)
                ->delete();

          $bookclub->books()->attach($bookId, ['status_id' => $status_id, 'owner_id' => auth()->user()->id]);
        }
        flash('Books added successfully.');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function removeBook($bookClubId, $bookId, Request $request)
    {
        $bookclub = \App\BookClub::findOrFail($bookClubId);
        \DB::table('book_book_club')
              ->where('book_club_id', $bookClubId)
              ->where('book_id', $bookId)
              ->where('owner_id', auth()->user()->id)
              ->delete();

        flash('Book removed from club');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function bookStatusUpdate($bookClubId, $bookId, Request $request)
    {
      $statusId = $request->input('book_status');
      // dd($statusId);
        \DB::table('book_book_club')
              ->where('book_club_id', $bookClubId)
              ->where('book_id', $bookId)
              ->where('owner_id', auth()->user()->id)
              ->update(['status_id' => $statusId]);

        flash('Book status updated');
        return redirect()->back();
    }
}
