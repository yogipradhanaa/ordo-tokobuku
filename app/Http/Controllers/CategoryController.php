<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    
    // Menampilkan halaman kategori dengan data kategori dari database
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    // Menyimpan kategori baru ke dalam database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|max:255'
        ]);

        Category::create(['name' => $request->name]);

        return redirect()->back()->with('success', 'Category added successfully!');
    }

    // Mengambil semua kategori dalam format JSON (bisa dipakai untuk AJAX)
    public function getCategories()
    {
        return response()->json(Category::all());
    }
}
