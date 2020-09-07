<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table = 'ratings';

    protected $fillable = ['rating'];

    public function comment(){
      return $this->belongsTo(Config::get('comments.model'));
    }
}
