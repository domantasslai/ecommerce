<?php

namespace App;

use Laravelista\Comments\Comment;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Laravelista\Comments\Commentable;
use Illuminate\Support\Facades\Config;

class Product extends Model
{
    use Searchable, Commentable;

    protected $fillable = ['quantity'];


    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    public function comments(){
      return $this->hasMany(Comment::class, 'commentable_id');
    }

    public function presentPrice()
    {
        return number_format($this->price / 100, 2).' €';
    }

    public function scopeMightAlsoLike($query)
    {
        return $query->inRandomOrder()->take(4);
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->toArray();

        $extraFields = [
          'categories' => $this->categories->pluck('name')->toArray(),
        ];

        return array_merge($array, $extraFields);
    }
}
