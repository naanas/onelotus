@extends('layouts.master', ['title' => 'Edit Pemeriksaan'])

@section('content')

<div>
    <h4 class="mb-3 mb-md-2">Edit Pemeriksaan</h4>
</div>
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/detail-pasien/{{ $data->data_pasien->id }}">Data Pasien</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Pemeriksaan</li>
    </ol>
</nav>



<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-5">Edit Pemeriksaan Untuk Pasien {{ $data->data_pasien->nama }}</h5>
                    <form method="POST" action="/detail-pasien/edit-pemeriksaan/update" class="mt-3 forms-sample ml-3">
                        @csrf
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <div class="form-group">
                            <label for="keluhan">Keluhan</label>
                            <input type="text" class="form-control @error('keluhan') is-invalid @enderror" id="keluhan" name="keluhan" value="{{ $data->keluhan }}" autocomplete="keluhan" autofocus placeholder="Keluhan">

                            @error('keluhan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="penyebab">Penyebab Cedera</label>
                            <input type="text" class="form-control @error('penyebab') is-invalid @enderror" id="penyebab" name="penyebab" value="{{ $data->penyebab }}" autocomplete="penyebab" autofocus placeholder="Penyebab Cedera">

                            @error('penyebab')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="lama">Lama Cedera</label>
                            <input type="text" class="form-control @error('lama') is-invalid @enderror" id="lama" name="lama" value="{{ $data->lama }}" autocomplete="lama" autofocus placeholder="Lama Cedera">

                            @error('lama')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="analisa">Analisa dan Diagnosa</label>
                            <input type="text" class="form-control @error('analisa') is-invalid @enderror" id="analisa" name="analisa" value="{{ $data->analisa }}" autocomplete="analisa" autofocus placeholder="Analisa dan Diagnosa">

                            @error('analisa')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="treatment">Treatment</label>
                            <input type="text" class="form-control @error('treatment') is-invalid @enderror" id="treatment" name="treatment" value="{{ $data->treatment }}" autocomplete="treatment" autofocus placeholder="Treatment">

                            @error('treatment')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="bagian_penenang">Bagian yang Diberikan Penanganan</label>
                            <input type="text" class="form-control @error('bagian_penenang') is-invalid @enderror" id="bagian_penenang" name="bagian_penenang" value="{{ $data->bagian_penenang }}" autocomplete="bagian_penenang" autofocus placeholder="Bagian yang Diberikan Penanganan">

                            @error('bagian_penenang')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kesimpulan">Kesimpulan dan Rekomendasi</label>
                            <input type="text" class="form-control @error('kesimpulan') is-invalid @enderror" id="kesimpulan" name="kesimpulan" value="{{ $data->kesimpulan }}" autocomplete="kesimpulan" autofocus placeholder="Kesimpulan dan Rekomendasi">

                            @error('kesimpulan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="terapis">Terapis</label>
                            <input type="text" class="form-control @error('terapis') is-invalid @enderror" id="terapis" name="terapis" value="{{ $data->terapis }}" autocomplete="terapis" autofocus placeholder="Terapis">

                            @error('terapis')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>


                        <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                        <a href="/detail-pasien/{{$data->data_pasien->id}}" class="btn btn-light">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection