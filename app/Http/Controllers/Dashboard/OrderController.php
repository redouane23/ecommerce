<?php

namespace App\Http\Controllers\Dashboard;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{

    public function __construct()
    {

        $this->middleware(['permission:read_orders'])->only('index');
        $this->middleware(['permission:delete_orders'])->only('destroy');

    }

    public function index(Request $request)
    {

        $orders = Order::whereHas('user', function ($q) use ($request) {

            return $q->where('first_name', 'like', '%' . $request->search . '%')
                ->Orwhere('last_name', 'like', '%' . $request->search . '%');

        })->paginate(5);

        return view('dashboard.orders.index', compact('orders'));

    } //end of index

    public function destroy(Order $order)
    {

        foreach ($order->products as $product) {


            $product->update([
                'stock' => $product->stock + $product->pivot->quantity
            ]);
        }

        $order->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.orders.index');

    } //end of destroy

    public function products(Order $order)
    {

        $products = $order->products;

        return view('dashboard.orders._products', compact('order', 'products'));

    } //end of products

} // end of controller
