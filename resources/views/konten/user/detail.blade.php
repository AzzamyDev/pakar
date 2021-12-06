@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center mx-3">
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
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered table-hover">
                                <thead class="table-info text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Penyakit</th>
                                        <th style="width: 100px">Persentase</th>
                                        <th style="width: 180px">Tanggal</th>
                                        <th style="width: 80px">Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user->riwayat as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$item->penyakit->nama}}</td>
                                        <td>{{$item->persentase_diagnosa}}</td>
                                        <td>{{$item->tanggal}}</td>
                                        {{-- <td>
                                            <form action="{{route('riwayat.show')}}" method="GET">
                                                <input type="submit" value="Detail" class="btn btn-sm btn-block btn ">
                                            </form>
                                        </td> --}}
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection