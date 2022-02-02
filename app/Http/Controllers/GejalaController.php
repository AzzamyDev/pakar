<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use Illuminate\Http\Request;

class GejalaController extends Controller
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
        $gejala = Gejala::orderBy('id', 'ASC')->get();
        return view('konten.gejala.index')->with(compact('gejala'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('konten.gejala.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required',
            'nama_gejala' => 'required',
        ], [
            'kode.required' => 'Kode gejala harus di isi',
            'nama_gejala.required' => 'Nama gejala harus di isi',
        ]);

        Gejala::create($validated);

        return redirect()->route('indications.index')->with('save', 'Berhasil di simpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Gejala::find($id);
        return view('konten.gejala.edit')->with(compact('data'));
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
        $validated = $request->validate([
            'kode' => 'required',
            'nama_gejala' => 'required',
        ], [
            'kode.required' => 'Kode gejala harus di isi',
            'nama_gejala.required' => 'Nama gejala harus di isi',
        ]);
        $gejala = Gejala::find($id);
        $gejala->update($validated);

        return redirect()->route('indications.index')->with('update', 'Update berhasil');
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
