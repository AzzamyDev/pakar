@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="row">
            <div class="col-md-12 mb-3">
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
                        <div class="mb-4">
                            <h4 class="text-secondary">Pilih Gejala</h4>
                        </div>
                        <form action="{{route('set_gejala', $penyakit->id)}}" method="POST">
                            @csrf
                        <div class="row">
                            @foreach ($gejala as $item)
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                            <input value="{{$item->kode}}" name="gejala[]" {{in_array($item->kode, $data) ? 'checked': ''}} type="checkbox" aria-label="Checkbox for following text input">
                                            <span class="ms-2">{{$item->kode}}</span>
                                            </div>
                                        </div>
                                        <input disabled type="text" class="form-control" value="{{$item->nama_gejala}}">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="text-center">
                                <input style="width: 300px" class="btn btn-block btn-primary mt-4" type="submit" value="Simpan">
                        </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection