@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Edit Pengguna') }}
                 @if (session('update'))
                    <div class="alert alert-success mt-2">
                        {{ session('update') }}
                    </div>
                @endif
                </div>
                <div class="card-body">
                    <form action="{{route('users.update', $user->id)}}" method="POST" >
                        @csrf
                        @method('put')
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input autocomplete="off" type="text" class="form-control" id="name" placeholder="Masukan name" name="name" value="{{$user->name}}">
                        <span class="text-danger">@error('name')
                            {{$message}}
                        @enderror</span>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input autocomplete="off" type="email" class="form-control" id="email" placeholder="Masukan email" name="email" value="{{$user->email}}">
                        <span class="text-danger">@error('email')
                            {{$message}}
                        @enderror</span>
                    </div>
                    <div class="mb-3">
                        <label for="no_telpon" class="form-label">Nomer Telepon</label>
                        <input autocomplete="off" type="text" class="form-control" id="no_telpon" placeholder="Masukan Nomer Telepon" name="no_telpon" value="{{$user->no_telpon}}">
                        <span class="text-danger">@error('no_telpon')
                            {{$message}}
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