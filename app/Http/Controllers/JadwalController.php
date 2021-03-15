<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\JamKuliah;
use App\Models\Kelas;
use App\Models\Matkul;
use App\Models\Ruangan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jadwals = Jadwal::get();
        $jamkuls = JamKuliah::orderBy('masuk', 'ASC')->get();
        $matkuls = Matkul::get();
        $ruangans = Ruangan::get();
        $kelass = Kelas::get();
        return view('admin.jadwal.index', compact('jadwals', 'jamkuls', 'matkuls', 'ruangans', 'kelass'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $matkuls = Matkul::get();
        $ruangans = Ruangan::get();
        $kelass = Kelas::get();
        $jamkuls = JamKuliah::orderBy('masuk', 'ASC')->get();
        return view('admin.jadwal.create', compact('matkuls', 'ruangans', 'kelass', 'jamkuls'));
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
            'matkul_id' => 'required',
            'kelas_id' => 'required',
            'ruangan_id' => 'required',
            'jam' => 'required',
            'hari' => 'required',
        ]);
        $request['kode'] = $request->kelas_id . '-' . $request->matkul_id . '-' . $request->ruangan_id . '-' . $request->jam . '-' . $request->hari;
        Jadwal::create($request->all());
        Alert::success('Success Information', 'Jadwal berhasil ditambahkan');
        return redirect('jadwal');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function show(Jadwal $jadwal)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function edit(Jadwal $jadwal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jadwal $jadwal)
    {
        //
    }
}
