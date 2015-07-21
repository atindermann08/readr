<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
      protected $fillable = ['name', 'email','feedback'];
      protected $hidden = ['created_at','updated_at'];


}
