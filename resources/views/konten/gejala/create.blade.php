@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center m-2">
            <div class="col-md-5 col-sm-12">
                <div class="card">
                    <div class="card-header">{{ __('Tambah Gejala') }}</div>
                    <div class="card-body">
                        <form action="{{ route('indications.store') }}" method="POST">
                            {{-- simpbol @CSRF berfungsi untuk memberi tahu laravel kalo ini request dari aplikasi yang valid --}}
                            @csrf
                            <div class="mb-3">
                                <label for="kode" class="form-label">Kode Gejala</label>
                                <input autocomplete="off" type="text" class="form-control" id="kode"
                                    placeholder="Masukan Kode" name="kode" value="{{ old('kode') }}">
                                <span class="text-danger">@error('kode')
                                        {{ $message }}
                                    @enderror</span>
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Gejala</label>
                                <textarea class="form-control" id="nama" rows="3"
                                    name="nama_gejala">{{ old('nama_gejala') }}</textarea>
                                <span class="text-danger">@error('nama_gejala')
                                        {{ $message }}
                                    @enderror</span>
                            </div>
                            <input type="submit" class="btn btn-primary btn-block" value="Simpan">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
