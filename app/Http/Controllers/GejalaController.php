<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use Illuminate\Http\Request;

class GejalaController extends Controller
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
        $gejala = Gejala::orderBy('kode', 'asc')->get();
        return view('konten.gejala.index')->with(compact('gejala'));
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
        $validator = $request->validate([
            'kode' => ['required', 'unique:gejala'],
            'nilai' => ['required', 'numeric', 'max:1', 'min:0'],
            'nama' => 'required',
        ]);

        Gejala::create([
            'kode' => $request->kode,
            'nilai_pakar' => $request->nilai,
            'nama_gejala' => $request->nama,
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
        $data = Gejala::find($id);
        return back()->with('edit', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
        $request->validate([
            'kode' => 'required',
            'nilai' => ['required', 'numeric', 'max:1', 'min:0'],
            'nama' => 'required',
        ]);
        $gejala = Gejala::find($id);
        $gejala->kode = $request->kode;
        $gejala->nilai_pakar = $request->nilai;
        $gejala->nama_gejala = $request->nama;
        $gejala->save();

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
        $gejala = Gejala::find($id);
        $gejala->delete();
        return back()->with('delete', 'Berhasil dihapus');
    }
}
