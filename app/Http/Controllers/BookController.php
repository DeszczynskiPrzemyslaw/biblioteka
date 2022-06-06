<?php

namespace App\Http\Controllers;

use App\Helpers\BookHelper;
use App\Http\Requests\BookStoreRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Book::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookStoreRequest $request)
    {
        $book = Book::create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'price' => $request->get('price'),
            'date_of_creation' => $request->get('date_of_creation'),
            'ISBN' => BookHelper::generateISBN()
        ]);
        $author = Author::firstOrCreate(['name' => $request->get('author')]);
//        foreach ($request->get('genre', []) as )
//        $genre = Genre::firstOrCreate(['name' => $request->get('genre', [])]);
        $book->authors()->attach($author);
//        $book->genres()->attach($genre);

        return response([$book, $author], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Book::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $book = Book::find($id);
        $book->update($request->all());

        return $book;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Book::destroy($id);
    }

    /**
     * Search for a name
     *
     * @param  string  $name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
        return Book::where('name', 'like', '%'.$name.'%')->get();
    }
}
