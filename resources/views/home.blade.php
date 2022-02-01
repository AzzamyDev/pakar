@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="mt-5 bg-primary text-center p-4 rounded">
                    <h1 class="text-white mb-3">Welcome</h1>
                    <img src="{{ asset('/storage/logo.png') }}" width="290" height="300" alt="" srcset="">
                </div>
            </div>
        </div>
    </div>
@endsection
