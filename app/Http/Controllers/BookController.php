<?php 

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BookController extends Controller

{
    public function index()
    {
        return view('books.index');
    }
    public function create()
    {
    return view('books.create');
    }
    public function store()
    {
    return view('books.store');
    }
    public function show(Book $book)
    {
    return view('books.show', compact('book'));
    }
    public function edit(Book $book)
    {
    return view('books.edit', compact('book'));
    }
    public function update(Book $book)
    {
    return redirect()->route('books.index')->with('success', 'Book updated successfully');

    }
public function getData(Request $request)
{
    if ($request->ajax()) {
        $books = Book::select(['id', 'cover_image', 'name', 'author', 'is_published']);

        return DataTables::of($books)
            ->addIndexColumn()
            ->editColumn('cover_image', function ($book) {
                return '<img src="' . asset('storage/' . $book->cover_image) . '" width="50">';
            })
            ->editColumn('is_published', function ($book) {
                return $book->is_published ? 'Published' : 'Draft';
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
}
