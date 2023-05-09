<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class BooksController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return response()->json($books);
    }

    public function store(Request $request)
    {

        $book = Book::create($request->all());
        
        return response()->json($book);
    }

    public function show($id)
    {
        $book = Book::find($id);
        return response()->json($book);
    }

    public function update(Request $request, $id)
    {
        return "aaaaa";
        $book = Book::find($id);
        $book->update($request->all());
        return response()->json($book);
    }

    public function destroy($id)
    {
        Book::destroy($id);
        return response()->json(['message' => 'Book deleted']);
    }
}