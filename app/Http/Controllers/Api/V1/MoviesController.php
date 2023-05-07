<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Models\Movies;

use Illuminate\Routing\Controller as BaseController;

class MovieController extends BaseController
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $movies = Movies::orderBy('id','asc')->paginate(5);
        // return view('movies.index', compact('movies'));
        return $movies;
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('movies.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'studio' => 'required',
            'yor' => 'required',
        ]);

        $movie = new Movies();
        $movie->name = $request['name'];
        $movie->studio = $request['studio'];
        $movie->year_of_release = $request['yor'];
        $movie->save();

        return redirect()->route('movies.index')->with('success','Movies has been created successfully.');
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Movies  $movie
    * @return \Illuminate\Http\Response
    */
    public function show(Movies $movie)
    {
        return view('movies.show', compact('movie'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Movies  $movie
    * @return \Illuminate\Http\Response
    */
    public function edit(Movies $movie)
    {
        return view('movies.edit', compact('movie'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'studio' => 'required',
            'yor' => 'required',
        ]);

        $movie = Movies::findOrFail($id);
        $movie->name = $request['name'];
        $movie->studio = $request['studio'];
        $movie->year_of_release = $request['yor'];
        $movie->save();

        return redirect()->route('movies.index')->with('success','Movies Has Been updated successfully');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $vehicle = Movies::findOrFail($id);
        $vehicle->delete();
        return redirect()->route('movies.index')->with('success','Movies has been deleted successfully');
    }
}
