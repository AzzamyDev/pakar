@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center m-2">
            <div class="col-md-8 mb-3">
                {{-- jika ada session save maka mnculkan alert --}}
                @if (session('save'))
                    <div class="alert alert-success mt-2">
                        {{ session('save') }}
                    </div>
                @endif
                {{-- jika ada session delete maka mnculkan alert --}}
                @if (session('delete'))
                    <div class="alert alert-danger mt-2">
                        {{ session('delete') }}
                    </div>
                @endif
                {{-- jika ada session update maka mnculkan alert --}}
                @if (session('update'))
                    <div class="alert alert-success mt-2">
                        {{ session('update') }}
                    </div>
                @endif
                <div class="card mb-3">
                    <div class="card-body row px-4 align-items-center">
                        <div class="col-md col-sm-12 mb-md-0">
                            <h5 class="m-0">Daftar Gejala</h5>
                        </div>
                        <div class="col-md-4 text-right col-sm-12 ">
                            <a href="{{ route('indications.create') }}" class="btn btn-sm btn-primary mt-2 mt-md-0">Tambah
                                Data Gejala</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table  table-hover table-bordered">
                        <thead class="text-center">
                            <tr>
                                <th style="width: 100px">Kode</th>
                                <th>Nama Gejala</th>
                                <th style="width: 100px">Edit</th>
                                <th style="width: 100px">Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- looping data yang di lempar dari controller --}}
                            @foreach ($gejala as $item)
                                <tr>
                                    <td class="text-center">{{ $item->kode }}</td>
                                    <td>{{ $item->nama_gejala }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('indications.edit', $item->id) }}" method="GET">
                                            @csrf
                                            <input type="submit" class="btn btn-sm btn-primary" value="Edit">
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{ route('indications.destroy', $item->id) }}" method="POST">
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
