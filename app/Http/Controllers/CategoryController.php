<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => ['required', 'string', 'max:255']]);
        Category::create(['name' => $request->name]);

        return response()->json(['success' => 'Category added successfully']);
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update(['name' => $request->name]);

        return response()->json(['success' => 'Category updated successfully']);
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete(); // Soft delete
        return response()->json(['success' => 'Category deleted successfully!']);
    }
}

