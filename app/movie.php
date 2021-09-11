<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class movie extends Model
{
    protected $table = 'movie';
    protected $guarded = ['id'];

    public function movies_categories()
    {
        return $this->belongsToMany('App\movie', 'movie_categories', 'movie_id','id')->withPivot('category_id');
    }
    public function categories()
    {
        return $this->belongsToMany('App\category', 'movie_categories','id' ,'category_id');
    }
}
