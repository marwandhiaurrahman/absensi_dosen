<?php

namespace App\Http\Controllers;

use App\Models\Fakulta;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class FakultaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fakultas = Fakulta::latest()->get();
        return view('admin.fakultas.index', compact('fakultas'))->with('i', (request()->input('page', 1) - 1));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.fakultas.create');
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
        ]);

        Fakulta::updateOrCreate($request->only(['name', 'kode']));
        Alert::success('Success Information', 'Fakultas "' . $request->name . '" berhasil ditambahkan');
        return redirect('fakultas');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fakulta  $fakulta
     * @return \Illuminate\Http\Response
     */
    public function show(Fakulta $fakulta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fakulta  $fakulta
     * @return \Illuminate\Http\Response
     */
    public function edit(Fakulta $fakulta)
    {
        return view('admin.fakultas.edit', compact('fakulta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fakulta  $fakulta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fakulta $fakulta)
    {
        request()->validate([
            'name' => 'required',
            'kode' => 'required',
        ]);

        $fakulta->update($request->all());
        Alert::success('Success Information', 'Fakultas "' . $request->name . '" berhasil diperbaharui');
        return redirect('fakultas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fakulta  $fakulta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fakulta $fakulta)
    {
        $fakulta->delete();
        Alert::success('Success Information', 'Fakultas "' . $fakulta->name . '" berhasil dihapus');
        return redirect('fakultas');
    }
}
