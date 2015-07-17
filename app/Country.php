<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Country extends Model {
		protected $fillable = [];
    protected $hidden = ['created_at','updated_at'];

		public static $rules = [
			'name' => 'required|min:2|unique:countries'
		];

    public function states(){
        return $this->hasMany('\App\State');
    }
}
