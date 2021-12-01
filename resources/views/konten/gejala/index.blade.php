@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center m-2">
        <div class="col-md-8 mb-3">
            <div class="card mb-3">
                <div class="card-header">{{ __('Daftar Gejala') }}
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
                @if (session('edit'))
                   <input type="hidden" name="" value="{{$data = session('edit')}}"> 
                @endif
                </div>
            </div>
            <div class="table-responsive">
                        <table class="table  table-hover table-bordered">
                            <thead class="table-info">
                                <tr>
                                    <th style="width: 100px">Kode</th>
                                    <th>Nama Gejala</th>
                                    <th style="width: 100px">Nilai Pakar</th>
                                    <th class="text-center" style="width: 100px">Edit</th>
                                    <th class="text-center" style="width: 100px">Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gejala as $item)
                                <tr>
                                    <td>{{$item->kode}}</td>  
                                    <td>{{$item->nama_gejala}}</td>  
                                    <td>{{$item->nilai_pakar}}</td>  
                                    <td class="text-center">
                                        <form action="{{route('indications.show', $item->id)}}" method="GET">
                                            @csrf
                                        <input type="submit" class="btn btn-sm btn-primary" value="Edit">
                                        </form>
                                    </td>  
                                    <td>
                                        <form action="{{route('indications.destroy', $item->id)}}" method="POST">
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
        <div class="col-md">
            <div class="card">
                <div class="card-header">{{ __('Tambah Gejala') }}</div>
                <div class="card-body">
                    <form action=
                    "
                     @if (session('edit'))
                    {{route('indications.update', $data->id)}}
                    @else
                    {{route('indications.store')}}
                    @endif
                    "
                    method="POST" >
                        @csrf
                         @if (session('edit'))
                         @method('put')
                        @endif
                    <div class="mb-3">
                        <label for="kode" class="form-label">Kode Gejala</label>
                        <input autocomplete="off" type="text" class="form-control" id="kode" placeholder="Masukan Kode" name="kode" value="@if (session('edit')){{$data->kode}}@endif{{ old('kode') }}">
                        <span class="text-danger">@error('kode')
                            {{$message}}
                        @enderror</span>
                    </div>
                    <div class="mb-3">
                        <label for="nilai" class="form-label">Nilai Gejala</label>
                        <input autocomplete="off" type="number" step="any" class="form-control" id="nilai" placeholder="Masukan nilai pakar" name="nilai" value="@if (session('edit')){{$data->nilai_pakar}}@endif{{ old('nilai') }}">
                        <span class="text-danger">@error('nilai')
                            {{$message}}
                        @enderror</span>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Gejala</label>
                        <textarea class="form-control" id="nama" rows="3" name="nama" >@if (session('edit')){{$data->nama_gejala}}@endif{{ old('nama') }}</textarea>
                        <span class="text-danger">@error('nama')
                            {{$message}}
                        @enderror</span>
                    </div>
                    <input type="submit" class="btn btn-primary btn-block" value="@if (session('edit')) Perbaharui @else Simpan @endif">
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
