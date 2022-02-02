@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center m-2">
            <div class="col-md-8 col-sm-12">
                <div class="card">
                    <div class="card-header">{{ __('Tambah Data Penyakit') }}</div>
                    <div class="card-body">
                        <form action="{{ route('diseases.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3 custom-file">
                                <input required class="custom-file-input" type="file" id="formFile" name="image"
                                    accept="image/*" aria-describedby="formFile">
                                <label class="custom-file-label" for="formFile">Pilih Gambar</label>
                                <span class="text-danger">@error('image')
                                        {{ $message }}
                                    @enderror</span>
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Penyakit</label>
                                <input required autocomplete="off" type="text" class="form-control" id="nama"
                                    placeholder="Masukan nama penyakit" name="nama"
                                    value="@if (session('edit')){{ $data->nama }}@endif{{ old('nama') }}">
                                <span class="text-danger">@error('nama')
                                        {{ $message }}
                                    @enderror</span>
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea required class="form-control" id="deskripsi" rows="3"
                                    name="deskripsi">@if (session('edit')){{ $data->deskripsi }}@endif{{ old('deskripsi') }}</textarea>
                                <span class="text-danger">@error('deskripsi')
                                        {{ $message }}
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
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    {{-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script> --}}
    <script type="text/javascript">
        $('#deskripsi').summernote({
            height: 400
        });
    </script>
@endpush
