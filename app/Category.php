<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Category extends Model {
	protected $fillable = ['name'];

	public static $rules = [
		'name' => 'required|min:2|unique:categories'
	];

	public function books(){
	  return $this->hasMany('\App\Book');
  }
	public function setNameAttribute($value) {
				$this->attributes['name'] = empty($value)?'Not Available':$value;
		}
}
