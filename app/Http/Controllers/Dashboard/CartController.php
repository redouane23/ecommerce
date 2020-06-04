<?php

namespace App\Http\Controllers\Dashboard;

use App\Cart;
use App\Order;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {

        $cart = Cart::find($request->cart);
        $cart->products()->attach($request->product_id);

        return response()->json(['success' => __('site.added_to_cart'), 'cartCount' => $cart->products()->count()]);
    }//end of store function


    public function edit(Cart $cart)
    {
        //
    }


    public function update(Request $request, Cart $cart)
    {
        //
    }


    public function destroy(Request $request)
    {
        $cart = Cart::find($request->cart);
        $cart->products()->detach($request->product_id);

        return response()->json(['success' => __('site.deleted_from_cart'), 'id' => $request->product_id, 'cartCount' => $cart->products()->count()]);
    }


}
