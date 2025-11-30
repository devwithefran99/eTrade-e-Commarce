<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        return view('backend.categories.index', compact('categories'));
    }
    function store(Request $request)
    {
        $request->validate([
            'title' => 'required | min:3',
            'icon' => 'nullable | max:2000 | mimes:png,jpg,webp,svg'
        ]);

        $fileName = $request->icon->store('category', 'public');

        $category = Category::create([
            'title' => $request->title,
            'slug' => str()->slug($request->title),
            'icon' => $fileName
        ]);
        if ($category) {
            return back()->with('msg', [
                'res' => 'category has been added!!'
            ]);
        }
    }
    function delete(Category $category)
    {
        if (Storage::disk('public')->exists($category->icon)) {
            Storage::disk('public')->delete($category->icon);
        }
        $category->delete();

        return back()->with('msg', [
            'res' => 'category has been deleted!'
        ]);
    }

    public function edit(Category $category)
    {
        $categories = Category::latest()->get();
        return view('backend.categories.index', compact('category', 'categories'));
    }



    public function update(Request $request, Category $category)
    {
        $request->validate([
            'title' => 'required|min:3',
            'icon' => 'nullable|mimes:png,jpg,webp,svg|max:2000'
        ]);

        if ($request->hasFile('icon')) {

            if (Storage::disk('public')->exists($category->icon)) {
                Storage::disk('public')->delete($category->icon);
            }

            $fileName = $request->icon->store('category', 'public');

            $category->icon = $fileName;
        }

        $category->title  = $request->title;
        $category->slug   = str()->slug($request->title);
        $category->save();

        return redirect()->route('backend.category.index')
            ->with('msg', ['res' => 'Category updated successfully!']);
    }
}
