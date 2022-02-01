<?php

namespace App\Http\Controllers;

use App\Models\Riwayat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::role('user')->get(); // get user dengan role "user"
        return view('konten.user.index')->with(compact('users'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('konten.user.detail')->with(compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('konten.user.edit')->with(compact('user'));
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
            'name' => 'required',
            'no_telpon' => 'required',
            'email' => 'required',
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->no_telpon = $request->no_telpon;
        $user->save();

        return back()->with('update', 'Update berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->image_name != null) {
            Storage::disk('public')->delete('/psikolog/' . $user->image_name);
        }
        $user->delete();
        return redirect()->route('users.index')->with('delete', 'Berhasil dihapus');
    }

    public function cari(Request $request)
    {
        if ($request->ajax()) {

            $output = '';
            $cari = $request->search;
            $users = User::where('email', $cari)->orWhere('name', 'LIKE', '%' . $cari . '%')->orWhere('no_telpon', 'LIKE', '%' . $cari . '%')->role('user')->get();
            if ($users) {
                foreach ($users as $user) {
                    $output .= '<tr>' .
                        '<td>' . $user->id . '</td>' .
                        '<td>' . $user->name . '</td>' .
                        '<td>' . $user->email . '</td>' .
                        '<td>' . $user->no_telpon . '</td>' .
                        '<td class="text-center">' .
                        '<form action="' . route('users.show', $user) . '" method="GET">' .
                        '<input type="hidden" name="_token" value="' . csrf_token() . '">' .
                        '<input type="submit" class="btn btn-sm btn-block btn-success" value="Detail">' .
                        '</form>' .
                        '</td> ' .
                        $this->btEdit($user) .
                        $this->btHapus($user) .
                        '</tr>';
                }
                return Response($output);
            }
        }
    }

    public function btEdit(User $user)
    {
        $result = '<td class="text-center">' .
            '<form action="' . route('users.edit', $user) . '" method="GET">' .
            '<input type="hidden" name="_token" value="' . csrf_token() . '">' .
            '<input type="submit" class="btn btn-sm btn-block btn-primary" value="Edit">' .
            '</form>' .
            '</td>';
        return $result;
    }

    public function btHapus(User $user)
    {
        $result = '<td>' .
            '<form action="' . route('users.destroy', $user) . '" method="POST">' .
            '<input type="hidden" name="_token" value="' . csrf_token() . '">' .
            '<input type="hidden" name="_method" value="delete">' .
            '<input type="submit" class="btn btn-sm btn-block btn-danger" value="Hapus">' .
            '</form>' .
            '</td>';
        return $result;
    }

    public function record()
    {
        return view('konten.user.record');
    }

    public function getRecord(Request $request)
    {
        if ($request->ajax()) {

            $output = '';
            $record = [];
            $cari = $request->search;
            if (strlen($cari) >= 1) {
                $users = User::where('email', $cari)->orWhere('name', 'LIKE', '%' . $cari . '%')->orWhere('no_telpon', 'LIKE', '%' . $cari . '%')->role('user')->first();
                if ($users != null) {
                    $record = $users->riwayat;
                    if ($record) {
                        foreach ($record as $item) {
                            $output .= '<tr>' .
                                '<td class="text-center">' . $item->id . '</td>' .
                                '<td>' . $users->name . '</td>' .
                                '<td>' . $item->hasil_diagnosa . '</td>' .
                                '<td class="text-center">' . $item->persentase_diagnosa . '</td>' .
                                '<td>' . $item->tanggal . '</td>' . '
                           </form>' .
                                '</td> ' .
                                '</tr>';
                        }
                    }
                } else {
                    $output = 'kosong';
                }
            } else {
                $users = User::where('email', $cari)->orWhere('name', 'LIKE', '%' . $cari . '%')->orWhere('no_telpon', 'LIKE', '%' . $cari . '%')->role('user')->first();
                if ($users != null) {
                    $record = $users->riwayat;
                    if ($record) {
                        foreach ($record as $item) {
                            $output .= '<tr>' .
                                '<td class="text-center">' . $item->id . '</td>' .
                                '<td>' . $users->name . '</td>' .
                                '<td>' . $item->hasil_diagnosa . '</td>' .
                                '<td class="text-center">' . $item->persentase_diagnosa . '</td>' .
                                '<td>' . $item->tanggal . '</td>' . '
                           </form>' .
                                '</td> ' .
                                '</tr>';
                        }
                    }
                } else {
                    $output = 'kosong';
                }
            }
            return Response($output);
        }
    }
}
