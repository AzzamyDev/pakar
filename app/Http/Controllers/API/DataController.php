<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Gejala;
use App\Models\Riwayat;
use App\Models\Penyakit;
use App\Models\Psikolog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GrahamCampbell\ResultType\Result;

class DataController extends Controller
{

    public function getAllData(Request $request)
    {
        $penyakit = Penyakit::orderBy('nama', 'ASC')->get(); // getdata penyakit berdasarkan nama dengan method ASC

        $gejala = Gejala::orderBy('nama_gejala', 'ASC')->get(); //get data gejala
        foreach ($gejala as $key => $value) {
            $gejala[$key] = collect($value)->put('nilai_user', 0)->put('check', false);
        }
        $psikolog = User::role('psikolog')->get(); // get User yang mempunyai role psikolog
        $riwayat = $request->user()->riwayat; //get riwayat user
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
        $gejala = Gejala::orderBy('nama_gejala', 'ASC')->get(); //get data gejala
        foreach ($gejala as $key => $value) {
            $gejala[$key] = collect($value)->put('nilai_user', 0)->put('check', false);
        }
        return response()->json([
            'status' => true,
            'data' => $gejala,
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

    //method hitung
    public function hitung2(Request $request)
    {
        // get semua data penyakit
        $listPenyakit = Penyakit::all();

        //inisialisasi variable
        $kodeHasil = [];
        $result = [];
        $arrKode = array();

        //mengambil data dari user melalui request
        $gejalaUser = json_decode($request->hasil);


        //get kode gejala user
        // foreach ($gejalaUser as $value) {
        //     $arrKode[] = $value->kode;
        // }

        ///tes
        // $gejala_penyakit = json_decode($listPenyakit[2]->list_gejala);
        // sort($gejala_penyakit, SORT_STRING);
        // sort($arrKode, SORT_STRING);
        // $h = array_intersect($arrKode, $gejala_penyakit);
        // $hasil = [];
        // for ($i = 0; $i < count($gejalaUser); $i++) {

        //     for ($c = 0; $c < count($h); $c++) {
        //         if ($gejalaUser[$i]->kode == $h[$c]) {
        //             $hasil[] = $gejalaUser[$i];
        //         }
        //     }
        // }
        // dd($hasil);

        //tesend
        // return response()->json([
        //     'data' => collect($gejalaUser)->count()
        // ]);
        //proses iterasi daftar penyakit
        foreach ($listPenyakit as $key => $penyakit) {

            //get rule penyakit
            $rules = $penyakit->gejala()->get()->sortBy('kode');
            // foreach ($rules as $item) {
            //     $item = collect($item)->put('bobot', 1);
            //     dd($item->toArray());
            // }

            //decode json list gejala
            $gUser = collect($gejalaUser)->sortBy('kode');
            $hasil = $gUser->whereIn('kode', $rules->pluck('kode'));
            foreach ($hasil as $key => $value) {
                $hasil[$key] = collect($value)->put('nilai_pakar', $rules->firstWhere('kode', $value->kode)->pivot->nilai_pakar);
            }
            // dd($hasil->toArray());
            //start perhitungan CF


            // $cfFinal = 0;
            // if ($hasil->count() == 1) {
            //     // dd($hasil->first()['nilai_pakar']);
            //     $cfCombine = $hasil->first()['nilai_pakar'] * $hasil->first()['nilai_user'];
            //     $cfFinal = $cfCombine;
            //     $r = ([
            //         'id' => $penyakit->id,
            //         'nama_penyakit' => $penyakit->nama,
            //         'persentase' => round($cfFinal, 2) * 100,
            //     ]);
            // } else {
            //     $cfCombine = 0;
            //     $cf1 = 0;
            //     $cf2 = 0;
            //     foreach ($hasil as $i => $value) {
            //         // dd($value->toArray());
            //         $kodeHasil[] = $value['kode'];
            //         if ($i == 0) {
            //             //define Cf1
            //             $cf1 = $value['nilai_pakar'] * $value['nilai_user'];
            //             return response()->json([
            //                 'data' => $hasil->get($i + 1)
            //             ]);
            //             //define Cf2
            //             $item = $hasil[$i + 1];
            //             $cf2 = $item['nilai_pakar'] * $item['nilai_user'];

            //             //Colculate Combine
            //             $jumlahCf2 = $cf2 * (1 - $cf1);
            //             $cfCombine = $cf1 + $jumlahCf2;
            //         } else {
            //             if (
            //                 $hasil->count() - 1 != $i
            //             ) {
            //                 //define Cf2
            //                 $item = $hasil[$i + 1];
            //                 $cf2 = $item['nilai_pakar'] * $item['nilai_user'];

            //                 //Colculate Combine
            //                 $jumlahCf2 = $cf2 * (1 - $cfCombine);
            //                 $cfCombine += $jumlahCf2;
            //             } else {
            //             }
            //         }
            //         //lempar resul combine ke variable
            //         $cfFinal = $cfCombine;
            //     }
            // }
            //menambahkan data
            // $r = ([
            //     'id_penyakit' => $penyakit->id,
            //     'nama_penyakit' => $penyakit->nama,
            //     'persentase' => round($cfFinal, 2) * 100,
            // ]);
            // $result[] = $r;

            //pengurutan list
            // sort($gejala_penyakit);
            // sort($arrKode);

            //mengecek apakah gejala user ada di list gejala dari penyakit
            // $h = array_intersect($arrKode, $gejala_penyakit);
            // if ($h) {

            //     //init variable
            //     $cfFinal = 0;
            //     $hasil = [];
            //     for ($i = 0; $i < count($gejalaUser); $i++) {
            //         foreach ($h as $key => $value) {
            //             if ($gejalaUser[$i]->kode == $value) {
            //                 $hasil[] = $gejalaUser[$i];
            //             }
            //         }
            //     }
            //     ksort($hasil);

            //     //start perhitungan CF
            //     if (count($hasil) == 1) {
            //         $cfCombine = $hasil[0]->nilai_pakar * $hasil[0]->nilai_user;
            //         $cfFinal = $cfCombine;
            //         $r = ([
            //             'id' => $penyakit->id,
            //             'nama_penyakit' => $penyakit->nama,
            //             'persentase' => round($cfFinal, 2) * 100,
            //         ]);
            //     } else {
            //         $cfCombine = 0;
            //         $cf1 = 0;
            //         $cf2 = 0;
            //         foreach ($hasil as $i => $value) {
            //             $kodeHasil[] = $value->kode;

            //             if ($cfCombine === 0) {
            //                 //define Cf1
            //                 $cf1 = $value->nilai_pakar * $value->nilai_user;

            //                 //define Cf2
            //                 $item = $hasil[$i + 1];
            //                 $cf2 = $item->nilai_pakar * $item->nilai_user;

            //                 //Colculate Combine
            //                 $jumlahCf2 = $cf2 * (1 - $cf1);
            //                 $cfCombine = $cf1 + $jumlahCf2;
            //             } else {
            //                 if (count($hasil) - 1 != $i) {
            //                     //define Cf2
            //                     $item = $hasil[$i + 1];
            //                     $cf2 = $item->nilai_pakar * $item->nilai_user;

            //                     //Colculate Combine
            //                     $jumlahCf2 = $cf2 * (1 - $cfCombine);
            //                     $cfCombine += $jumlahCf2;
            //                 } else {
            //                 }
            //             }
            //             //lempar resul combine ke variable
            //             $cfFinal = $cfCombine;
            //         }
            //     }
            //     //menambahkan data
            //     $r = ([
            //         'id_penyakit' => $penyakit->id,
            //         'nama_penyakit' => $penyakit->nama,
            //         'persentase' => round($cfFinal, 2) * 100,
            //     ]);
            //     $result[] = $r;
            // } else {
            // }
        }
        usort(
            $result,
            function ($a, $b) {
                return $b['persentase'] <=> $a['persentase'];
            }
        );

        //menambahkan result ke riwayat
        Riwayat::create([
            'user_id' => $request->user()['id'],
            'tanggal' => now()->format('Y-m-d H:i:s'),
            'hasil_diagnosa' => $result[0]['nama_penyakit'],
            'persentase_diagnosa' => $result[0]['persentase'] . '%',
            'lainnya' => json_encode($result),
        ]);
        //mengembalikan response
        return response()->json([
            'status' => true,
            'data' => $result
        ]);
    }

    public function hitung(Request $request)
    {
        // get semua data penyakit
        $listPenyakit = Penyakit::all();

        //mengambil data dari user melalui request
        $collected = json_decode($request->hasil);
        $result = array();
        foreach ($listPenyakit as $penyakit) {
            // $penyakit = Penyakit::find(5);

            $rules = $penyakit->gejala()->get()->sortBy('kode');
            $gUser = collect($collected);
            $hasil = $gUser->whereIn('kode', $rules->pluck('kode'));
            foreach ($hasil as $key => $value) {
                $hasil[$key] = collect($value)->put('nilai_pakar', $rules->firstWhere('kode', $value->kode)->pivot->nilai_pakar);
            }

            $gejalaUser = collect($hasil->values())->map(function ($value, $key) {

                return ['CF' => round($value['nilai_pakar'] * $value['nilai_user'], 2)];
            });
            // dd($gejalaUser->toArray());
            $cfCombine = 0;

            $r = null;
            foreach ($gejalaUser->values() as $key => $value) {
                if ($gejalaUser->count() == 1) {
                    $cfCombine = $value['CF'];
                    $cfFinal = $cfCombine;
                    $r = ([
                        'id' => $penyakit->id,
                        'nama_penyakit' => $penyakit->nama,
                        'persentase' => round($cfFinal, 2) * 100,
                    ]);
                } else {
                    switch ($key) {
                        case 0:
                            $cf1 = $value['CF'];
                            $cf2 = $gejalaUser->get(++$key)['CF'];
                            $cf = $cf1 + $cf2 * (1 - $cf1);
                            $cfCombine = $cf;
                            break;
                        case 1:
                            break;
                        case $gejalaUser->count():
                            break;

                        default:
                            $cfOld = $cfCombine;
                            $currentCF = $value['CF'];
                            $cf = $cfOld + ($currentCF * (1 - $cfOld));
                            $cfCombine = $cf;
                            break;
                    }
                    //lempar resul combine ke variable
                    $cfFinal = $cfCombine;
                    $r = ([
                        'id' => $penyakit->id,
                        'nama_penyakit' => $penyakit->nama,
                        'persentase' => round($cfFinal, 2) * 100,
                    ]);
                }
            }
            //menambahkan data
            if ($r != null) {
                $result[] = $r;
            }
        }
        usort(
            $result,
            function ($a, $b) {
                return $b['persentase'] <=> $a['persentase'];
            }
        );
        //menambahkan result ke riwayat
        Riwayat::create([
            'user_id' => $request->user()['id'],
            'tanggal' => now()->format('Y-m-d H:i:s'),
            'hasil_diagnosa' => $result[0]['nama_penyakit'],
            'persentase_diagnosa' => $result[0]['persentase'] . '%',
            'lainnya' => json_encode($result),
        ]);
        return response()->json([
            'status' => true,
            'data' => $result
        ]);
    }
}
