<?php

namespace App\Http\Controllers\API;

use App\Models\Gejala;
use App\Models\Penyakit;
use App\Models\Psikolog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Riwayat;

class DataController extends Controller
{
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
        $Psikolog = Psikolog::all();
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
}
