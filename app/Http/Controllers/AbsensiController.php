<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Jadwal;
use App\Models\JamKuliah;
use App\Models\Kelas;
use App\Models\Matkul;
use App\Models\Ruangan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $jadwals = Jadwal::get();
        $jamkuls = JamKuliah::orderBy('masuk', 'ASC')->get();
        $matkuls = Matkul::get();
        $ruangans = Ruangan::get();
        $kelass = Kelas::get();

        return view('admin.absensi.index', compact('jadwals', 'jamkuls', 'matkuls', 'ruangans', 'kelass',))->with('i', (request()->input('page', 1) - 1));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'metode' => 'required',
            'tanggal' => 'required',
            'pembahasan' => 'required',
            'jadwal_id' => 'required',
        ]);
        $absensis = Absensi::where('jadwal_id',$request->jadwal_id)->count();
        $request['pertemuan'] = $absensis+1;
        Absensi::create($request->all());
        Alert::success('Success Information', 'Jadwal berhasil ditambahkan');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $matkuls = Matkul::get();
        $ruangans = Ruangan::get();
        $kelass = Kelas::get();
        $jamkuls = JamKuliah::orderBy('masuk', 'ASC')->get();
        $jadwal = Jadwal::find($id);
        $absensis = Absensi::where('jadwal_id',$id)->get();

        return view('admin.absensi.show', compact('jadwal', 'matkuls', 'ruangans', 'kelass', 'jamkuls','absensis'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function edit(Absensi $absensi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Absensi $absensi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Absensi $absensi)
    {
        //
    }
}
