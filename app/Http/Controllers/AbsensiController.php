<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Jadwal;
use App\Models\JamKuliah;
use App\Models\Kelas;
use App\Models\Location;
use App\Models\Matkul;
use App\Models\Ruangan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Grimzy\LaravelMysqlSpatial\Types\Point;


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
        $this->validate($request, [
            'metode' => 'required',
            'tanggal' => 'required',
            'pembahasan' => 'required',
            'jadwal_id' => 'required',
            'lat_anda' => 'required',
            'long_anda' => 'required',
        ]);

        dd($request->all());

        $request['masuk'] = Carbon::now();
        $request['keluar'] = null;

        $patokan = Location::first();
        $patokan_lat = $patokan->location->getLat();
        $patokan_long = $patokan->location->getLng();

        $jarak = $this->distance($patokan_lat, $patokan_long, $request->lat_anda, $request->long_anda, "K");

        if ($request->metode == "Tatap Muka") {
            if ($jarak * 1000 <= $patokan->jarak_min) {
                $request['validasi'] = true;
                $request['jarak'] = $jarak * 1000;
            } else {
                Alert::error('Error Information', 'Absensi Tidak Valid, jarak anda terlalu jauh');
                return redirect()->back();
            }
        }
        if ($request->metode == "E-Class") {
            $request['validasi'] = true;
            $request['jarak'] = $jarak * 1000;
        }


        $absensis = Absensi::where('jadwal_id', $request->jadwal_id)->count();
        $request['pertemuan'] = $absensis + 1;

        Absensi::create($request->all());
        Alert::success('Success Information', 'Jadwal berhasil ditambahkan');
        return redirect()->back();
    }

    public function distance($lat1, $lon1, $lat2, $lon2, $unit)
    {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
            return 0;
        } else {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $unit = strtoupper($unit);

            if ($unit == "K") {
                return ($miles * 1.609344);
            } else if ($unit == "N") {
                return ($miles * 0.8684);
            } else {
                return $miles;
            }
        }
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
        $absensis = Absensi::where('jadwal_id', $id)->get();

        return view('admin.absensi.show', compact('jadwal', 'matkuls', 'ruangans', 'kelass', 'jamkuls', 'absensis'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function edit(Absensi $absensi)
    {
        $matkuls = Matkul::get();
        $ruangans = Ruangan::get();
        $kelass = Kelas::get();
        $jamkuls = JamKuliah::orderBy('masuk', 'ASC')->get();
        $jadwal = Jadwal::find($absensi->jadwal_id);
        return view('admin.absensi.edit',compact('absensi','jadwal', 'matkuls', 'ruangans', 'kelass', 'jamkuls'));
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
        $this->validate($request, [
            'metode' => 'required',
            'tanggal' => 'required',
            'pembahasan' => 'required',
            'jadwal_id' => 'required',
            'lat_anda' => 'required',
            'long_anda' => 'required',
        ]);

        $request['keluar'] = Carbon::now();

        $patokan = Location::first();
        $patokan_lat = $patokan->location->getLat();
        $patokan_long = $patokan->location->getLng();

        $jarak = $this->distance($patokan_lat, $patokan_long, $request->lat_anda, $request->long_anda, "K");

        if ($request->metode == "Tatap Muka") {
            if ($jarak * 1000 <= $patokan->jarak_min) {
                $request['validasi'] = true;
                $request['jarak'] = $jarak * 1000;
            } else {
                Alert::error('Error Information', 'Absensi Tidak Valid, jarak anda terlalu jauh');
                return redirect()->back();
            }
        }
        if ($request->metode == "E-Class") {
            $request['validasi'] = true;
            $request['jarak'] = $jarak * 1000;
        }

        $absensi->update($request->all());
        Alert::success('Success Information', 'Absensi Keluar Diterima');
        return redirect()->route('absensi.show',$absensi->jadwal_id);
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
