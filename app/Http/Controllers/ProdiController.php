<?php

namespace App\Http\Controllers;

use App\Models\Fakulta;
use App\Models\Prodi;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prodis = Prodi::latest()->get();
        return view('admin.prodi.index', compact('prodis'))->with('i', (request()->input('page', 1) - 1));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fakultas = Fakulta::get();
        return view('admin.prodi.create', compact('fakultas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'kode' => 'required',
            'fakultas_id' => 'required',

        ]);
        Prodi::updateOrCreate($request->only(['name', 'kode','fakultas_id']));
        Alert::success('Success Information', 'Kelas "' . $request->name . '" berhasil ditambahkan');
        return redirect('prodi');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Prodi  $prodi
     * @return \Illuminate\Http\Response
     */
    public function show(Prodi $prodi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Prodi  $prodi
     * @return \Illuminate\Http\Response
     */
    public function edit(Prodi $prodi)
    {
        $fakultas = Fakulta::get();
        return view('admin.prodi.edit', compact('prodi','fakultas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Prodi  $prodi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prodi $prodi)
    {
        request()->validate([
            'name' => 'required',
            'kode' => 'required',
            'fakultas_id' => 'required',
        ]);

        $prodi->update($request->all());
        Alert::success('Success Information', 'Kelas "' . $request->name . '" berhasil diperbaharui');
        return redirect('prodi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prodi  $prodi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prodi $prodi)
    {
        $prodi->delete();
        Alert::success('Success Information', 'Kelas "' . $prodi->name . '" berhasil dihapus');
        return redirect('prodi');
    }
}
