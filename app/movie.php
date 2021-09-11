<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class movie extends Model
{
    protected $table = 'movie';
    protected $guarded = ['id'];

    public function movie_category()
    {
        return $this->belongsToMany('App\movie', 'movie_categories','movie_id','movie_id')->withPivot('category_id');
    }
    public function categories()
    {
        return $this->belongsToMany('App\category', 'movie_categories');
    }
}
