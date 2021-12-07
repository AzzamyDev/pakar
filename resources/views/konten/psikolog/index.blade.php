@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center m-2">
        <div class="col mb-3">
            <div class="card mb-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-10">
                            <h5 class="text-dark">Daftar Psikolog</h5>
                        </div>
                        <div class="col">
                            <a href="{{route('psikologs.create')}}" class="btn btn-block btn-primary btn-sm"><span><i class="fas fa-user-plus"></i></span>  Tambah Psikolog</a>    
                        </div>
                    </div>
                @if (session('save'))
                    <div class="alert alert-success mt-2">
                        {{ session('save') }}
                    </div>
                @endif
                @if (session('delete'))
                    <div class="alert alert-danger mt-2">
                        {{ session('delete') }}
                    </div>
                @endif
                @if (session('update'))
                    <div class="alert alert-success mt-2">
                        {{ session('update') }}
                    </div>
                @endif
                @if (session('edit'))
                   <input type="hidden" name="" value="{{$data = session('edit')}}"> 
                @endif
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-info">
                        <tr>
                            <th style="width: 100px">ID</th>
                            <th>Nama Psikolog</th>
                            <th>Email</th>
                            <th>Nomer Telepon</th>
                            <th>Alamat</th>
                            @role('admin')
                            <th class="text-center" style="width: 80px">Edit</th>
                            <th class="text-center" style="width: 80px">Hapus</th>
                            @endrole
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($psikolog as $item)
                        <tr>
                            <td>{{$item->id}}</td>  
                            <td>{{$item->name}}</td>  
                            <td>{{$item->email}}</td>  
                            <td>{{$item->no_telpon}}</td>  
                            <td>{{$item->alamat}}</td>  
                            @role('admin')
                            <td class="text-center">
                                <form action="{{route('psikologs.edit', $item->id)}}" method="GET">
                                    @csrf
                                <input type="submit" class="btn btn-sm btn-block btn-primary" value="Edit">
                                </form>
                            </td>  
                            <td>
                                <form action="{{route('psikologs.destroy', $item->id)}}" method="POST">
                                    @csrf
                                    @method('delete')
                                <input type="submit" class="btn btn-sm btn-block btn-danger" value="Hapus">
                                </form>
                            </td>
                            @endrole
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
