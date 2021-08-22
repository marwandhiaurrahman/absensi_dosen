<?php

namespace App\Http\Controllers;

use App\Models\Gedung;
use App\Models\Ruangan;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class RuanganController extends Controller
{
    public function index()
    {
        $ruangans = Ruangan::latest()->get();
        return view('admin.ruangan.index', compact('ruangans'))->with('i', (request()->input('page', 1) - 1));
    }

    public function create()
    {
        $gedungs = Gedung::get();
        return view('admin.ruangan.create', compact('gedungs'));
    }

    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'lantai' => 'required',
            'gedung_id' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $ruangan = new Ruangan();
        $ruangan->name = $request->name;
        $ruangan->lantai = $request->lantai;
        $ruangan->gedung_id = $request->gedung_id;
        $ruangan->kode =  $request->name . '-' . $request->lantai;
        // dd($request->latitude);
        $ruangan->location = new Point($request->latitude, $request->longitude);    // (lat, lng, srid)
        $ruangan->save();
        // Ruangan::updateOrCreate($request->only(['name', 'lantai', 'gedung_id','kode']));
        Alert::success('Success Information', 'Ruangan "' . $request->name . '" berhasil ditambahkan');
        return redirect('ruangan');
    }

    public function edit(Ruangan $ruangan)
    {
        $gedungs = Gedung::get();
        return view('admin.ruangan.edit', compact('ruangan', 'gedungs'));
    }

    public function update(Request $request, Ruangan $ruangan)
    {
        request()->validate([
            'name' => 'required',
            'lantai' => 'required',
            'gedung_id' => 'required',
        ]);

        $request['kode'] = $request->name . '-' . $request->lantai;
        $ruangan->update($request->all());
        Alert::success('Success Information', 'Gedung "' . $request->name . '" berhasil diperbaharui');
        return redirect('ruangan');
    }

    public function destroy(Ruangan $ruangan)
    {
        $ruangan->delete();
        Alert::success('Success Information', 'Gedung "' . $ruangan->name . '" berhasil dihapus');
        return redirect('ruangan');
    }
}
