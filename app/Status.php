<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = ['body']; 
    public function comments(){
        return $this->hasMany('\App\Comment');
    }

    public function user(){
        return $this->belongsTo('\App\User');
    }
}
