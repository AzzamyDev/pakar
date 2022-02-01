@extends('layouts.app')

@section('content')
    <div class=" " style="height: 100vh">
        <div class="row justify-content-center mx-3">
            <div class="col-md-10 col-sm-12">
                <div class="card vh-100">
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md col-sm-12 mb-3 mb-md-0">
                                <h5 class="text-secondary">Track Record Diagnose</h5>
                            </div>
                            <div class="col-md-5 col-sm-12">
                                <form class="d-flex" action="{{ route('cari_user') }}" method="POST">
                                    @csrf
                                    <input autocomplete="off" id="search" name="search" class="form-control me-2"
                                        type="search" placeholder="Masukan Email / Nama pengguna / No Telpon"
                                        aria-label="Search">
                                </form>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered table-hover text-nowrap">
                                <thead class="text-center">
                                    <tr>
                                        <th style="width: 50px">No</th>
                                        <th style="width: 300px">Nama Pasien</th>
                                        <th>Hasil Diagnosa</th>
                                        <th style="width: 100px">Persentase</th>
                                        <th style="width: 180px">Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody id="table-body">
                                </tbody>
                            </table>
                            <h6 id="pesan" class="text-center"></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('cari')

        <script type="text/javascript">
            $('#search').on('keyup', function() {
                $value = $(this).val();
                $.ajax({
                    type: 'get',
                    url: '{{ route('get_record') }}',
                    data: {
                        'search': $value
                    },
                    success: function(data) {
                        console.log(data);
                        if (data != 'kosong') {
                            $('tbody').html(data);
                            $('#pesan').text('')
                        } else {
                            console.log(data);
                            $('tbody').html('');
                            $('#pesan').text('Tidak ada data')
                        }
                    }
                });
            })
        </script>
        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'csrftoken': '{{ csrf_token() }}'
                }
            });
        </script>

    @endpush
@endsection
