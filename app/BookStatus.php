<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class BookStatus extends Model
{
	protected $fillable = ['name'];

	public static $rules = [
		'name' => 'required|min:2|unique:categories'
	];

  public function book(){
      return $this->hasMany('\App\Book');
  }
}
