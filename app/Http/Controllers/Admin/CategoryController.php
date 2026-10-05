<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
      public function index()
    {
        $categories = Category::orderBy('id', 'desc')->paginate(15);
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'nullable|in:1,0',
        ]);
        Category::create($data);

        return redirect()->route('admin.category')->with('success', 'Category created successfully');
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.show', compact('category'));
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'nullable|in:1,0',
        ]);
    
        $category->update($data);

        return redirect()->route('admin.category')->with('success', 'Category updated successfully');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('admin.category')->with('success', 'Category deleted');
    }
}
