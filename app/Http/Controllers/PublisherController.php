<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $publishers = \App\Publisher::all();
        return view('publishers.index',['publishers' => $publishers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('publishers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $validator = \Validator::make(\Input::all(), \App\Publisher::$rules);

        if($validator->passes())
        {
          $publisher = new \App\Publisher;
          $publisher->name = \Input::get('name');
          $publisher->save();
          flash('Publisher added.')
          return \Redirect::back();
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
      $publisher = \App\Publisher::find($id);
      if($publisher){
          return view('publishers.edit',['publisher' => $publisher]);
        }
      flash()->error('Publisher does not exist.');
      return \Redirect::back();

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $publisher = \App\Publisher::find($id);
        if($publisher){
          $rules = \App\Publisher::$rules;
      		//$rules['name'] = 'required|min:2';
  	      $validator = \Validator::make(\Input::all(), $rules);

      		if($validator->passes())
      		{
      			$publisher = \App\Publisher::find($id);
      			$publisher->name = \Input::get('name');
      			$publisher->save();
            flash('Publisher updated');
      			return \Redirect::back();
  		    }
      		return \Redirect::back()
      		  //->with('message','There were some errors. Please try again later..')
      		  ->withInput()
      		  ->withErrors($validator);
          }
        flash()->error('Publisher does not exist.');
        return \Redirect::back();
    }

}
