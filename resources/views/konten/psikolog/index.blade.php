@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center m-2">
        <div class="col-md-9 mb-3">
            <div class="card mb-3">
                <div class="card-header">{{ __('Daftar Psikolog') }}
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
                        <table class="table table-hover table-bordered">
                            <thead class="table-info">
                                <tr class="text-center">
                                    <th style="width: 150px">Gambar</th>
                                    <th>Nama</th>
                                    <th style="width: 160px">Nomer Telepon</th>
                                    <th>Alamat</th>
                                    <th class="text-center" style="width: 80px">Edit</th>
                                    <th class="text-center" style="width: 80px">Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($psikolog as $item)
                                <tr>
                                    <td><img src="{{$item->path_img}}" alt=""  style="max-width: 150px"></td>  
                                    <td>{{$item->nama}}</td>  
                                    <td>{{$item->no_telpon}}</td>  
                                    <td>{{$item->alamat}}</td>  
                                    <td class="text-center">
                                        <form action="{{route('psikologs.edit', $item->id)}}" method="GET">
                                            @csrf
                                        <input type="submit" class="btn btn-sm btn-primary" value="Edit">
                                        </form>
                                    </td>  
                                    <td>
                                        <form action="{{route('psikologs.destroy', $item->id)}}" method="POST">
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
                <div class="card-header">{{ __('Tambah Psikolog') }}</div>
                <div class="card-body">
                    <form action=
                    "
                     @if (session('edit'))
                    {{route('psikologs.update', $data->id)}}
                    @else
                    {{route('psikologs.store')}}
                    @endif
                    "
                    method="POST" enctype="multipart/form-data" >
                        @csrf
                         @if (session('edit'))
                         @method('put')
                        @endif
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Input Gambar</label>
                            <input class="form-control" type="file" id="formFile" name="image">
                        <span class="text-danger">@error('image')
                            {{$message}}
                        @enderror</span>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Psikolog</label>
                        <input autocomplete="off" type="text" class="form-control" id="nama" placeholder="Masukan nama" name="nama" value="@if (session('edit')){{$data->nama}}@endif{{ old('nama') }}">
                        <span class="text-danger">@error('nama')
                            {{$message}}
                        @enderror</span>
                    </div>
                    <div class="mb-3">
                        <label for="no_telpon" class="form-label">Nomer Telepon</label>
                        <input autocomplete="off" type="text" class="form-control" id="no_telpon" placeholder="Masukan Nomer telepon" name="no_telpon" value="@if (session('edit')){{$data->no_telpon}}@endif{{ old('no_telpon') }}">
                        <span class="text-danger">@error('no_telpon')
                            {{$message}}
                        @enderror</span>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input autocomplete="off" type="text" class="form-control" id="alamat" placeholder="Masukan Alamat" name="alamat" value="@if (session('edit')){{$data->alamat}}@endif{{ old('alamat') }}">
                        <span class="text-danger">@error('alamat')
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
