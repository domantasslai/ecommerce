<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends \Laravelista\Comments\Comment
{
  protected $fillable = [
        'comment', 'approved', 'guest_name', 'guest_email', 'rating'
    ];
}
