<?php

namespace App\Http\Controllers\Dashboard;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ClientController extends Controller
{
    public function __construct()
    {

        $this->middleware(['permission:read_clients'])->only('index');
        $this->middleware(['permission:create_clients'])->only('create');
        $this->middleware(['permission:update_clients'])->only('edit');
        $this->middleware(['permission:delete_clients'])->only('destroy');

    }

    public function index(Request $request)
    {

        $users = User::whereRoleIs('client')->where(function ($q) use ($request) {

            return $q->when($request->search, function ($query) use ($request) {

                return $query->where('first_name', 'like', '%' . $request->search . '%')
                    ->orwhere('last_name', 'like', '%' . $request->search . '%');

            });
        })->latest()->paginate(5);

        return view('dashboard.clients.index', compact('users'));

    } //end of index

    public function create()
    {
        return view('dashboard.clients.create');
    }

    public function store(Request $request)
    {

        $request->validate([

            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users',
            'image' => 'image',
            'password' => 'required|confirmed',
            //'permissions' => 'required|min:1'

        ]);

        $request_data = $request->except(['password', 'password_confirmation', 'image']);
        $request_data['password'] = bcrypt($request->password);

        if ($request->image) {

            Image::make($request->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/user_images/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();

        } //end of if

        $client = User::create($request_data);

        $client->attachRole('client');
        //$user->syncPermissions($request->permissions);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.clients.index');

    } // end of store

    public function edit(User $client)
    {

        return view('dashboard.clients.edit', compact('client'));

    } // end of edit

    public function update(Request $request, User $client)
    {
        $request->validate([

            'first_name' => 'required',
            'last_name' => 'required',
            'email' => ['required', 'unique:users,email,' . $client->id . ',id'],
            'image' => 'image',
            //'permissions' => 'required|min:1'
        ]);

        $request_data = $request->except(['image']);

        if ($request->image) {

            if ($client->image != 'default.png') {

                Storage::disk('public_uploads')->delete('/user_images/' . $client->image);

            } //end of if

            Image::make($request->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/user_images/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();

        } //end of if

        $client->update($request_data);

        //$user->syncPermissions($request->permissions);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.clients.index');

    } // end of update

    public function destroy(User $client)
    {

        if ($client->image != 'default.png') {

            Storage::disk('public_uploads')->delete('/user_images/' . $client->image);

        } //end of if

        $client->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.clients.index');
    }
}
