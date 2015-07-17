<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
	protected $fillable = ['name'];
    public static $rules = [
      'name' => 'required|min:2|unique:publishers'
    ];

  	public function books(){
  	  return $this->hasMany('\App\Book');
    }
}
