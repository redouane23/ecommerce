<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index(Request $request)
    {

        $categories = Category::with('products')->get()->all();

        if ($request->search != null or $request->category_id != null) {
            return redirect()->route('products', ['search' => $request->search, 'category_id' => $request->category_id]);
        }

        return view('home', compact('categories'));
    }//end of index function


    public function products(Request $request)
    {

        $categories = Category::all();

        $products = Product::when($request->search, function ($query) use ($request) {

            return $query->where('name', 'like', '%' . $request->search . '%')
                ->orwhere('description', 'like', '%' . $request->search . '%');

        })->when($request->category_id, function ($query) use ($request) {

            return $query->where('category_id', $request->category_id);

        })->latest()->paginate(12);

        return view('products', compact('categories', 'products'));
    }//end of products function


    public function product(Request $request, $id)
    {

        $categories = Category::all();
        $product = Product::find($id);

        if ($request->search != null or $request->category_id != null) {
            return redirect()->route('products', ['search' => $request->search, 'category_id' => $request->category_id]);
        }

        return view('product', compact('product', 'categories'));
    }//end of product function


    public function cart(Request $request)
    {
        $categories = Category::all();

        if ($request->search != null or $request->category_id != null) {
            return redirect()->route('products', ['search' => $request->search, 'category_id' => $request->category_id]);
        }

        return view('cart', compact('categories'));
    }//end of cart function

    public function contact(Request $request)
    {
        $categories = Category::all();

        if ($request->search != null or $request->category_id != null) {
            return redirect()->route('products', ['search' => $request->search, 'category_id' => $request->category_id]);
        }

        return view('contact', compact('categories'));
    }//end of contact function

}//end of controller
