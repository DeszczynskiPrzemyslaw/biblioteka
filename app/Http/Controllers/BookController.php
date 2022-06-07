<?php

namespace App\Http\Controllers;

use App\Helpers\BookHelper;
use App\Http\Requests\BookStoreRequest;
use App\Http\Resources\BookCollection;
use App\Http\Resources\BookResource;
use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        return new BookCollection(Book::all());
    }

    public function store(BookStoreRequest $request)
    {
        $book = Book::create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'price' => $request->get('price'),
            'date_of_creation' => $request->get('date_of_creation'),
            'ISBN' => BookHelper::generateISBN()
        ]);
        foreach ($request->get('author', []) as $value) {
            $author = Author::firstOrCreate(['name' => $value]);
            $book->authors()->attach($author);
        }
        foreach ($request->get('genre', []) as $value) {
            $genre = Genre::firstOrCreate(['name' => $value]);
            $book->genres()->attach($genre);
        }

        return new BookResource($book);
    }

    public function show(int $id)
    {
        return new BookResource(Book::find($id));
    }

    public function update(Request $request, int $id)
    {
        $book = Book::find($id);
        $book->update($request->all());

        return new BookResource($book);
    }

    public function destroy(int $id)
    {
        return Book::destroy($id);
    }

    public function search(string $name)
    {
        return new BookCollection(Book::where('name', 'like', '%'.$name.'%')->get());
    }
}
