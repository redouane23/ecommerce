<?php

namespace App\Http\Controllers\Dashboard;

use App\Cart;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{

    public function __construct()
    {

        $this->middleware(['permission:read_orders'])->only('index');
        $this->middleware(['permission:delete_orders'])->only('destroy');

    }//end of construct


    public function index(Request $request)
    {

        $orders = Order::where('paid', 'like', '%' . $request->paid . '%')->whereHas('user', function ($q) use ($request) {

            return $q->where('first_name', 'like', '%' . $request->search . '%')
                ->Orwhere('last_name', 'like', '%' . $request->search . '%');

        })->latest()->paginate(5);

        return view('dashboard.orders.index', compact('orders'));

    } //end of index

    public function myorders(Request $request)
    {

        $orders = Order::where('user_id', '=', auth()->user()->id)->where('paid', 'like', '%' . $request->paid . '%')->whereHas('user', function ($q) use ($request) {

            return $q->where('first_name', 'like', '%' . $request->search . '%')
                ->Orwhere('last_name', 'like', '%' . $request->search . '%');

        })->latest()->paginate(5);

        return view('dashboard.orders.myorders', compact('orders'));

    } //end of index


    public function destroy(Order $order)
    {

//        foreach ($order->products as $product) {
//
//
//            $product->update([
//                'stock' => $product->stock + $product->pivot->quantity
//            ]);
//        }

        $order->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.orders.index');

    } //end of destroy


    public function products(Order $order)
    {

        $products = $order->products;

        return view('dashboard.orders._products', compact('order', 'products'));

    } //end of products


    public function confirm(Request $request)
    {

        $order = Order::find($request->order);
        $order->update([
            'paid' => !$order->paid
        ]);

        return response()->json(['success' => __('site.updated_successfully'), 'order' => $order, 'confirm' => __('site.confirm'), 'canceled' => __('site.cancel')]);

    }//end of confirm function

} // end of controller
