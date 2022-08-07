<?php

namespace App\Http\Controllers;

use App\Models\Category;

use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        $categories = Category::all();
        return view("category.create", compact('categories'));
    }


    public function store(Request $request)
    {
        $inputs = $request->validate([
            'category_name' => 'required|string|max:30',
            'summary'=>'required|string|max:200',
        ]);

        $category = new Category;
        $category->user_id = auth()->user()->id;
        $category->category_name = $request->category_name;
        $category->summary = $request->summary;
        $category->save();
        $categories = Category::orderBy('id')->get();

        return redirect()->route('category.create', compact('categories'))->with('message', 'カテゴリーを追加しました');
    }


    public function show()
    {
     //
    }


    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }


    public function update(Request $request, Category $category)
    {
        $inputs = $request->validate([
            'category_name' => 'required|string|max:30',
            'summary'=>'required|string|max:200',
        ]);

        $category->user_id = auth()->user()->id;
        $category->category_name = $request->category_name;
        $category->summary = $request->summary;
        $category->save();
        $categories = Category::orderBy('id')->get();

        return view('category.create', compact('categories'))->with('message', 'カテゴリーの内容を変更しました');
    }


    public function destroy($id)
    {
        //
    }
}
