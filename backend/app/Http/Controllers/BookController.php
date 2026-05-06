<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $book = Book::all();

        return response()->json([
            'message' => 'Berhasil mengambil data buku',
            'data' => $book
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:50|string',
            'author' => 'required|max:50|string',
            'publisher' => 'required|max:50|string',
            'publish_date' => 'required|max_digits:10|integer',
            'price' => 'required|max_digits:10|integer',
            'stock' => 'required|max_digits:10|integer',
            'book_cover' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('book_cover')) {
            $validated['book_cover'] = $request->file('book_cover')->store('books', 'public');
        };

        $book = Book::create($validated);

        return response()->json([
            'message' => 'berhasil menambahkan data buku: ' . $book->name,
            'data' => $book
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $book = Book::findOrFail($id);

        return response()->json([
            'message' => 'berhasil mengambil data buku: ' . $book->name,
            'data' => $book
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|max:50|string',
            'author' => 'required|max:50|string',
            'publisher' => 'required|max:50|string',
            'publish_date' => 'required|max_digits:10|integer',
            'price' => 'required|max_digits:10|integer',
            'stock' => 'required|max_digits:10|integer',
            'book_cover' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('book_cover')) {
            $validated['book_cover'] = $request->file('book_cover')->store('books', 'public');
        };

        $book->update($validated);

        return response()->json([
            'message' => 'berhasil mengupdate data buku: ' . $book->name,
            'data' => $book
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return response()->json([
            'message' => 'berhasil menghapus data buku',
            'data' => $book
        ]);
    }
}
