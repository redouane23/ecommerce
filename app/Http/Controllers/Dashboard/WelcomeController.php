<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Order;
use App\Product;
use App\Supplier;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WelcomeController extends Controller
{

    public function index()
    {
        $users = User::whereRoleIs('admin');
        $categories = Category::all();
        $suppliers = Supplier::all();
        $products = Product::all();
        $clients = User::whereRoleIs('client');
        $orders = Order::all();
        return view('dashboard.welcome', compact('users', 'categories', 'suppliers', 'products', 'clients', 'orders'));

    }// end of index

    public function test()
    {

        return view('dashboard.categories.index');

    }// end of index

}
