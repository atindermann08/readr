<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class BookStatus extends Model
{
	protected $fillable = ['name'];

	public static $rules = [
		'name' => 'required|min:2|unique:book_statuses'
	];

  public function book(){
      return $this->hasMany('\App\Book');
  }
}
