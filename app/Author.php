<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
	protected $fillable = ['name'];

	public static $rules = [
		'name' => 'required|min:2|unique:authors',
    'bio' => 'required|min:3'
	];

  public function books(){
      return $this->belongsToMany('\App\Book');
  }

	public function setNameAttribute($value) {
        $this->attributes['name'] = empty($value)?'Not Available':$value;
    }

}
