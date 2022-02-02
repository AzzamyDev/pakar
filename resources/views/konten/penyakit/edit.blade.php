@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center m-2">
            <div class="col-md-8 col-sm-12">
                <div class="card">
                    <div class="card-header">{{ __('Edit Data Penyakit') }}</div>
                    <div class="card-body">
                        <form action="{{ route('diseases.update', $data->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="mb-3 text-center">
                                <img class="img-fluid rounded" style="max-height: 200px" src="{{ $data->path_img }}"
                                    alt="{{ $data->name }}" srcset="">
                            </div>
                            <div class="mb-3 custom-file">
                                <input class="custom-file-input" type="file" id="formFile" name="image" accept="image/*"
                                    aria-describedby="inputGroupFileAddon01">
                                <label class="custom-file-label" for="formFile">Input Gambar</label>
                                <span class="text-danger">@error('image')
                                        {{ $message }}
                                    @enderror</span>
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Penyakit</label>
                                <input autocomplete="off" type="text" class="form-control" id="nama"
                                    placeholder="Masukan nama penyakit" name="nama" value="{{ $data->nama }}">
                                <span class="text-danger">@error('nama')
                                        {{ $message }}
                                    @enderror</span>
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" rows="3"
                                    name="deskripsi">{{ $data->deskripsi }}</textarea>
                                <span class="text-danger">@error('deskripsi')
                                        {{ $message }}
                                    @enderror</span>
                            </div>
                            <input type="submit" class="btn btn-primary btn-block" value="Perbaharui">
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
    <script type="text/javascript">
        $('#deskripsi').summernote({
            height: 400
        });
    </script>
@endpush
