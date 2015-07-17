<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class BookStatusController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
      $bookstatuses = \App\BookStatus::all();
      return view('bookstatuses.index', ['bookstatuses' => $bookstatuses]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
        return view('bookstatuses.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
   public function store()
   {
       $validator = \Validator::make(\Input::all(), \App\BookStatus::$rules);

       if($validator->passes())
       {
         $bookstatus = new \App\BookStatus;
         $bookstatus->name = \Input::get('name');
         $bookstatus->save();
         return \Redirect::back()->with('message','Book Status added.');
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
     $bookstatus = \App\BookStatus::find($id);
     if($bookstatus){
         return view('bookstatuses.edit',['Book Status' => $bookstatus]);
       }
     return \Redirect::back()
               ->with('error', 'Book Status does not exist.');

   }

   /**
    * Update the specified resource in storage.
    *
    * @param  int  $id
    * @return Response
    */
   public function update($id)
   {
       $bookstatus = \App\BookStatus::find($id);
       if($bookstatus){
         $rules = \App\BookStatus::$rules;
         //$rules['name'] = 'required|min:2';
         $validator = \Validator::make(\Input::all(), $rules);

         if($validator->passes())
         {
           $bookstatus = \App\BookStatus::find($id);
           $bookstatus->name = \Input::get('name');
           $bookstatus->save();

           return \Redirect::back()->with('message','Book Status updated.');
         }
         return \Redirect::back()
           //->with('message','There were some errors. Please try again later..')
           ->withInput()
           ->withErrors($validator);
         }
       return \Redirect::back()
                 ->with('error', 'Book Status does not exist.');
   }
}
