<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\User as UserResorces;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Absensi;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Location;
use App\Models\Product;
use Carbon\Carbon;
use Validator;
use Grimzy\LaravelMysqlSpatial\Types\Point;

use Illuminate\Support\Facades\Auth;

class AbsensiController extends BaseController
{
    public function dashboard()
    {
        $jadwaltodays = null;
        $user = Auth::user();
        $jadwals = Jadwal::where('hari', Carbon::now()->dayOfWeek)->get()->all();
        foreach ($jadwals as $jadwal) {
            if ($jadwal->matkul->dosen->id == $user->id) {
                $jadwaltodays[] = $jadwal;
                $jadwal->ruangan;
                $jadwal->kelas;
                $jadwal->jamkul;
                $jadwal->ruangan;
            }
        }
        if (is_null($user)) {
            $user = null;
        }
        if (is_null($jadwaltodays)) {
            $jadwaltodays = null;
        }

        $absensi_aktif = null;
        $jadwalsemua = Jadwal::all();
        foreach ($jadwalsemua as $jadwalaktif) {
            if ($jadwalaktif->matkul->dosen->id == $user->id) {
                $jadwalaktif->matkul;
                $jadwalaktif->ruangan;
                $jadwalaktif->kelas;
                $jadwalaktif->jamkul;
                $jadwalaktif->ruangan;
                foreach ($jadwalaktif->absensi as $absensiaktif) {
                    if ($absensiaktif->keluar == null) {
                        $absensi_aktif[] = $jadwalaktif;
                    }
                }
            }
        }
        // dd($absensi_aktif);
        // $kelas = Kelas::get()->all();
        return $this->sendResponse([
            'user' => new UserResorces($user),
            'jadwaltodays' => new UserResorces($jadwaltodays),
            'jadwalaktif' => new UserResorces($absensi_aktif),
        ], 'Retrieved data successfully.');
    }

    public function jadwals()
    {
        $jadwalsSaya = null;
        $user = Auth::user();
        $jadwals = Jadwal::get()->all();
        foreach ($jadwals as $jadwal) {
            if ($jadwal->matkul->dosen->id == $user->id) {
                $jadwalsSaya[] = $jadwal;
                $jadwal->ruangan;
                $jadwal->kelas;
                $jadwal->jamkul;
                $jadwal->ruangan;
            }
        }
        if (is_null($user)) {
            $user = null;
        }
        if (is_null($jadwalsSaya)) {
            $jadwalsSaya = null;
        }
        // $kelas = Kelas::get()->all();
        return $this->sendResponse([
            'jadwals' => new UserResorces($jadwalsSaya),
        ], 'Product retrieved successfully.');
    }

    public function getabsensi($jadwal_id)
    {
        $jadwal = Jadwal::find($jadwal_id);
        // dd($jadwal_id);
        $absensi = $jadwal->absensi;
        $absensi_aktif = $jadwal->absensi->where('keluar', null)->all();

        return $this->sendResponse([
            'absensi' => new UserResorces($absensi),
            'absensi_aktif' => new UserResorces($absensi_aktif),
        ], 'Data Absensi retrieved successfully.');
    }

    public function masukabsensi(Request $request)
    {

        $input = $request->all();

        $validator = Validator::make($input, [
            'metode' => 'required',
            'tanggal' => 'required',
            'pembahasan' => 'required',
            'jadwal_id' => 'required',
            'lat_anda' => 'required',
            'long_anda' => 'required',
            'jarak' => 'required',
        ]);

        $request['masuk'] = Carbon::now();
        $request['keluar'] = null;

        $patokan = Location::first();
        $patokan_lat = $patokan->location->getLat();
        $patokan_long = $patokan->location->getLng();

        $jarak = $this->distance($patokan_lat, $patokan_long, $request->lat_anda, $request->long_anda, "K");

        if ($request->metode == "Tatap Muka") {
            if ($jarak * 1000  <= $patokan->jarak_min) {
                $request['validasi'] = true;
                // $request['jarak'] = $jarak * 1000;
            } else {
                return $this->sendError('Anda diluar jangkauan absensi, jarak anda ' . $jarak);
                // return redirect()->back();
            }
        }

        if ($request->metode == "E-Class") {
            $request['validasi'] = true;
            // $request['jarak'] = $jarak;
        }

        $absensis = Absensi::where('jadwal_id', $request->jadwal_id)->count();

        $request['pertemuan'] = $absensis + 1;
        $input = $request->all();
        $absensi = Absensi::create($input);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        return $this->sendResponse(new UserResorces($absensi), 'Product created successfully.');
    }

    public function keluarabsensi(Request $request, int $id)
    {
        $input = $request->all();

        $absensi = Absensi::find($id);

        $validator = Validator::make($input, [
            'metode' => 'required',
            'tanggal' => 'required',
            'pembahasan' => 'required',
            'jadwal_id' => 'required',
            'lat_anda' => 'required',
            'long_anda' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $request['keluar'] = Carbon::now()->toTimeString();

        $patokan = Location::first();
        $patokan_lat = $patokan->location->getLat();
        $patokan_long = $patokan->location->getLng();

        $jarak = $this->distance($patokan_lat, $patokan_long, $request->lat_anda, $request->long_anda, "K");

        if ($request->metode == "Tatap Muka") {
            if ($jarak * 1000  <= $patokan->jarak_min) {
                $request['validasi'] = true;
                // $request['jarak'] = $jarak * 1000;
            } else {
                return $this->sendError('Anda diluar jangkauan absensi, jarak anda ' . $jarak);
            }
        }
        if ($request->metode == "E-Class") {
            $request['validasi'] = true;
            // $request['jarak'] = $jarak;
        }

        $absensi->update($request->all());
        return $this->sendResponse(new UserResorces($absensi), 'Absensi keluar successfully.');
    }

    public function getlocation()
    {
        $ref = Location::first();
        $lat = $ref->location->getLat();
        $long = $ref->location->getLng();
        // dd($lat);
        return $this->sendResponse([
            'latitude' => $lat,
            'longitude' => $long,
        ], 'Data retrieved successfully.');
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
}
