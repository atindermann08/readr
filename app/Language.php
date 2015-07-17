<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
	protected $fillable = ['name'];

	public static $rules = [
		'name' => 'required|min:2|unique:languages'
	];

  public function books(){
      return $this->hasMany('\App\Book');
  }
}
