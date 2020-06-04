<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $categories = Category::with('limitProducts')->get()->all();
        return view('home', compact('categories'));
    }

    public function product($id)
    {

        $product = Product::find($id);

        return view('product', compact('product'));
    }

    public function cart()
    {

        return view('cart');
    }
}
