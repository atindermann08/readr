<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Address extends Model {
	protected $fillable = ['name', 'house_no', 'pin_code', 'area_id', 'landmark'];

    public static $rules = [
        'name' => 'required|alpha|min:3',
        'house_no' => 'required|alpha_dash',
        'pin_code' => 'required|digits:6',
        'area' => 'required|integer'
    ];

    public function user(){
        return $this->belongsTo('\App\User');
    }

    public function area(){
        return $this->belongsTo('\App\Area');
    }
}
