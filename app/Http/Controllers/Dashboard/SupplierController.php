<?php

namespace App\Http\Controllers\Dashboard;

use App\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupplierController extends Controller
{
    public function __construct()
    {

        $this->middleware(['permission:read_suppliers'])->only('index');
        $this->middleware(['permission:create_suppliers'])->only('create');
        $this->middleware(['permission:update_suppliers'])->only('edit');
        $this->middleware(['permission:delete_suppliers'])->only('destroy');

    }

    public function index(Request $request)
    {

        $suppliers = Supplier::when($request->search, function ($query) use ($request) {

            return $query->where('name', 'like', '%' . $request->search . '%')
                ->Orwhere('phone', 'like', '%' . $request->search . '%')
                ->Orwhere('address', 'like', '%' . $request->search . '%');

        })->latest()->paginate(5);

        return view('dashboard.suppliers.index', compact('suppliers'));
    }


    public function create()
    {

        return view('dashboard.suppliers.create');
    }


    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'unique:suppliers,name'],
            //'phone' => 'required|array|min:1',
            //'phone.0' => 'required',
            //'address' => 'required'
        ]);


        Supplier::create($request->all());

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.suppliers.index');
    }


    public function edit(Supplier $supplier)
    {

        return view('dashboard.suppliers.edit', compact('supplier'));
    }


    public function update(Request $request, Supplier $supplier)
    {

        $request->validate([

            'name' => ['required', 'unique:suppliers,name,' . $supplier->id . ',id'],
            //'phone' => 'required|array|min:1',
            //'phone.0' => 'required',
            //'address' => 'required'
        ]);

        $supplier->update($request->all());

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.suppliers.index');
    }


    public function destroy(Supplier $supplier)
    {

        $supplier->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.suppliers.index');
    }
}
