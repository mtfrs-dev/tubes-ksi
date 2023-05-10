<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate();

        return view('pages.categories.index', compact('categories'));
    }
    public function store(StoreCategoryRequest $request)
    {
        $validated = $request->validated();

        $category = Category::create([
            'name'  =>  $validated['name'],
            'code'  =>  $validated['code']
        ]);

        return redirect()->back()
            ->with("success","Data kategori obat berhasil disimpan!");
    }
    public function update(UpdateCategoryRequest $request)
    {
        $validated = $request->validated();
        $category = Category::find($request->id);

        $category->name = $validated['name'];
        $category->code = $validated['code'];

        $category->save();

        return redirect()->back()
            ->with("success","Perubahan pada data kategori obat berhasil disimpan!");
    }
}
