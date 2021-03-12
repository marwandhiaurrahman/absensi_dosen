<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Prodi;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelass = Kelas::latest()->get();
        return view('admin.kelas.index', compact('kelass'))->with('i', (request()->input('page', 1) - 1));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $prodi = Prodi::get();
        return view('admin.kelas.create', compact('prodi'));
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
            'tahun' => 'required',
            'prodi_id' => 'required',
        ]);

        $request['kode'] = Prodi::find($request->prodi_id)->kode.$request->tahun. $request->name ;
        Kelas::create($request->all());
        Alert::success('Success Information', 'Kelas "' . $request->name . '" berhasil ditambahkan');
        return redirect('kelas');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function show(Kelas $kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function edit(Kelas $kela)
    {
        $prodi = Prodi::get();
        return view('admin.kelas.edit', compact('kela','prodi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kelas $kelas)
    {
        request()->validate([
            'name' => 'required',
            'kode' => 'required',
            'fakultas_id' => 'required',
        ]);

        $kelas->update($request->all());
        Alert::success('Success Information', 'Kelas "' . $request->name . '" berhasil diperbaharui');
        return redirect('kelas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kelas $kelas)
    {
        $kelas->delete();
        Alert::success('Success Information', 'Kelas "' . $kelas->name . '" berhasil dihapus');
        return redirect('kelas');
    }
}
