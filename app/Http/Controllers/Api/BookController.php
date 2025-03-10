<?php

namespace App\Http\Controllers\Api;


use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::select('id', 'cover_image', 'name', 'author', 'code_book', 'price', 'stock', 'is_published','category_id')->paginate();

        return response()->json($books);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'cover_image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'name' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'code_book' => ['required, in:FIK,NFIK'],
            'price' => ['required|numeric|min:0'],
            'stock' => ['required|integer|min:0'],
            'description' => ['required', 'string'],
            'is_published' => ['required', 'boolean'],
            'category_id' => ['nullable', 'exists:categories,id'],
        ]);

        $validatedData['cover_image'] = $request->file('cover_image')->store('images', 'public');
        Book::create($validatedData);

        return response()->json(['success' => 'Book created successfully']);
    }

    public function show(Book $book)
    {
        return response()->json($book);
    }

    public function update(Request $request, Book $book)
    {
        $validatedData = $request->validate([
            'cover_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'name' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'code_book' => ['required, in:FIK,NFIK'],
            'price' => ['required, numeric, min:0'],
            'stock' => ['required, integer, min:0'],
            'description' => ['required', 'string'],
            'is_published' => ['required', 'boolean'],
            'category_id' => ['nullable', 'exists:categories,id'],
        ]);

        if ($request->hasFile('cover_image')) {
            // delete old image
            Storage::delete('public/' . $book->cover_image);

            // store new image
            $validatedData['cover_image'] = $request->file('cover_image')->store('images', 'public');
        }

        $book->update($validatedData);

        return response()->json(['success' => 'Book update seccessfully']);
    }
    public function destroy(Book $book)
    {
        // delete image
        Storage::delete('public/' . $book->cover_image);

        $book->delete();

        return response()->json(['success' => 'Book deleted successfully']);
    }
}
