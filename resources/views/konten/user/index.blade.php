@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center m-2">
        <div class="col-md-10 mb-3">
            <div class="card mb-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md">
                            <h5 class="text-secondary">Daftar Pengguna</h5>
                        </div>
                        <div class="col-md-5">
                            <div class="container">
                                <form class="d-flex" action="{{route('cari_user')}}" method="POST">
                                    @csrf
                                    <input id="search" name="search" class="form-control me-2" type="search" placeholder="Masukan Email / Nama pengguna / No Telpon" aria-label="Search">
                                </form>
                            </div>
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
                                    <th>Nama Pengguna</th>
                                    <th>Email</th>
                                    <th>Nomer Telepon</th>
                                    <th class="text-center" style="width: 80px">Detail</th>
                                    @role('admin')
                                    <th class="text-center" style="width: 80px">Edit</th>
                                    <th class="text-center" style="width: 80px">Hapus</th>
                                    @endrole
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
                                        <form action="{{route('users.show', $item)}}" method="GET">
                                            @csrf
                                        <input type="submit" class="btn btn-sm btn-block btn-success" value="Detail">
                                        </form>
                                    </td>  
                                    @role('admin')
                                    <td class="text-center">
                                        <form action="{{route('users.edit', $item)}}" method="GET">
                                            @csrf
                                        <input type="submit" class="btn btn-sm btn-block btn-primary" value="Edit">
                                        </form>
                                    </td>  
                                    <td>
                                        <form action="{{route('users.destroy', $item)}}" method="POST">
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
@push('cari')

<script type="text/javascript">
$('#search').on('keyup',function(){
$value=$(this).val();
$.ajax({
type : 'get',
url : '{{route('cari_user')}}',
data:{'search':$value},
success:function(data){
$('tbody').html(data);
}
});
})
</script>
<script type="text/javascript">
$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>
    
@endpush
@endsection
