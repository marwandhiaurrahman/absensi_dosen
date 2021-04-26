<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\User as UserResorces;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Product;
use Carbon\Carbon;
use Validator;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends BaseController
{
    public function dashboard()
    {
        $jadwaltodays=null;
        $user = Auth::user();
        $jadwals = Jadwal::where('hari',Carbon::now()->dayOfWeek)->get()->all();
        foreach ($jadwals as $jadwal) {
           if($jadwal->matkul->dosen->id == $user->id){
                $jadwaltodays[] = $jadwal;
                $jadwal->ruangan;
                $jadwal->kelas;
                $jadwal->jamkul;
                $jadwal->ruangan;
           }
        }
        if(is_null($user)){
            $user=null;
        }
        if(is_null($jadwaltodays)){
            $jadwaltodays=null;
        }
        // $kelas = Kelas::get()->all();
        return $this->sendResponse([
            'user'=>new UserResorces($user),
            'jadwaltodays'=>new UserResorces($jadwaltodays),
        ], 'Product retrieved successfully.');
    }

    public function jadwals()
    {
        $jadwalsSaya=null;
        $user = Auth::user();
        $jadwals = Jadwal::get()->all();
        foreach ($jadwals as $jadwal) {
           if($jadwal->matkul->dosen->id == $user->id){
                $jadwalsSaya[] = $jadwal;
                $jadwal->ruangan;
                $jadwal->kelas;
                $jadwal->jamkul;
                $jadwal->ruangan;
           }
        }
        if(is_null($user)){
            $user=null;
        }
        if(is_null($jadwalsSaya)){
            $jadwalsSaya=null;
        }
        // $kelas = Kelas::get()->all();
        return $this->sendResponse([
            'jadwals'=>new UserResorces($jadwalsSaya),
        ], 'Product retrieved successfully.');
    }

    public function getabsensi($jadwal_id)
    {
        $jadwal = Jadwal::find($jadwal_id);
        $absensi = $jadwal->absensi;
        $absensi_aktif = $jadwal->absensi->where('keluar',null)->all();

        return $this->sendResponse([
            'absensi'=>new UserResorces($absensi),
            'absensi_aktif'=>new UserResorces($absensi_aktif),
        ], 'Data Absensi retrieved successfully.');
    }
}
