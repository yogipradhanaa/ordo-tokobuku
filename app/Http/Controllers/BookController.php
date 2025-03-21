<?php

namespace App\Http\Controllers;

use App\Mail\NewBookMail;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class BookController extends Controller
{
    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $books = Book::with('category')->select(['id', 'cover_image', 'name', 'author', 'price', 'stock', 'is_published', 'category_id']);

            return DataTables::of($books)
                ->addIndexColumn()
                ->editColumn('cover_image', function ($book) {
                    return '<img src="' . asset('storage/' . $book->cover_image) . '" width="50">';
                })
                ->editColumn('is_published', function ($book) {
                    return $book->is_published ? 'Published' : 'Draft';
                })
                ->addColumn('category', function ($book) {
                    return $book->category ? $book->category->name : 'No Category';
                })
                ->addColumn('action', function ($book) {
                    return '<a href="' . route('books.show', $book->id) . '" class="btn btn-dark btn-sm"><i class="fas fa-eye"></i></a>
                        <a href="' . route('books.edit', $book->id) . '" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                        <button class="btn btn-danger btn-sm delete-btn" data-id="' . $book->id . '"><i class="fas fa-trash"></i></button>';
                })
                ->rawColumns(['cover_image', 'action'])
                ->make(true);
        }

        return response()->json(['error' => 'Unauthorized'], 403);
    }

    public function index()
    {
        $books = Book::with('category')->paginate(10);
        return view('books.index', compact('books'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'cover_image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'name' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'description' => ['required', 'string'],
            'is_published' => ['required', 'boolean'],
            'category_id' => ['nullable', 'exists:categories,id'],
        ]);

        $validatedData['cover_image'] = $request->file('cover_image')->store('images', 'public');

        $book = Book::create($validatedData);

        Mail::to('yogiklamza@gmail.com')->send(new NewBookMail($book));

        return to_route('books.index')->with('success', 'Book created successfully');
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        $validatedData = $request->validate([
            'cover_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'name' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => ['required', 'string'],
            'is_published' => ['required', 'boolean'],
            'category_id' => ['nullable', 'exists:categories,id'],
        ]);

        if ($request->hasFile('cover_image')) {
            Storage::delete('public/' . $book->cover_image);
            $validatedData['cover_image'] = $request->file('cover_image')->store('images', 'public');
        }

        $book->update($validatedData);

        return to_route('books.index')->with('success', 'Book updated successfully');
    }
    public function destroy(Book $book)
{
    if ($book->cover_image) {
        Storage::delete('public/' . $book->cover_image);
    }

    $book->delete();

    return response()->json(['success' => 'Book deleted successfully.']);
}
}
