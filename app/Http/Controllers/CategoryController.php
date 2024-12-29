<?php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.create', compact('categories'));
    }

    public function create()
    {
        // Retrieve all categories (if you need to display them in a dropdown)
        $categories = Category::all();

        // Return the create view and pass the $categories variable
        return view('categories.create', compact('categories'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
        ]);
    
        $lastCategory = Category::orderBy('category_id', 'desc')->first();
        $lastCategoryId = $lastCategory ? $lastCategory->category_id : 'C000';
    
        $number = (int) substr($lastCategoryId, 1); 
        $newCategoryId = 'C' . str_pad($number + 1, 3, '0', STR_PAD_LEFT); 
  
        while (Category::where('category_id', $newCategoryId)->exists()) {
            $number++;
            $newCategoryId = 'C' . str_pad($number, 3, '0', STR_PAD_LEFT);
        }
  
        $category = new Category([
            'category_id' => $newCategoryId,
            'name' => $request->name,
        ]);
    
        $category->save();
    
        return redirect()->route('categories.index')->with('success', 'Category created successfully!');
    }
    

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($id);
        $category->update($request->all());

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
