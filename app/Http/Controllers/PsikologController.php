<?php

namespace App\Http\Controllers;

use App\Models\Psikolog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PsikologController extends Controller
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
        $psikolog = Psikolog::all();
        return view('konten.psikolog.index')->with(compact('psikolog'));
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
            'no_telpon' => 'required',
            'alamat' => 'required',
            'image' => 'required',
        ]);

        $image = $request->file('image');
        $imageName = now()->timestamp . "_" . $image->getClientOriginalName();
        $pathImage = 'public/psikolog';
        $request->file('image')->storeAs($pathImage, $imageName);

        $img_url = url('storage/psikolog/' . $imageName);

        Psikolog::create([
            'nama' => $request->nama,
            'no_telpon' => $request->no_telpon,
            'alamat' => $request->alamat,
            'image_name' => $imageName,
            'path_img' => $img_url,
        ]);

        return back()->with('save', 'Berhasil di simpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Psikolog::find($id);
        return back()->with('edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $psikolog = Psikolog::find($id);

        $request->validate([
            'nama' => 'required',
            'no_telpon' => 'required',
            'alamat' => 'required',
        ]);

        $image = $request->file('image');
        if ($image != null) {
            $imageName = now()->timestamp . "_" . $image->getClientOriginalName();
            $pathImage = 'psikolog';
            $request->file('image')->storeAs($pathImage, $imageName);

            $img_url = url('storage/psikolog/' . $imageName);

            Storage::disk('public')->delete('/psikolog/' . $psikolog->image_name);
        } else {
            $imageName = $psikolog->image_name;
            $img_url = $psikolog->path_img;
        }

        $psikolog->nama = $request->nama;
        $psikolog->no_telpon = $request->no_telpon;
        $psikolog->alamat = $request->alamat;
        $psikolog->image_name = $imageName;
        $psikolog->path_img = $img_url;
        $psikolog->save();

        return back()->with('update', 'Update berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $psikolog = Psikolog::find($id);
        $psikolog->delete();
        return back()->with('delete', 'Berhasil dihapus');
    }
}
