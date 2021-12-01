<?php

namespace App\Http\Controllers;

use App\Models\Penyakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PenyakitController extends Controller
{

    //Construktor untuk Auth
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penyakit = Penyakit::orderBy('nama', 'asc')->get();
        return view('konten.penyakit.index')->with(compact('penyakit'));
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

        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'image' => 'required'
        ]);

        $image = $request->file('image');
        $imageName = now()->timestamp . "_" . $image->getClientOriginalName();
        $pathImage = 'public/image';
        $request->file('image')->storeAs($pathImage, $imageName);

        $img_url = url('storage/image/' . $imageName);

        Penyakit::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'image_name' => $imageName,
            'path_img' => $img_url,
        ]);

        return back()->with('save', 'Berhasil di simpan');
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
        return back()->with('edit', $data);
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
            $pathImage = 'public/image';
            $request->file('image')->storeAs($pathImage, $imageName);

            $img_url = url('storage/image/' . $imageName);

            Storage::disk('public')->delete('/image/' . $penyakit->image_name);
        } else {
            $imageName = $penyakit->image_name;
            $img_url = $penyakit->path_img;
        }

        $penyakit->nama = $request->nama;
        $penyakit->deskripsi = $request->deskripsi;
        $penyakit->image_name = $imageName;
        $penyakit->path_img = $img_url;
        $penyakit->save();

        return back()->with('update', 'Update berhasil');
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
        $penyakit->delete();
        return back()->with('delete', 'Berhasil dihapus');
    }
}
