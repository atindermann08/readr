<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $countries = \App\Country::all()->lists('name','id');
        $states = \App\State::with('country')->get();
        return view('states.index',['states' => $states, 'countries' => $countries]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
      $countries = \App\Country::all()->lists('name','id');
      return view('states.create', ['countries' => $countries]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
      $validator = \Validator::make(\Input::all(), \App\State::$rules);

      if($validator->passes())
      {
        $state = new \App\State;
        $state->name = \Input::get('name');
        $state->country_id = \Input::get('country');
        $state->save();
        return \Redirect::back()->with('message','State added.');
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
        //
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
