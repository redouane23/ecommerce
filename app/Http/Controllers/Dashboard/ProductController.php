<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Product;
use App\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{

    public function __construct()
    {

        $this->middleware(['permission:read_products'])->only('index');
        $this->middleware(['permission:create_products'])->only('create');
        $this->middleware(['permission:update_products'])->only('edit');
        $this->middleware(['permission:delete_products'])->only('destroy');

    }

    public function index(Request $request)
    {

        $categories = Category::all();
        $suppliers = Supplier::all();

        $products = Product::when($request->search, function ($query) use ($request) {

            return $query->where('name', 'like', '%' . $request->search . '%')
                ->orwhere('description', 'like', '%' . $request->search . '%');

        })->when($request->category_id, function ($query) use ($request) {

            return $query->where('category_id', $request->category_id);

        })->when($request->supplier_id, function ($query) use ($request) {

            return $query->where('supplier_id', $request->supplier_id);

        })->latest()->paginate(5);

        return view('dashboard.products.index', compact('categories', 'suppliers', 'products'));
    }

    public function create()
    {

        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('dashboard.products.create', compact('categories', 'suppliers'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'category_id' => 'required',
            'supplier_id' => 'required',
            'name' => ['required', 'unique:products,name'],
            'description' => ['required', 'unique:products,description'],
            'image' => 'image',
            'purchase_price' => 'required',
            'sale_price' => 'required',
            'stock' => 'required',
        ]);

        $request_data = $request->except(['image']);

        if ($request->image) {

            Image::make($request->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/product_images/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();

        } //end of if

        Product::create($request_data);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.products.index');
    }

    public function show(Product $product)
    {
        //
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('dashboard.products.edit', compact('product', 'categories', 'suppliers'));
    }

    public function update(Request $request, Product $product)
    {

        $request->validate([
            'category_id' => 'required',
            'supplier_id' => 'required',
            'name' => ['required', 'unique:products,name,' . $product->id . ',id'],
            'description' => ['required', 'unique:products,description,' . $product->id . ',id'],
            'image' => 'image',
            'purchase_price' => 'required',
            'sale_price' => 'required',
            'stock' => 'required',
        ]);

        $request_data = $request->except(['image']);

        if ($request->image) {

            Image::make($request->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/product_images/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();

        } //end of if

        $product->update($request_data);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.products.index');
    }

    public function destroy(Product $product)
    {

        if ($product->image != 'default.png') {

            Storage::disk('public_uploads')->delete('/product_images/' . $product->image);

        } //end of if

        $product->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.products.index');
    }
}
