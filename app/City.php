<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class City extends Model {
	protected $fillable = [];
    protected $hidden = ['created_at','updated_at','state_id'];

		public static $rules = [
			'name' => 'required|min:2|unique:cities',
			'state_id' => 'required|integer'
		];
    public function areas(){
        return $this->hasMany('Area');
    }

    public function state(){
        return $this->belongsTo('State');
    }
}
