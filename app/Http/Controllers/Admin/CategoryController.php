<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{

    public function index(){
        $categories = Category::paginate(6);
        return view('auth.categories.index', compact('categories'));
    }


    public function create()
    {
        return view('auth.categories.form');
    }


    public function store(CategoryRequest $request)
    {

        $params = $request->all();
        unset($params['image']);

        if($request->has('image')){
            $path = $request->file('image')->store('categories', 'public');
            $params['image'] = $path;
        }

        Category::create($params);
        return redirect()->route('categories.index');
    }


    public function show(Category $category)
    {
        return view('auth.categories.show', compact('category'));
    }


    public function edit(Category $category)
    {
        return view('auth.categories.form', compact('category'));
    }


    public function update(CategoryRequest $request, Category $category)
    {
        $params = $request->all();
        unset($params['image']);

        if($request->has('image')){
            Storage::delete($category->image);
            $path = $request->file('image')->store('categories', 'public');
            $params = $request->all();
            $params['image'] = $path;
        }
        $category->update($params);
        return redirect()->route('categories.index');
    }


    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index');
    }
}
