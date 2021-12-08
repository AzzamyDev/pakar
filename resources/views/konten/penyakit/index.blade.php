@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center m-2">
        <div class="col-md-8 mb-3">
            <div class="card mb-3">
                <div class="card-header">{{ __('Daftar Penyakit') }}
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
                                    <th style="width: 100px">Gambar</th>
                                    <th style="width: 150px">Nama Penyakit</th>
                                    <th>Deskripsi</th>
                                    <th class="text-center" style="width: 100px">Set Gejala</th>
                                    <th class="text-center" style="width: 80px">Edit</th>
                                    <th class="text-center" style="width: 80px">Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($penyakit as $item)
                                <tr>
                                    <td>
                                        <img src="{{$item->path_img}}" alt=""  style="max-width: 100px">
                                    </td>  
                                    <td>{{$item->nama}}</td>  
                                    <td>
                                        @if (Str::length(strip_tags($item->deskripsi)) > 200)
                                            {{substr(strip_tags($item->deskripsi), 0, 200) . '...'}} <span><a href="{{route('diseases.show', $item->id)}}" class="link-info">Selengkapnya..</a></span>
                                        @else
                                            {{strip_tags($item->deskripsi)}}
                                        @endif
                                    </td>  
                                    <td class="text-center">
                                        <form action="{{route('view_set_gejala', $item->id)}}" method="GET">
                                            @csrf
                                        <input type="submit" class="btn btn-sm btn-success btn-block" value="Set">
                                        </form>
                                    </td>  
                                    <td class="text-center">
                                        <form action="{{route('diseases.edit', $item->id)}}" method="GET">
                                            @csrf
                                        <input type="submit" class="btn btn-sm btn-primary btn-block" value="Edit">
                                        </form>
                                    </td>  
                                    <td>
                                        <form action="{{route('diseases.destroy', $item->id)}}" method="POST">
                                            @csrf
                                            @method('delete')
                                        <input type="submit" class="btn btn-sm btn-danger btn-block" value="Hapus">
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
                <div class="card-header">{{ __('Tambah Daftar Penyakit') }}</div>
                <div class="card-body">
                    <form action=
                    "
                     @if (session('edit'))
                    {{route('diseases.update', $data->id)}}
                    @else
                    {{route('diseases.store')}}
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
                        <label for="nama" class="form-label">Nama Penyakit</label>
                        <input autocomplete="off" type="text" class="form-control" id="nama" placeholder="Masukan nama penyakit" name="nama" value="@if (session('edit')){{$data->nama}}@endif{{ old('nama') }}">
                        <span class="text-danger">@error('nama')
                            {{$message}}
                        @enderror</span>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" rows="3" name="deskripsi" >@if (session('edit')){{$data->deskripsi}}@endif{{ old('deskripsi') }}</textarea>
                        <span class="text-danger">@error('deskripsi')
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
@push('summernote')
    <!-- summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script type="text/javascript">
    $('#deskripsi').summernote({
        height: 400
    });
</script>
@endpush