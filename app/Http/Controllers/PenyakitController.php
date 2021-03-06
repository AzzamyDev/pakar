<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use App\Models\Penyakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpParser\JsonDecoder;

class PenyakitController extends Controller
{

    //Construktor untuk Auth
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin|psikolog']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penyakit = Penyakit::orderBy('id', 'asc')->get();
        return view('konten.penyakit.index')->with(compact('penyakit'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('konten.penyakit.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'image' => 'required'
        ]);

        $image = $request->file('image');
        $imageName = now()->timestamp . "_" . $image->getClientOriginalName();
        $pathImage = 'image';
        $request->file('image')->storeAs($pathImage, $imageName);

        $img_url = url('storage/image/' . $imageName);

        $subDeskripsi = substr(strip_tags($request->deskripsi), 0, 200);
        $count = Penyakit::all()->count();
        $kode = 'P' . ($count + 1);

        Penyakit::create([
            'nama' => $request->nama,
            'kode' => $kode,
            'deskripsi' => $request->deskripsi,
            'sub_deskripsi' => $subDeskripsi,
            'image_name' => $imageName,
            'path_img' => $img_url,
        ]);

        return redirect()->route('diseases.index')->with('save', 'Berhasil di simpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penyakit  $penyakit
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Penyakit::find($id);
        return view('konten.penyakit.detail')->with(compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penyakit  $penyakit
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Penyakit::find($id);
        return view('konten.penyakit.edit')->with(compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Penyakit  $penyakit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $penyakit = Penyakit::find($id);

        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
        ]);

        $image = $request->file('image');
        if ($image != null) {
            $imageName = now()->timestamp . "_" . $image->getClientOriginalName();
            $pathImage = 'image';
            $request->file('image')->storeAs($pathImage, $imageName);

            $img_url = url('storage/image/' . $imageName);

            Storage::disk('public')->delete('/image/' . $penyakit->image_name);
        } else {
            $imageName = $penyakit->image_name;
            $img_url = $penyakit->path_img;
        }

        $subDeskripsi = substr(strip_tags($request->deskripsi), 0, 200);

        $penyakit->nama = $request->nama;
        $penyakit->deskripsi = $request->deskripsi;
        $penyakit->sub_deskripsi = $subDeskripsi;
        $penyakit->image_name = $imageName;
        $penyakit->path_img = $img_url;
        $penyakit->save();

        return redirect()->route('diseases.index')->with('update', 'Update berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penyakit  $penyakit
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $penyakit = Penyakit::find($id);
        Storage::disk('public')->delete('/image/' . $penyakit->image_name);
        $penyakit->delete();
        return back()->with('delete', 'Berhasil dihapus');
    }

    public function setGejala(Request $request, $id)
    {
        $penyakit = Penyakit::find($id);
        $penyakit->list_gejala = $request->gejala != null ? json_encode($request->gejala) : '[]';
        $penyakit->save();
        return redirect()->route('diseases.index');
    }

    public function viewSet($id)
    {

        $gejala = Gejala::all();
        $penyakit = Penyakit::find($id);
        $data = json_decode($penyakit->list_gejala);
        return view('konten.penyakit.set_gejala')->with(compact('penyakit', 'gejala', 'data'));
    }
}
