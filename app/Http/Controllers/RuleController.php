<?php

namespace App\Http\Controllers;

use App\Models\Rules;
use App\Models\Gejala;
use App\Models\Penyakit;
use Illuminate\Http\Request;

class RuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Rules::orderBy('id', 'asc')->get();
        return view('konten.rules.index')->with(compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $penyakit = Penyakit::all();
        $gejala = Gejala::all();
        return view('konten.rules.create')->with(compact(['penyakit', 'gejala']));
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
            'penyakit_id' => 'required',
            'gejala_id' => 'required',
            'nilai_pakar' => 'required',
        ], [
            'penyakit_id.required' => 'Pilih data penyakit',
            'gejala_id.required' => 'Pilih Gejala',
            'nilai_pakar.required' => 'Nilai Kepastian harus di isi',
        ]);

        Rules::create($validated);

        return redirect()->route('rules.index')->with(['save' => 'Berhasil menambahkan data']);
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
        $penyakit = Penyakit::all();
        $gejala = Gejala::all();
        $data = Rules::find($id);
        return view('konten.rules.edit')->with(compact(['penyakit', 'gejala', 'data']));
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
            'penyakit_id' => 'required',
            'gejala_id' => 'required',
            'nilai_pakar' => ['required', 'numeric', 'max:1', 'min:0'],
        ], [
            'penyakit_id.required' => 'Pilih data penyakit',
            'gejala_id.required' => 'Pilih Gejala',
            'nilai_pakar.required' => 'Nilai Kepastian harus di isi',
            'nilai_pakar.min' => 'Nilai kepastian tidak kurang dari 0',
            'nilai_pakar.max' => 'Nilai kepastian tidak lebih dari 1',
        ]);

        $rule = Rules::find($id);
        $rule->update($validated);

        return redirect()->route('rules.index')->with(['update' => 'Berhasil merubah data']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Rules::find($id)->delete();
        return redirect()->route('rules.index')->with(['delete' => 'Berhasil menghapus data']);
    }
}
