<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
      $books = \App\Book::with('authors','language','category','publisher')->get();
      // $authors = \App\Author::all();
      // $publishers = \App\Publisher::all();
      // $categories = \App\Category::all();
      // $languages = \App\Language::all();
      // return response()->json($books);
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

      return view('books.create')
        //->with('books' , 'books')
        ->with('authors' , $authors)
        ->with('publishers' , $publishers)
        ->with('categories' , $categories)
        ->with('languages' , $languages);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
      $validator = \Validator::make(\Input::all(), \App\Book::$rules);

      if($validator->passes())
      {
        $book = new \App\Book;
        $book->title = \Input::get('title');
        $book->description = \Input::get('description');
        $book->author_id = App\Author::firstOrCreate(['name' => ucfirst(\Input::get('author'))])->id;
        $book->publisher_id = App\Publisher::firstOrCreate(['name' => ucfirst(\Input::get('publisher'))])->id;
        $book->category_id = App\Category::firstOrCreate(['name' => ucfirst(\Input::get('category'))])->id;
        $book->language_id = App\Language::firstOrCreate(['name' => ucfirst(\Input::get('language'))])->id;
        $book->release_date = \Input::get('release_date');
        $book->save();
        // if ($request->hasFile('image')) {
        //   $image = $request->file('image');
        //   \Image::make($image->getRealPath())
				// 	->resize(460,460)
				// 	->save('../public/assets/images/books/'.$book->id.'.jpg');
        //   $book->imgage = 'assets/images/books/'.$book->id.'.jpg';
        //   $book->save();
        // }

        return \Redirect::back()->with('message','Book added.');
      }

      return \Redirect::back()
            //->with('message','There were some errors. Please try again later..')
            ->withInput()
            ->withErrors($validator);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $book = Book::with('authors','publisher','category', 'language')->get();
        return view('books.show')
        ->with('book',$book);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
      $authors = \App\Author::all()->lists('name','id');
      $publishers = \App\Publisher::all()->lists('name','id');
      $categories = \App\Category::all()->lists('name','id');
      $languages = \App\Language::all()->lists('name','id');
      $book = Book::with('author','publisher','category', 'language')->find($id);
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


    public function library()
    {
      $book = Book::with('author','publisher','category', 'language')->get();
      return view('library',['books' => $books]);
    }
}
