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
        $this->calculate_total($cart);

        return response()->json(['success' => __('site.added_to_cart'), 'cartCount' => $cart->products()->count()]);
    }//end of store function


    public function edit(Cart $cart)
    {
        //
    }


    public function update(Request $request, Cart $cart)
    {

        $cart = Cart::find($request->cart);
        $cart->products()->detach($request->product_id);
        $cart->products()->attach($request->product_id, ['quantity' => $request->quantity]);
        $product = Product::find($request->product_id);
        $total_price = $product->sale_price * $request->quantity;
        $this->calculate_total($cart);

        return response()->json(['success' => __('site.updated_in_cart'), 'id' => $request->product_id, 'cart' => $cart, 'quantity' => $request->quantity, 'total_price' => $total_price]);
    }


    public function destroy(Request $request)
    {
        $cart = Cart::find($request->cart);
        $cart->products()->detach($request->product_id);
        $this->calculate_total($cart);

        return response()->json(['success' => __('site.deleted_from_cart'), 'id' => $request->product_id, 'cartCount' => $cart->products()->count(), 'cart' => $cart]);
    }


    private function calculate_total(Cart $cart)
    {

        $total_price = 0;

        foreach ($cart->products as $product) {

            $total_price += $product->sale_price * $product->pivot->quantity;

//            $product->update([
//                'stock' => $product->stock - $quantity['quantity'],
//            ]);

        }

        $cart->update([
            'total_price' => $total_price,
        ]);

    } //end of attach_order


}
