<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Requests\ProductRequest;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::paginate(10);
        return view('auth.products.index', compact('products'));
    }


    public function create()
    {
        $category = Category::get();
        return view('auth.products.form', compact('category'));
    }


    public function store(ProductRequest $request)
    {
        $params = $request->all();
        unset($params['image']);

        if($request->has('image')){
            $path = $request->file('image')->store('products', 'public');
            $params['image'] = $path;
        }

        Product::create($params);
        return redirect()->route('product.index');
    }


    public function show(Product $product)
    {
        //dd($product);
        return view('auth.products.show', compact('product'));
    }


    public function edit(Product $product)
    {
        $categories = Category::get();
        return view('auth.products.form', compact('product', 'categories'));
    }


    public function update(ProductRequest $request, Product $product)
    {
        $params = $request->all();
        unset($params['image']);

        if($request->has('image')){
            Storage::delete($product->image);
            $path = $request->file('image')->store('products', 'public');
            $params['image'] = $path;
        }

        foreach (['new', 'hit', 'recommend'] as $fieldName){
            if(!isset($params[$fieldName])){
                $params[$fieldName] = 0;
            }
        }



        $product->update($params);
        return redirect()->route('product.index');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index');
    }
}
