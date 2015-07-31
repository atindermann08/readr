<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

  protected $fillable = ['text', 'user_id', 'request_id', 'url', 'is_read'];

  public function user(){
    return $this->belongsTo('\App\User');
  }
}
