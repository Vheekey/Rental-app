<?php

namespace App\Http\Controllers;

use App\Models\Book;
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
        return Book::paginate(20);
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
            'name' => 'required|string|unique:books,name'
        ]);

        Book::create([
            'name' => $request->name
        ]);

        return $this->okResponse('New Book Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book  $book)
    {
        return $this->okResponse('Book Retrieved', $book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'name' => 'required|string|unique:books,name'
        ]);

        $book->update([
            'name' => $request->name
        ]);

        return $this->okResponse('Update Successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return $this->okResponse('Operation Successful');
    }
}
