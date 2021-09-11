<?php

namespace App\Http\Controllers;

use App\category;
use Illuminate\Http\Request;
use App\movie;
use App\movie_category;

class MovieController extends Controller
{
    public function getMovie( Request $request)
    {

        if ($request->category =='' && $request->search =='' && $request->week =='') {
            $movie =movie::with('movie_category','movie_category.categories')->OrderBy('id', 'DESC')->get();

        }else if ($request->category !==''  && $request->search =='' && $request->week =='') {

            $movie_category = movie_category::where('category_id',$request->category)->pluck('movie_id');
            $movie_category->unique('movie_id');
            $movie =movie::with('movie_category','movie_category.categories')->whereIn('id', $movie_category)->OrderBy('id', 'DESC')->get();

        }else if( $request->category =='' && $request->week !=='' && $request->search ==''){

            $movie =movie::with('movie_category','movie_category.categories')->whereDate('release_date','>=', $request->week)->OrderBy('id', 'DESC')->get();
        }else if( $request->search !=='' && $request->category =='' && $request->week =='')  {

            $movie =movie::with('movie_category','movie_category.categories')->where('title', 'LIKE', "%{$request->search}%")->OrderBy('id', 'DESC')->get();
        }
        
        return response()->json($movie);


    }
    public function store(Request $request)
    {
        $movie = new movie($request->only('cover','title','description','duration','trailer','release_date'));
        $movie->save();

        foreach ($request->category_id as $key => $value) {
            $movie_category= new movie_category();
            $movie_category->movie_id = $movie->id;
            $movie_category->category_id =$value;
            $movie_category->save();
           
        }
    
    }
    public function getCategory()
    {
        $category =category::get(['id','name']);
        return response()->json($category);
    }
}
