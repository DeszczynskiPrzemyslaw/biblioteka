<?php

namespace App\Http\Controllers;

use App\Http\Resources\GenreCollection;
use App\Http\Resources\GenreResource;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        return new GenreCollection(Genre::all());
    }

    public function store(Request $request)
    {
        $this->authorize('create', Genre::class);
        $request->validate(['name' => ['required', 'string']]);

        return new GenreResource(Genre::create($request->all()));
    }

    public function show($id)
    {
        return new GenreResource(Genre::find($id));
    }

    public function update(Request $request, Genre $genre)
    {
        $this->authorize('update', Genre::class);
        $genre->update($request->all());

        return new GenreResource($genre);
    }

    public function destroy(Genre $genre)
    {
        $this->authorize('delete', Genre::class);

        return $genre->delete();
    }
}
