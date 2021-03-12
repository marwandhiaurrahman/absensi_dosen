<?php

namespace App\Http\Controllers;

use App\Models\Matkul;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class MatkulController extends Controller
{
    public function index()
    {
        $matkuls = Matkul::latest()->get();
        return view('admin.matkul.index', compact('matkuls'))->with('i', (request()->input('page', 1) - 1));
    }

    public function create()
    {
        $users = User::get();
        return view('admin.matkul.create', compact('users'));
    }

    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'kode' => 'required',
            'user_id' => 'required',
        ]);

        Matkul::updateOrCreate($request->only(['name', 'user_id','kode']));
        Alert::success('Success Information', 'Mata Kuliah "' . $request->name . '" berhasil ditambahkan');
        return redirect('matkul');
    }

    public function edit(Matkul $matkul)
    {
        $users = User::get();
        return view('admin.matkul.edit', compact('matkul', 'users'));
    }

    public function update(Request $request, Matkul $matkul)
    {
        request()->validate([
            'name' => 'required',
            'kode' => 'required',
            'user_id' => 'required',
        ]);

        $request['kode'] = $request->name . '-' . $request->lantai;
        $matkul->update($request->all());
        Alert::success('Success Information', 'Mata Kuliah "' . $request->name . '" berhasil diperbaharui');
        return redirect('matkul');
    }

    public function destroy(Matkul $matkul)
    {
        $matkul->delete();
        Alert::success('Success Information', 'Mata Kuliah "' . $matkul->name . '" berhasil dihapus');
        return redirect('matkul');
    }
}
