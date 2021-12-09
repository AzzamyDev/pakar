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
        $penyakit = Penyakit::orderBy('nama', 'ASC')->get();
        $gejala = Gejala::orderBy('nama_gejala', 'ASC')->get();
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
        $penyakit = Penyakit::orderBy('nama', 'ASC')->get();
        return response()->json([
            'status' => true,
            'data' => $penyakit,
        ], 200);
    }

    public function getGejala()
    {
        $Gejala = Gejala::orderBy('nama_gejala', 'ASC')->get();
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
        $listPenyakit = Penyakit::all();
        $kodeHasil = [];
        $hasil = json_decode($request->hasil);
        $cfCombine = 0;
        $cf1 = 0;
        $cf2 = 0;

        if (count($hasil) <= 1) {
            return response()->json([
                'status' => false,
                'result' => 'Tidak di temukan penyakit yang cocok'
            ]);
        }
        ksort($hasil);
        foreach ($hasil as $i => $value) {
            $kodeHasil[] = $value->kode;

            if ($cfCombine === 0) {
                //define Cf1
                $cf1 = $value->nilai_pakar * $value->nilai_user;

                //define Cf2
                $item = $hasil[$i + 1];
                $cf2 = $item->nilai_pakar * $item->nilai_user;

                //Colculate Combine
                $jumlahCf2 = $cf2 * (1 - $cf1);
                $cfCombine = $cf1 + $jumlahCf2;
            } else {
                if (count($hasil) - 1 != $i) {
                    //define Cf2
                    $item = $hasil[$i + 1];
                    $cf2 = $item->nilai_pakar * $item->nilai_user;

                    //Colculate Combine
                    $jumlahCf2 = $cf2 * (1 - $cfCombine);
                    $cfCombine += $jumlahCf2;
                } else {
                }
            }
        }

        // $gejala_penyakit = json_decode($listPenyakit[2]->list_gejala);
        // sort($gejala_penyakit, SORT_STRING);
        // sort($kodeHasil, SORT_STRING);
        // dd($gejala_penyakit == $kodeHasil);
        $result = 'Tidak di temukan penyakit yang cocok';
        $id_penyakit = null;
        foreach ($listPenyakit as $key => $penyakit) {
            $gejala_penyakit = json_decode($penyakit->list_gejala);

            sort($gejala_penyakit);
            sort($kodeHasil);
            if ($gejala_penyakit == $kodeHasil) {
                $id_penyakit = $penyakit->id;
                $result = $penyakit->nama;
                break;
            }
        }

        if ($result == 'Tidak di temukan penyakit yang cocok') {
            return response()->json([
                'status' => false,
                'result' => $result
            ]);
        }

        $diagnosa = Riwayat::create([
            'user_id' => $request->user()->id,
            'tanggal' => now(),
            'hasil_diagnosa' => $result,
            'persentase_diagnosa' => number_format($cfCombine * 100) . '%',
            'id_penyakit' => $id_penyakit,
            'json_gejala' => json_encode($kodeHasil)
        ]);

        return response()->json([
            'status' => true,
            'result' => $diagnosa
        ]);
    }
}
