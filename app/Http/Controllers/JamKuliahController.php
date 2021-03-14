<?php

namespace App\Http\Controllers;

use App\Models\JamKuliah;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class JamKuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jamkuls = JamKuliah::latest()->get();
        return view('admin.jamkul.index', compact('jamkuls'))->with('i', (request()->input('page', 1) - 1));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.jamkul.create');
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
            'masuk' => 'required',
            'keluar' => 'required',
            'sks' => 'required',
        ]);

        JamKuliah::updateOrCreate($request->only(['masuk', 'keluar', 'sks']));
        Alert::success('Success Information', 'Jam Kuliah "' . $request->masuk . '" berhasil ditambahkan');
        return redirect('jamkul');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JamKuliah  $jamkul
     * @return \Illuminate\Http\Response
     */
    public function show(JamKuliah $jamkul)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JamKuliah  $jamkul
     * @return \Illuminate\Http\Response
     */
    public function edit(JamKuliah $jamkul)
    {
        return view('admin.jamkul.edit', compact('jamkul'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JamKuliah  $jamkul
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JamKuliah $jamkul)
    {
        request()->validate([
            'masuk' => 'required',
            'keluar' => 'required',
            'sks' => 'required',
        ]);

        $jamkul->update($request->all());
        Alert::success('Success Information', 'Jam Kuliah "' . $request->masuk . '" berhasil diperbaharui');
        return redirect('jamkul');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JamKuliah  $jamkul
     * @return \Illuminate\Http\Response
     */
    public function destroy(JamKuliah $jamkul)
    {
        $jamkul->delete();
        Alert::success('Success Information', 'Jam Kuliah "' . $jamkul->masuk . '" berhasil dihapus');
        return redirect('jamkul');
    }
}
