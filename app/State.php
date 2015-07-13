<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model {
	protected $fillable = [];
    protected $hidden = ['created_at','updated_at','country_id'];

		public static $rules = [
			'name' => 'required|min:2|unique:states',
			'country' => 'required|integer'
		];

    public function cities(){
        return $this->hasMany('\App\City');
    }

    public function country(){
        return $this->belongsTo('\App\Country');
    }
}
