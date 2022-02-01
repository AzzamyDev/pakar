@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center mx-3">
            <div class="col-md-4 col-sm-12 mb-3 mb-md-0">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-secondary mb-3 m-0 p-0"><span class="ml-3"><i
                                    class="fas fa-user"></i></span>
                            {{ $user->name }}</h5>
                        <h5 class="text-secondary mb-3 m-0 p-0"><span class="ml-3"><i
                                    class="fas fa-phone"></i></span>
                            {{ $user->no_telpon }}</h5>
                        <h5 class="text-secondary m-0 p-0"><span class="ml-3"><i
                                    class="fas fa-envelope"></i></span>
                            {{ $user->email }}</h5>

                    </div>
                </div>
            </div>
            <div class="col-md col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-secondary">Riwayat Diagnosa</h5>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered table-hover text-nowrap">
                                <thead class="text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Penyakit</th>
                                        <th style="width: 100px">Persentase</th>
                                        <th style="width: 180px">Tanggal</th>
                                        {{-- <th style="width: 80px">Detail</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user->riwayat as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $item->hasil_diagnosa }}</td>
                                            <td class="text-center">{{ $item->persentase_diagnosa }}</td>
                                            <td>{{ $item->tanggal }}</td>
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
