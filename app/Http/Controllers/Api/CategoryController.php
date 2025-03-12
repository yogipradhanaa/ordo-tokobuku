<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    // Menampilkan semua kategori
    public function index()
    {
        return response()->json(Category::all());
    }

    // Menyimpan kategori baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255']
        ]);

        $category = Category::create(['name' => $request->name]);
        return response()->json(['message' => 'Category created successfully', 'data' => $category]);
    }

    // Menampilkan satu kategori berdasarkan ID
    public function show($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'Category not found']);
        }
        return response()->json($category);
    }

    // Mengupdate kategori
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'Category not found']);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255']

        ]);
        $category->update(['name' => $request->name]);

        return response()->json(['message' => 'Category updated successfully', 'data' => $category]);
    }

    // Menghapus kategori
    public function destroy($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'Category not found']);
        }

        $category->delete();
        return response()->json(['message' => 'Category deleted successfully']);
    }
}
