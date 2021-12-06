<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Psikolog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
        $psikolog = User::role('psikolog')->get();
        return view('konten.psikolog.index')->with(compact('psikolog'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('konten.psikolog.create');
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
            'name' => 'required',
            'no_telpon' => 'required',
            'email' => 'required|unique:users|email',
            'alamat' => 'required',
            'image' => 'required',
        ]);

        $image = $request->file('image');
        $imageName = now()->timestamp . "_" . $image->getClientOriginalName();
        $pathImage = 'users';
        $request->file('image')->storeAs($pathImage, $imageName);

        $img_url = url('storage/users/' . $imageName);

        $psikolog = User::create([
            'name' => $request->name,
            'no_telpon' => $request->no_telpon,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'password' => Hash::make('123456789'),
            'image_name' => $imageName,
            'path_img' => $img_url,
        ]);
        $psikolog->assignRole('psikolog');

        return redirect()->route('psikologs.index')->with('save', 'Berhasil di simpan');
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
        $data = User::find($id);
        return view('konten.psikolog.edit')->with(compact('data'));
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
        $psikolog = User::find($id);

        $request->validate([
            'name' => 'required',
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

        $psikolog->name = $request->name;
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
        $psikolog = User::find($id);
        Storage::disk('public')->delete('/psikolog/' . $psikolog->image_name);
        $psikolog->delete();
        return back()->with('delete', 'Berhasil dihapus');
    }
}
