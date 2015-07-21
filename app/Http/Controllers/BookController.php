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

      // $authors = \App\Author::all();
      // $publishers = \App\Publisher::all();
      // $categories = \App\Category::all();
      // $languages = \App\Language::all();
      // return response()->json(\App\Book::first()->clubstatus());
      return view('books.index')
        ->with('books' , $books);
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
      //$books = \App\Book::all();
      $authors = \App\Author::all()->lists('name','id');
      $publishers = \App\Publisher::all()->lists('name','id');
      $categories = \App\Category::all()->lists('name','id');
      $languages = \App\Language::all()->lists('name','id');

      $bookclubs = \Auth::user()->bookclubs()->lists('name','id');

      return view('books.create')
        //->with('books' , 'books')
        ->with('authors' , $authors)
        ->with('publishers' , $publishers)
        ->with('categories' , $categories)
        ->with('languages' , $languages)
        ->with(compact('bookclubs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(BookRequest $request)
    {
      $book = \App\Book::where('title','=',$request->input('title'))->first();
      if($book)
      {
        return \Redirect::route('books.show',$book->id)->with('message','This book already exits add it to your library.');
      }
      $request['author_id'] = auth()->user()->id;

      // Convert comma separated string into array of author names
      $authors = explode(',',$request->get('author'));

      //going over author names build up array of author ids by getting author ids and creating author if does not exist
      $authorIds = [];
      foreach ($authors as $author) {
        $authorIds[] =  App\Author::firstOrCreate(['name' => ucfirst($author)])->id;
      }
      // $request['author_id']  = App\Author::firstOrCreate(['name' => ucfirst(\Input::get('author'))])->id;
      $request['publisher_id'] = App\Publisher::firstOrCreate(['name' => ucfirst(\Input::get('publisher'))])->id;
      $request['category_id'] = App\Category::firstOrCreate(['name' => ucfirst(\Input::get('category'))])->id;
      $request['language_id'] = App\Language::firstOrCreate(['name' => ucfirst(\Input::get('language'))])->id;

      //create book
      $book = auth()->user()->books()->create($request->all(),['status_id'=>1]);

      //atached book to authors
      $book->authors()->attach($authorIds);

      //attach book to user
      // auth()->user()->books()->attach($book->id);

      //attach book to book clubs
      $book->bookclubs()->attach($request->input('bookclubs'));

      return \Redirect::back()->with('message','Book added.');

      // $validator = \Validator::make(\Input::all(), \App\Book::$rules);
      //
      // if($validator->passes())
      // {
      //   $book = new \App\Book;
      //   $book->title = \Input::get('title');
      //   $book->description = \Input::get('description');
      //   $book->author_id = App\Author::firstOrCreate(['name' => ucfirst(\Input::get('author'))])->id;
      //   $book->publisher_id = App\Publisher::firstOrCreate(['name' => ucfirst(\Input::get('publisher'))])->id;
      //   $book->category_id = App\Category::firstOrCreate(['name' => ucfirst(\Input::get('category'))])->id;
      //   $book->language_id = App\Language::firstOrCreate(['name' => ucfirst(\Input::get('language'))])->id;
      //   $book->release_date = \Input::get('release_date');
      //   $book->save();
        // if ($request->hasFile('image')) {
        //   $image = $request->file('image');
        //   \Image::make($image->getRealPath())
				// 	->resize(460,460)
				// 	->save('../public/assets/images/books/'.$book->id.'.jpg');
        //   $book->imgage = 'assets/images/books/'.$book->id.'.jpg';
        //   $book->save();
        // }

      //   // return \Redirect::back()->with('message','Book added.');
      // }
      //
      // return \Redirect::back()
      //       //->with('message','There were some errors. Please try again later..')
      //       ->withInput()
      //       ->withErrors($validator);
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
        $book = App\Book::with('author','publisher','category', 'language')->find($id);
        return view('books.show')
              ->with(compact('book','user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
      // $authors = \App\Author::all()->lists('name','id');
      // $publishers = \App\Publisher::all()->lists('name','id');
      // $categories = \App\Category::all()->lists('name','id');
      // $languages = \App\Language::all()->lists('name','id');
      $book = \App\Book::with('author','publisher','category', 'language')->findOrFail($id);
      // return response()->json($book);
      return view('books.edit', ['book' => $book]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $book = \App\Book::find($id);

        // $book->update(\Input::all());
        // return \Redirect::back()->with('message','Book updated.');
        if($book){
          $rules = \App\Book::$rules;
          //$rules['name'] = 'required|min:2';
          $validator = \Validator::make(\Input::all(), $rules);

          if($validator->passes())
          {
            $book = \App\State::find($id);
            $book->title = \Input::get('title');
            $book->description = \Input::get('description');
            $book->author_id = \Input::get('author');
            $book->publisher_id = \Input::get('publisher');
            $book->category_id = \Input::get('category');
            $book->language_id = \Input::get('language');
            $book->release_date = \Input::get('release_date');
            $book->save();

            return \Redirect::back()->with('message','Book updated.');
          }
          return \Redirect::back()
            //->with('message','There were some errors. Please try again later..')
            ->withInput()
            ->withErrors($validator);
          }
        return \Redirect::back()
                  ->with('error', 'Book does not exist.');
    }


    public function addtolibrary($bookId)
    {
          auth()->user()->books()->attach($bookId);

          return \Redirect::back()
                ->with('message', 'Book added to library.');
    }
}
