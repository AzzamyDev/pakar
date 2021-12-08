<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Gejala;
use App\Models\Riwayat;
use App\Models\Penyakit;
use App\Models\Psikolog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DataController extends Controller
{

    public function getAllData(Request $request)
    {
        $penyakit = Penyakit::all();
        $gejala = Gejala::all();
        $psikolog = User::role('psikolog')->get();
        $riwayat = $request->user()->riwayat;
        $user = [
            'name' => $request->user()->name,
            'email' => $request->user()->email,
            'no_telpon' => $request->user()->no_telpon,
            'alamat' => $request->user()->alamat,
            'path_img' => $request->user()->path_img,
            'image_name' => $request->user()->image_name,
        ];

        return response()->json([
            'status' => true,
            'penyakit' => $penyakit,
            'gejala' => $gejala,
            'psikolog' => $psikolog,
            'riwayat' => $riwayat,
            'user' => $user
        ], 200);
    }


    public function getPenyakit()
    {
        $penyakit = Penyakit::all();
        return response()->json([
            'status' => true,
            'data' => $penyakit,
        ], 200);
    }

    public function getGejala()
    {
        $Gejala = Gejala::all();
        return response()->json([
            'status' => true,
            'data' => $Gejala,
        ], 200);
    }

    public function getPsikolog()
    {
        $Psikolog = User::role('psikolog')->get();
        return response()->json([
            'status' => true,
            'data' => $Psikolog,
        ], 200);
    }

    public function getRiwayat(Request $request)
    {
        $riwayat = $request->user()->riwayat;
        return response()->json([
            'status' => true,
            'data' => $riwayat,
        ], 200);
    }

    public function addRiwayat(Request $request)
    {
        Riwayat::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Riwayat berhasil di simpan'
        ]);
    }

    public function hitung(Request $request)
    {
    }
}
