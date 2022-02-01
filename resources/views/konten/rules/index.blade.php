@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center m-2 align-items-center">
            <div class="col-md-11 col-sm-12 mb-3">
                @if (session('save'))
                    <div class="alert alert-success mt-2">
                        {{ session('save') }}
                    </div>
                @endif
                @if (session('delete'))
                    <div class="alert alert-danger mt-2">
                        {{ session('delete') }}
                    </div>
                @endif
                @if (session('update'))
                    <div class="alert alert-success mt-2">
                        {{ session('update') }}
                    </div>
                @endif
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row align-items-center ">
                            <div class="col-md-8  col-sm-12">
                                <h5 class="m-0">Basis Pengetahuan</h5>
                            </div>
                            <div class="col-md-4 col-sm-12 text-md-right">
                                <a href="{{ route('rules.create') }}" class="btn btn-sm btn-primary mt-2 mt-md-0">Tambah
                                    Data Rules</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered border-secondary ">
                        <thead>
                            <tr class="text-center">
                                <th class="text-center" style="width: 50px">No</th>
                                <th class="text-nowrap" style="width: 30%">Nama Penyakit</th>
                                <th class="text-nowrap" style="width: 50%; min-width: 300px">Gejala</th>
                                <th class="text-nowrap" style="width: 30%">Nilai Kepastian</th>
                                <th class="text-center" style="width: 80px">Edit</th>
                                <th class="text-center" style="width: 80px">Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->index + 1 }}</td>
                                    <td>{{ $item->penyakit->nama }}</td>
                                    <td>{{ $item->gejala->nama_gejala }}</td>
                                    <td class="text-center">{{ $item->nilai_pakar }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('rules.edit', $item->id) }}" method="GET">
                                            @csrf
                                            <input type="submit" class="btn px-3 btn-sm btn-primary" value="Edit">
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{ route('rules.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <input type="submit" class="btn btn-sm btn-danger" value="Hapus">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
