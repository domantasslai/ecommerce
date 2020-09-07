<?php

namespace App;

use Laravelista\Comments\Comment;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
use Laravel\Scout\Searchable;
use Laravelista\Comments\Commentable;
use Illuminate\Support\Facades\Config;

class Product extends Model
{
    use SearchableTrait, Searchable, Commentable;

    protected $fillable = ['quantity'];
    /**
     * Searchable rules.
     *
     * @var array
    */
    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'products.name' => 10,
            'products.details' => 5,
            'products.description' => 2,
        ],
    ];

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    public function comments(){
      return $this->hasMany(Comment::class, 'commentable_id');
    }

    public function presentPrice()
    {
        return '$'.number_format($this->price / 100, 2);
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
