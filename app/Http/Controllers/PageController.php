<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function welcome()
    {
      return view('welcome');
    }

    public function rules()
    {
      return view('rules');
    }
}
