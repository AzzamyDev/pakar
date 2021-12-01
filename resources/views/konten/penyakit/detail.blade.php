@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="text-center">
         <img src="{{$data->path_img}}" class="rounded" alt="{{$data->image_name}}" style="max-width: 400px">
         
         <div class="my-4">
             <h2>{{$data->nama}}</h2>
         </div>
         <div class="container">
                <div>
                {{ html_entity_decode($data->deskripsi)}}
            </div>
         </div>
        </div>
    </div>
</div>
@endsection