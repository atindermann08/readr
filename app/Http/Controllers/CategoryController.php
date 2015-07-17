<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $categories = \App\Category::all();
        return view('categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
          return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
     public function store()
     {
         $validator = \Validator::make(\Input::all(), \App\Category::$rules);

         if($validator->passes())
         {
           $category = new \App\Category;
           $category->name = \Input::get('name');
           $category->save();
           return \Redirect::back()->with('message','category added.');
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
       $category = \App\Category::find($id);
       if($category){
           return view('categories.edit',['category' => $category]);
         }
       return \Redirect::back()
                 ->with('error', 'category does not exist.');

     }

     /**
      * Update the specified resource in storage.
      *
      * @param  int  $id
      * @return Response
      */
     public function update($id)
     {
         $category = \App\Category::find($id);
         if($category){
           $rules = \App\Category::$rules;
           //$rules['name'] = 'required|min:2';
           $validator = \Validator::make(\Input::all(), $rules);

           if($validator->passes())
           {
             $category = \App\Category::find($id);
             $category->name = \Input::get('name');
             $category->save();

             return \Redirect::back()->with('message','category updated.');
           }
           return \Redirect::back()
             //->with('message','There were some errors. Please try again later..')
             ->withInput()
             ->withErrors($validator);
           }
         return \Redirect::back()
                   ->with('error', 'category does not exist.');
     }
}
