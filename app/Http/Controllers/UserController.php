<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:user-list|user-setup', ['only' => ['index',]]);
        $this->middleware('permission:user-setup', ['only' => ['create', 'store', 'edit', 'update', 'destroy']]);
    }

    public function profile()
    {
        $user = Auth::user();
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        return view('profile', compact('user', 'roles', 'userRole'));
    }

    public function updateprofile(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'roles' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = User::find($id);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        if (!empty($request->foto)) {
            $imageName = $request->foto->getClientOriginalName();
            $request->foto->move(public_path('storage/profile-image'), $imageName);
            $input['foto'] = $imageName;
            if (File::exists(public_path('storage/profile-image/' . $user->foto))) {
                File::delete(public_path('storage/profile-image/' . $user->foto));
            }
        }

        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));

        Alert::success('Success Information', 'User updated successfully');
        return redirect()->route('profile');
    }

    public function index(Request $request)
    {
        $data = User::orderBy('id', 'DESC')->get();

        return view('users.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1));
    }

    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if (!empty($request->foto)) {
            $imageName = $request->foto->getClientOriginalName();
            $request->foto->move(public_path('storage/profile-image'), $imageName);
        }

        $input = $request->all();
        $input['foto'] = $imageName;
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        Alert::success('Success Information', 'User created successfully');
        return redirect()->route('users.index');
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('users.edit', compact('user', 'roles', 'userRole'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'roles' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $user = User::find($id);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        if (!empty($request->foto)) {
            $imageName = $request->foto->getClientOriginalName();
            $request->foto->move(public_path('storage/profile-image'), $imageName);
            $input['foto'] = $imageName;
            if (File::exists(public_path('storage/profile-image/' . $user->foto))) {
                File::delete(public_path('storage/profile-image/' . $user->foto));
            }
        }

        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));

        Alert::success('Success Information', 'User updated successfully');
        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        Alert::success('Success Information', 'User deleted successfully');
        return redirect()->route('users.index');
    }
}
