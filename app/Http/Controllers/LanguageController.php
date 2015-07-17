<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $languages = \App\Language::all();
        return view('languages.index', ['languages' => $languages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
          return view('languages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
     public function store()
     {
         $validator = \Validator::make(\Input::all(), \App\Language::$rules);

         if($validator->passes())
         {
           $language = new \App\Language;
           $language->name = \Input::get('name');
           $language->save();
           return \Redirect::back()->with('message','Language added.');
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
       $language = \App\Language::find($id);
       if($language){
           return view('languages.edit',['language' => $language]);
         }
       return \Redirect::back()
                 ->with('error', 'Language does not exist.');

     }

     /**
      * Update the specified resource in storage.
      *
      * @param  int  $id
      * @return Response
      */
     public function update($id)
     {
         $language = \App\Language::find($id);
         if($language){
           $rules = \App\Language::$rules;
           //$rules['name'] = 'required|min:2';
           $validator = \Validator::make(\Input::all(), $rules);

           if($validator->passes())
           {
             $language = \App\Language::find($id);
             $language->name = \Input::get('name');
             $language->save();

             return \Redirect::back()->with('message','Language updated.');
           }
           return \Redirect::back()
             //->with('message','There were some errors. Please try again later..')
             ->withInput()
             ->withErrors($validator);
           }
         return \Redirect::back()
                   ->with('error', 'Language does not exist.');
     }
}
