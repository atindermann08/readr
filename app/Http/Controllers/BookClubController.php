<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class BookClubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
      $bookclubs = \App\BookClub::with('books','members')->get();
      // return response()->json($books);
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
      return view('bookclubs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
      $validator = \Validator::make(\Input::all(), \App\BookClub::$rules);

      if($validator->passes())
      {
        $bookclub = new \App\BookClub;
        $bookclub->name = \Input::get('name');
        $bookclub->description = \Input::get('description');
        $bookclub->rules = \Input::get('rules');
        $bookclub->user_id = 1;//Auth::user()->id;
        $bookclub->save();

        return \Redirect::back()->with('message','Book Club Created.');
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
      $bookclub = \App\BookClub::find($id);
      if($bookclub){

        return view('bookclubs.edit')
        ->with(compact('bookclub'));
      }
      return \Redirect::back()
                ->with('error', 'Book Club does not exist.');
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
