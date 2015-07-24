<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $countries = \App\Country::all();
        return view('countries.index',['countries' => $countries]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('countries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $validator = \Validator::make(\Input::all(), \App\Country::$rules);

        if($validator->passes())
        {
          $country = new \App\Country;
          $country->name = \Input::get('name');
          $country->save();
          flash('Country added.');
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
      $country = \App\Country::find($id);
      if($country){
          return view('countries.edit',['country' => $country]);
        }
      flash()->error('Country does not exist.');
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
        $country = \App\Country::find($id);
        if($country){
          $rules = \App\Country::$rules;
      		//$rules['name'] = 'required|min:2';
  	      $validator = \Validator::make(\Input::all(), $rules);

      		if($validator->passes())
      		{
      			$country = \App\Country::find($id);
      			$country->name = \Input::get('name');
      			$country->save();
            flash('Country updated.');
      			return \Redirect::back();
  		    }
      		return \Redirect::back()
      		  //->with('message','There were some errors. Please try again later..')
      		  ->withInput()
      		  ->withErrors($validator);
          }
        flash()->error('Country does not exist.')
        return \Redirect::back();
    }

}
