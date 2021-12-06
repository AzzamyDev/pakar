@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header"><h5 class="text-secondary">Tambah Psikolog</h5>
                 @if (session('update'))
                    <div class="alert alert-success mt-2">
                        {{ session('update') }}
                    </div>
                @endif
                </div>
                <div class="card-body">
                    <form action="{{route('psikologs.store')}}" method="POST" enctype="multipart/form-data" >
                        @csrf
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Input Gambar</label>
                            <input class="form-control" type="file" id="formFile" name="image">
                        <span class="text-danger">@error('image')
                            {{$message}}
                        @enderror</span>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input autocomplete="off" type="text" class="form-control" id="name" placeholder="Masukan Nama Psikolog" name="name" value="{{ old('name') }}">
                        <span class="text-danger">@error('name')
                            {{$message}}
                        @enderror</span>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input autocomplete="off" type="email" class="form-control" id="email" placeholder="Masukan Email" name="email" value="{{ old('email') }}">
                        <span class="text-danger">@error('email')
                            {{$message}}
                        @enderror</span>
                    </div>
                    <div class="mb-3">
                        <label for="no_telpon" class="form-label">Nomer Telepon</label>
                        <input autocomplete="off" type="text" class="form-control" id="no_telpon" placeholder="Masukan Nomer Telepon" name="no_telpon" value="{{ old('no_telpon') }}">
                        <span class="text-danger">@error('no_telpon')
                            {{$message}}
                        @enderror</span>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea autocomplete="off" type="text" class="form-control" id="alamat" placeholder="Masukan Alamat" name="alamat">{{ old('alamat') }}</textarea>
                        <span class="text-danger">@error('alamat')
                            {{$message}}
                        @enderror</span>
                    </div>
                    <span class="text-secondary mb-3"><i class="fas fa-key"></i>  Password Default : 123456789</span>
                    <input type="submit" class="btn btn-primary btn-block mt-3" value="Simpan">
                </form>
                </div>
            </div>
        </div>   
    </div>
</div>
@endsection