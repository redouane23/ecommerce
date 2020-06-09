<?php

namespace App\Http\Controllers\Dashboard;

use App\Cart;
use App\Order;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{

    public function store(Request $request)
    {

        $cart = Cart::find($request->cart);
        $product = Product::find($request->product_id);
        $cart->products()->attach($request->product_id, ['price' => $product->sale_price]);
        $this->calculate_total($cart);

        return response()->json(['success' => __('site.added_to_cart'), 'cartCount' => $cart->products()->count()]);
    }//end of store function


    public function update(Request $request, Cart $cart)
    {

        $cart = Cart::find($request->cart);
        $product = Product::find($request->product_id);
        $price = $cart->products()->find($request->product_id)->pivot->price;
        $cart->products()->detach($request->product_id);
        $cart->products()->attach($request->product_id, ['quantity' => $request->quantity, 'price' => $price]);
        $total_price = $price * $request->quantity;
        $this->calculate_total($cart);

        return response()->json(['success' => __('site.updated_in_cart'), 'id' => $request->product_id, 'cart' => $cart, 'quantity' => $request->quantity, 'total_price' => $total_price]);
    }//end of update function


    public function destroy(Request $request)
    {
        $cart = Cart::find($request->cart);
        $cart->products()->detach($request->product_id);
        $this->calculate_total($cart);

        return response()->json(['success' => __('site.deleted_from_cart'), 'id' => $request->product_id, 'cartCount' => $cart->products()->count(), 'cart' => $cart]);
    }//end of destroy function


    public function confirm(Request $request)
    {

        $cart = Cart::find($request->cart);
        $user = User::find($cart->user_id);

        $order = $user->orders()->create([
            'total_price' => $cart->total_price
        ]);

        foreach ($cart->products as $product) {

            //$total_price += $product->sale_price * $product->pivot->quantity;

            $order->products()->attach($product->id, ['quantity' => $product->pivot->quantity, 'price' => $product->pivot->price]);

        }


        //$cart->products()->detach($cart->products);
        $cart->delete();

        $user->carts()->create([]);

        return response()->json(['success' => __('site.cart_sent'), 'title' => __('site.thanks'), 'url' => route('home')]);

    }//end of confirm function


    private function calculate_total(Cart $cart)
    {

        $total_price = 0;

        foreach ($cart->products as $product) {

            $total_price += $product->pivot->price * $product->pivot->quantity;

//            $product->update([
//                'stock' => $product->stock - $quantity['quantity'],
//            ]);

        }

        $cart->update([
            'total_price' => $total_price,
        ]);

    } //end of calculate_total function

}
