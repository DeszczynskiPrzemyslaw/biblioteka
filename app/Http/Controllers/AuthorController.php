<?php

namespace App\Http\Controllers;

use App\Http\Resources\AuthorCollection;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        return new AuthorCollection(Author::all());
    }

    public function store(Request $request)
    {
        $this->authorize('create', Author::class);
        $request->validate(['name' => ['string', 'required']]);

        return new AuthorResource(Author::create($request->all()));
    }

    public function show($id)
    {
        return new AuthorResource(Author::find($id));
    }

    public function update(Request $request, Author $author)
    {
        $this->authorize('update', Author::class);
        $author->update($request->all());

        return new AuthorResource($author);
    }

    public function destroy(Author $author)
    {
        $this->authorize('delete', Author::class);

        return $author->delete();
    }
}
