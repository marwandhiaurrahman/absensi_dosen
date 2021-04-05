<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\User as UserResorces;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Jadwal;
use App\Models\Product;
use Validator;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends BaseController
{
    public function dashboard()
    {
        $user = Auth::user();
        $jadwals = Jadwal::where('hari','1')->get()->all();
        foreach ($jadwals as $jadwal) {
           if($jadwal->matkul->dosen->id == $user->id){
               $jadwaltodays[] = $jadwal;
           }
        }
        return $this->sendResponse([
            'user'=>new UserResorces($user),
            'jadwaltodays'=>new UserResorces($jadwaltodays),
        ], 'Product retrieved successfully.');
    }
}
