<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use RealRashid\SweetAlert\Facades\Alert;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Location::get();
        // dd($locations);
        return view('admin.lokasiabsensi.index', compact('locations'))->with('i', (request()->input('page', 1) - 1));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.lokasiabsensi.create');
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
            'latitude' => 'required',
            'longitude' => 'required',
            'jarak_min' => 'required',

        ]);

        $place1 = new Location();
        $place1->name = $request->name;
        $place1->jarak_min = $request->jarak_min;
        $place1->location = new Point($request->latitude, $request->longitude);    // (lat, lng, srid)
        $place1->save();
        // Location::create($request->all());
        Alert::success('Success Information', 'Location "' . $request->name . '" berhasil ditambahkan');
        return redirect('lokasi-absensi');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $lokasi_absensi)
    {
        $latitude = $lokasi_absensi->location->getLat();
        $longitude = $lokasi_absensi->location->getLng();
        return view('admin.lokasiabsensi.edit', compact('lokasi_absensi','latitude','longitude'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Location $lokasi_absensi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Location::find($id)->delete();
        Alert::success('Success Information', 'Lokasi berhasil dihapus');
        return redirect('lokasi-absensi');
    }
}
