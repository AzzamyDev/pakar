@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center m-2">
        <div class="col-md-10 mb-3">
            <div class="card mb-3">
                <div class="card-header">{{ __('Daftar Pengguna') }}
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
                                    <th>Nama Pengguna</th>
                                    <th>Email</th>
                                    <th>Nomer Telepon</th>
                                    <th class="text-center" style="width: 80px">Edit</th>
                                    <th class="text-center" style="width: 80px">Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $item)
                                <tr>
                                    <td>{{$item->id}}</td>  
                                    <td>{{$item->name}}</td>  
                                    <td>{{$item->email}}</td>  
                                    <td>{{$item->no_telpon}}</td>  
                                    <td class="text-center">
                                        <form action="{{route('users.edit', $item)}}" method="GET">
                                            @csrf
                                        <input type="submit" class="btn btn-sm btn-primary" value="Edit">
                                        </form>
                                    </td>  
                                    <td>
                                        <form action="{{route('users.destroy', $item->id)}}" method="POST">
                                            @csrf
                                            @method('delete')
                                        <input type="submit" class="btn btn-sm btn-danger" value="Hapus">
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
        </div>
    </div>
</div>
@endsection
