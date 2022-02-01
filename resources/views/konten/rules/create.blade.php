@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center m-2">
            <div class="col-md-5 col-sm-12">
                <div class="card">
                    <div class="card-header">{{ __('Tambah Basis Data') }}</div>
                    <div class="card-body">
                        <form action="{{ route('rules.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="penyakit_id" class="form-label">Nama Penyakit</label>
                                <select id="penyakit_id" name="penyakit_id" class="custom-select">
                                    <option selected value="">Pilih Data Penyakit</option>
                                    @foreach ($penyakit as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">@error('penyakit_id')
                                        {{ $message }}
                                    @enderror</span>
                            </div>
                            <div class="mb-3">
                                <label for="gejala_id" class="form-label">Gejala</label>
                                <select id="gejala_id" name="gejala_id" class="custom-select">
                                    <option selected value="">Pilih Data Gejala</option>
                                    @foreach ($gejala as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_gejala }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">@error('gejala_id')
                                        {{ $message }}
                                    @enderror</span>
                            </div>
                            <div class="mb-3">
                                <label for="nilai_pakar" class="form-label">Nilai Kepastian</label>
                                <input id="nilai_pakar" name="nilai_pakar" type="number" max="1" min="0" step="0.1"
                                    class="form-control">
                                <span class="text-danger">@error('nilai_pakar')
                                        {{ $message }}
                                    @enderror</span>
                            </div>
                            <input type="submit" class="btn btn-primary btn-block" value="Simpan">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
