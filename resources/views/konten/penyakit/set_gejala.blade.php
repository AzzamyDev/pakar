@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="row">
            <div class="col-md">
                <div class="card">
                    <div class="card-body text-center">
                        <img src="{{$penyakit->path_img}}" alt="" style="max-width: 400px" srcset="">
                        <div class="text-start mt-3">
                            <h4>{{$penyakit->nama}}</h4>
                            <p>{{$penyakit->sub_deskripsi}}... <span><a href="{{route('diseases.show', $penyakit->id)}}" class="link-info">Selengkapnya..</a></span></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="card">
                    <div class="card-body">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection