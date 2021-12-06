@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-secondary"><span class="me-2"><i class="fas fa-user"></i></span>  {{$user->name}}</h5>
                        <h5 class="text-secondary"><span class="me-2"><i class="fas fa-phone"></i></span>  {{$user->no_telpon}}</h5>
                        <h5 class="text-secondary"><span class="me-2"><i class="fas fa-envelope"></i></span>  {{$user->email}}</h5>
                        
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-secondary">Riwayat Diagnosa</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection