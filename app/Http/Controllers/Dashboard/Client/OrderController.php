<?php

namespace App\Http\Controllers\Dashboard\Client;

use App\Category;
use App\Client;
use App\Order;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{

    public function __construct()
    {

        $this->middleware(['permission:create_orders'])->only('create');
        $this->middleware(['permission:update_orders'])->only('edit');

    }

    public function index(Request $request)
    {

        $orders = Order::where('paid', '=', $request->paid)->where('user_id', '=', auth()->user()->id)->whereHas('user', function ($q) use ($request) {

            return $q->where('first_name', 'like', '%' . $request->search . '%')
                ->Orwhere('last_name', 'like', '%' . $request->search . '%');
            //->where('user_id', '=', auth()->user()->id);

        })->latest()->paginate(5);
        //$orders = auth()->user()->orders()->paginate(5);

        return view('dashboard.clients.orders.index', compact('orders'));

    } //end of index

    public function create(User $client)
    {

        $categories = Category::with('products')->get();
        $orders = $client->orders()->paginate(5);

        return view('dashboard.clients.orders.create', compact('client', 'categories', 'orders'));
    }


    public function store(Request $request, User $client)
    {
        $request->validate([
            'products' => 'required|array',
        ]);

        $this->attach_order($request, $client);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.orders.index');

    }

    public function edit(User $client, Order $order)
    {

        $categories = Category::with('products')->get();
        $orders = $client->orders()->paginate(5);

        return view('dashboard.clients.orders.edit', compact('order', 'client', 'categories', 'orders'));

    } //end of edit

    public function update(Request $request, User $client, Order $order)
    {
        $request->validate([
            'products' => 'required|array',
        ]);

        $this->detach_order($order);

        $this->attach_order($request, $client);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.orders.index');

    }//end of update

    public function destroy(Order $order, User $client)
    {
        //
    }

    private function attach_order($request, $client)
    {

        $order = $client->orders()->create([]);

        //dd($request->products);

        $order->products()->attach($request->products);

        $total_price = 0;

        foreach ($request->products as $product) {

            //$product = Product::FindOrFail($id);

            $total_price += $product['price'] * $product['quantity'];

//            $product->update([
//                'stock' => $product->stock - $product['quantity'],
//            ]);

        }

        $order->update([
            'total_price' => $total_price,
        ]);

    } //end of attach_order

    private function detach_order($order)
    {
        foreach ($order->products as $product) {

//            $product->update([
//                'stock' => $product->stock + $product->pivot->quantity,
//            ]);
        }

        $order->delete();

    } //end of detach

} //end of controller
