<?php

namespace App\Http\Controllers;

use App\category;
use Illuminate\Http\Request;
use App\movie;
use App\movie_category;

class MovieController extends Controller
{
    public function getMovie()
    {
        $movie =movie::with('movies_categories.categories')->OrderBy('id', 'DESC')->get();
        return response()->json($movie);
    }
    public function store(Request $request)
    {
        $movie = new movie($request->only('cover','title','description','duration','trailer','release_date'));
        $movie->save();

        foreach ($request->category_id as $key => $value) {
             movie_category::create([
                'movie_id' => $movie->id,
                'category_id' =>$value
            ]);
        }
    
    }
    public function getCategory()
    {
        $category =category::get(['id','name']);
        return response()->json($category);
    }
}
