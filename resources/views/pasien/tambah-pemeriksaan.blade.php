@extends('layouts.master', ['title' => 'Tambah Pemeriksaan'])

@section('content')

<div>
    <h4 class="mb-3 mb-md-2">Tambah Pemeriksaan</h4>
</div>
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/detail-pasien/{{ $id }}">Data Pasien</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Pemeriksaan</li>
    </ol>
</nav>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-5">Pemeriksaan Untuk Pasien {{ $pasien->nama }}</h5>
                    <form method="POST" action="/detail-pasien/tambah-pemeriksaan/save" class="mt-3 forms-sample ml-3">
                        @csrf
                        <input type="hidden" value="{{$id}}" name="data_pasien_id">
                        <input type="hidden" value="<?php echo (session()->get('rontgen')) ? session()->get('rontgen') : '-'; ?>" name="rontgen">

                        <div class="form-group">
                            <label for="tgl_periksa">Tanggal Pemeriksaan <span style="color:gray">(kosongkan jika tanggal periksa hari ini)</span></label>
                            <input type="date" class="form-control @error('tgl_periksa') is-invalid @enderror" id="tgl_periksa" name="tgl_periksa" value="{{ old('tgl_periksa') }}" autocomplete="tgl_periksa" autofocus placeholder="tgl_periksa">

                            @error('tgl_periksa')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="keluhan">Keluhan</label>
                            <input type="text" class="form-control @error('keluhan') is-invalid @enderror" id="keluhan" name="keluhan" value="<?php echo (session()->get('keluhan')) ? session()->get('keluhan') : old('keluhan'); ?>" autocomplete="keluhan" autofocus placeholder="Keluhan">

                            @error('keluhan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="penyebab">Penyebab Cedera</label>
                            <input type="text" class="form-control @error('penyebab') is-invalid @enderror" id="penyebab" name="penyebab" value="<?php echo (session()->get('penyebab')) ? session()->get('penyebab') : old('penyebab'); ?>" autocomplete="penyebab" autofocus placeholder="penyebab">

                            @error('penyebab')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="lama">Lama Cedera</label>
                            <input type="text" class="form-control @error('lama') is-invalid @enderror" id="lama" name="lama" value="<?php echo (session()->get('lama')) ? session()->get('lama') : old('lama'); ?>" autocomplete="lama" autofocus placeholder="lama">

                            @error('lama')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="analisa">Analisa dan Diagnosa</label>
                            <input type="text" class="form-control @error('analisa') is-invalid @enderror" id="analisa" name="analisa" value="{{ old('analisa') }}" autocomplete="analisa" autofocus placeholder="Analisa dan Diagnosa">

                            @error('analisa')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="treatment">Treatment</label>
                            <input type="text" class="form-control @error('treatment') is-invalid @enderror" id="treatment" name="treatment" value="{{ old('treatment') }}" autocomplete="treatment" autofocus placeholder="Treatment">

                            @error('treatment')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="bagian_penenang">Bagian yang Diberikan Penanganan</label>
                            <input type="text" class="form-control @error('bagian_penenang') is-invalid @enderror" id="bagian_penenang" name="bagian_penenang" value="{{ old('bagian_penenang') }}" autocomplete="bagian_penenang" autofocus placeholder="Bagian yang Diberikan Penanganan">

                            @error('bagian_penenang')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kesimpulan">Kesimpulan dan Rekomendasi</label>
                            <input type="text" class="form-control @error('kesimpulan') is-invalid @enderror" id="kesimpulan" name="kesimpulan" value="{{ old('kesimpulan') }}" autocomplete="kesimpulan" autofocus placeholder="Kesimpulan dan Rekomendasi">

                            @error('kesimpulan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="terapis">Terapis</label>
                            <input type="text" class="form-control @error('terapis') is-invalid @enderror" id="terapis" name="terapis" value="{{ old('terapis') }}" autocomplete="terapis" autofocus placeholder="Terapis">

                            @error('terapis')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>


                        <button type="submit" class="btn btn-primary mr-2">Tambah</button>
                        <a href="/detail-pasien/{{$id}}" class="btn btn-light">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection