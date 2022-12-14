<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'author' => 'required|string'
        ]);

        Book::create($data);
    }

    public function update(Book $book)
    {
        $data = \request()->validate([
            'title' => 'required',
            'author' => 'required',
        ]);

        $book->update($data);
    }

}
