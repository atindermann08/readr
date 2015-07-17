<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $authors = \App\Author::all();
        return view('authors.index', ['authors' => $authors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
          return view('authors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
     public function store()
     {
         $validator = \Validator::make(\Input::all(), \App\Author::$rules);

         if($validator->passes())
         {
           $author = new \App\Author;
           $author->name = \Input::get('name');
           $author->bio = \Input::get('bio');
           $author->save();
           return \Redirect::back()->with('message','author added.');
         }

         return \Redirect::back()
               //->with('message','There were some errors. Please try again later..')
               ->withInput()
               ->withErrors($validator);
     }

     /**
      * Show the form for editing the specified resource.
      *
      * @param  int  $id
      * @return Response
      */
     public function edit($id)
     {
       $author = \App\Author::find($id);
       if($author){
           return view('authors.edit',['author' => $author]);
         }
       return \Redirect::back()
                 ->with('error', 'author does not exist.');

     }

     /**
      * Update the specified resource in storage.
      *
      * @param  int  $id
      * @return Response
      */
     public function update($id)
     {
         $author = \App\Author::find($id);
         if($author){
           $rules = \App\Author::$rules;
           //$rules['name'] = 'required|min:2';
           $validator = \Validator::make(\Input::all(), $rules);

           if($validator->passes())
           {
             $author = \App\Author::find($id);
             $author->name = \Input::get('name');
             $author->save();

             return \Redirect::back()->with('message','author updated.');
           }
           return \Redirect::back()
             //->with('message','There were some errors. Please try again later..')
             ->withInput()
             ->withErrors($validator);
           }
         return \Redirect::back()
                   ->with('error', 'author does not exist.');
     }
}
