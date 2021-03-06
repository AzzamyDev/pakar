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
                    <div class="card-body px-4">
                        <div class="row align-items-center ">
                            <div class="col-md-8  col-sm-12">
                                <h5 class="m-0">Daftar Penyakit</h5>
                            </div>
                            <div class="col-md-4 col-sm-12 text-md-right">
                                <a href="{{ route('diseases.create') }}"
                                    class="btn btn-sm btn-primary mt-2 mt-md-0">Tambah
                                    Data Penyakit</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered border-secondary ">
                        <thead>
                            <tr class="text-center">
                                <th class="text-center" style="width: 50px">No</th>
                                <th class="text-center" style="width: 70px">Kode</th>
                                <th class="text-nowrap" style="width: 30%">Nama Penyakit</th>
                                <th>Deskripsi</th>
                                <th class="text-center" style="width: 80px">Edit</th>
                                <th class="text-center" style="width: 80px">Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penyakit as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->index + 1 }}</td>
                                    <td class="text-center">{{ $item->kode }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>
                                        {{ $item->sub_deskripsi }}...
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ route('diseases.edit', $item->id) }}" method="GET">
                                            @csrf
                                            <input type="submit" class="btn px-3 btn-sm btn-primary" value="Edit">
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{ route('diseases.destroy', $item->id) }}" method="POST">
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
