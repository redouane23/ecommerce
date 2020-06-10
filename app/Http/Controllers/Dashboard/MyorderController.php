<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MyorderController extends Controller
{

    public function __construct()
    {

        //$this->middleware(['order:1']);

    }//end of construct

    public function index(Request $request)
    {

        if ($request->client != auth()->user()->id) {
            return abort(404);
        }

        $orders = Order::where('user_id', '=', auth()->user()->id)->where('paid', 'like', '%' . $request->paid . '%')->whereHas('user', function ($q) use ($request) {

            return $q->where('first_name', 'like', '%' . $request->search . '%')
                ->Orwhere('last_name', 'like', '%' . $request->search . '%');

        })->latest()->paginate(5);

        return view('dashboard.myorders.index', compact('orders'));

    } //end of index

    public function edit(Order $order)
    {

        if (auth()->user()->orders()->find($order)->count() == 0) {
            return abort(404);
        }
        //auth()->user()->orders()->find($order);


        $categories = Category::with('products')->get();
        $orders = auth()->user()->orders()->paginate(5);
        $client = auth()->user();

        return view('dashboard.myorders.edit', compact('order', 'client', 'categories', 'orders'));

    } //end of edit

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'products' => 'required|array',
        ]);

        $this->detach_order($order);

        $this->attach_order($request, auth()->user());

        $client = auth()->user();

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.myorders', compact('client'));

    }//end of update

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
        $client = auth()->user();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.myorders', compact('client'));

    } //end of destroy

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

}
