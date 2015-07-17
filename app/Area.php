<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Area extends Model {
	protected $fillable = [];
    protected $hidden = ['created_at','updated_at','city_id'];

		public static $rules = [
			'name' => 'required|min:2|unique:areas',
			'city_id' => 'required|integer'
		];

    public function city(){
        return $this->belongsTo('\App\City');
    }

     public function address(){
        return $this->hasMany('\App\Area');
    }
}
