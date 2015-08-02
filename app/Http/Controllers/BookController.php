<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Http\Requests;
use App\Http\Requests\BookRequest;
use App\Http\Controllers\Controller;

class BookController extends Controller
{


    public function __construct(){
      $this->middleware('auth', ['except' => ['index', 'show' ]]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
      $books = \App\Book::with('authors','language','category','publisher','owners')->get();

      $show_route = 'books.show';
      // $authors = \App\Author::all();
      // $publishers = \App\Publisher::all();
      // $categories = \App\Category::all();
      // $languages = \App\Language::all();
      // return response()->json(\App\Book::first()->clubstatus());
      return view('books.index')
        ->with('book_clickable', true)
        ->with(compact('books','show_route'));
        // ->with('authors' , $authors)
        // ->with('publishers' , $publishers)
        // ->with('categories' , $categories)
        // ->with('languages' , $languages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
      $books = \App\Book::all()->lists('title', 'title');
      // $authors = \App\Author::all()->lists('name','id');
      // $publishers = \App\Publisher::all()->lists('name','id');
      // $categories = \App\Category::all()->lists('name','id');
      // $languages = \App\Language::all()->lists('name','id');
      //
      $bookclubs = \Auth::user()->bookclubs()->lists('name','id');

      return view('books.create')
        ->with(compact('books'))
        // ->with('authors' , $authors)
        // ->with('publishers' , $publishers)
        // ->with('categories' , $categories)
        // ->with('languages' , $languages)
        ->with(compact('bookclubs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(BookRequest $request)
    {
      $titles = $request->input('titles');
      // $bookclubs = $request->get('bookclubs');
      // $bookIds = [];

      $status_id = \App\BookStatus::firstOrCreate(['name' => 'Available'])->id;
      if(count($titles)){
        foreach ($titles as $title) {
          $book = \App\Book::firstOrCreate(['title' => ucfirst($title)]);

          auth()->user()->books()->detach($book->id);
          auth()->user()->books()->attach($book->id, ['status_id' => $status_id]);

          //send mail to user for added books and adding details

          //$bookIds[] =  $bookId => ['status_id' => $status_id];
          // foreach ($bookclubs as $bookclub) {
          //   $book->bookclubs()->detach($bookclub);
          //   $book->bookclubs()->attach($bookclub,['owner_id' => auth()->user()->id]);
          // }
        }
      }
      else
      {
        flash()->error('Please enter atleast one Book Title');
        return \Redirect::back();
      }

      flash('Book/Books added to your library.');
      return \Redirect::back();
      /***
      // $book = \App\Book::where('title','=',$request->input('title'))->first();
      // if($book)
      // {
      //   flash('This book already exits add it to your library.');
      //   return \Redirect::route('books.show',$book->id);
      // }
      // $request['author_id'] = auth()->user()->id;

      // Convert comma separated string into array of author names
      // $authors = explode(',',$request->get('author'));

      //going over author names build up array of author ids by getting author ids and creating author if does not exist
      // $authorIds = [];
      // foreach ($authors as $author) {
        // $authorIds[] =  App\Author::firstOrCreate(['name' => ucfirst($author)])->id;
      // }
      // $request['author_id']  = App\Author::firstOrCreate(['name' => ucfirst(\Input::get('author'))])->id;
      // $request['publisher_id'] = App\Publisher::firstOrCreate(['name' => ucfirst(\Input::get('publisher'))])->id;
      // $request['category_id'] = App\Category::firstOrCreate(['name' => ucfirst(\Input::get('category'))])->id;
      // $request['language_id'] = App\Language::firstOrCreate(['name' => ucfirst(\Input::get('language'))])->id;


      //create book
      // $book = auth()->user()->books()->create($request->all(),['status_id' => $status_id]);

      //atached book to authors
      // $book->authors()->attach($authorIds);

      //attach book to book clubs
      // $book->bookclubs()->attach($request->input('bookclubs'),['status_id' => $status_id]);

      // flash('Book added.');
      // return \Redirect::back();
      ***/
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
      //return \App\Book::
        $user = auth()->check()?auth()->user():new \App\User;
        $book = App\Book::with('authors','publisher','category', 'language')->findOrFail($id);
        $statuses = collect([]);//$book->ownerstatus();
        $request_route = 'books.request';
        $bookclubs = $book->bookclubs()->my()->get();

        $book_statuses = \App\BookStatus::all()->lists('name', 'id');
        // dd($bookclubs);
        return view('books.show')
              ->with(compact('book', 'bookclubs', 'user', 'statuses', 'request_route', 'book_statuses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
      $book = \App\Book::with('authors','publisher','category', 'language')->findOrFail($id);
      $authors = \App\Author::all()->lists('name','name');
      $book_authors = $book->authors()->lists('name');
      // return $book_authors;
      return view('books.edit')
              ->with(compact('book'))
              ->with(compact('authors','book_authors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        $book = \App\Book::findOrFail($id);

        // $book->update(\Input::all());
        // return \Redirect::back()->with('message','Book updated.');
        // if($book){
          // $rules = \App\Book::$rules;
          //$rules['name'] = 'required|min:2';
          // $validator = \Validator::make(\Input::all(), $rules);

          // if($validator->passes())
          // {
            $book->description = $request->description;
            $book->publisher_id = \App\Publisher::firstOrCreate(['name' => ucfirst($request->publisher)])->id;
            $book->category_id = \App\Category::firstOrCreate(['name' => ucfirst($request->category)])->id;
            $book->language_id = \App\Language::firstOrCreate(['name' => ucfirst($request->language)])->id;
            $book->release_date = $request->release_date;
            $book->save();

            //going over author names build up array of author ids by getting author ids and creating author if does not exist
            $authorIds = [];
            $authors = $request->authors;
            if($authors){
              foreach ($authors as $author) {
                $authorIds[] =  App\Author::firstOrCreate(['name' => ucfirst($author)])->id;
              }
              //atached book to authors
              $book->authors()->sync($authorIds);
              // $book->authors()->attach($authorIds);
            }

            flash('Book updated.');
            return \Redirect::back();
        //   }
        //   return \Redirect::back()
        //     //->with('message','There were some errors. Please try again later..')
        //     ->withInput()
        //     ->withErrors($validator);
        //   }
        //
        //   flash()->error('Book does not exist.');
        // return \Redirect::back();
    }


    public function addtolibrary($bookId)
    {
          $status_id = \App\BookStatus::where('name','=','Available')->first()->id;
          auth()->user()->books()->attach($bookId,['status_id'=>$status_id]);

          flash('Book added to library.');
          return \Redirect::back();
    }

    public function removefromlibrary($bookId)
    {
          auth()->user()->books()->detach($bookId);

          flash('Book removed from library.');
          return \Redirect::back();
    }


    public function request($bookId)
    {
        flash('To be implemented.. Thanks for your patience');
        return \Redirect::back();
    }

    public function mylibrary()
    {
        $mybooks = auth()->user()->books;
        $books = \App\Book::all()->lists('title', 'title');
        //$books = array_except($books, $mybooks->lists('id'));
        return view('mylibrary')
                ->with(compact('books'))
                ->with(compact('mybooks'));
    }
    public function apiBooks()
    {
        $books = \App\Book::all();//->lists('title','id');
        return $books;
    }
    public function searchBooks()
    {
        $books = \App\Book::all();//->lists('title','id');
        return $books;
    }
}
