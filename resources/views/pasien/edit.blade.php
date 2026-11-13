@extends('layouts.master', ['title' => 'Edit Pasien'])

@section('content')

<div>
    <h4 class="mb-3 mb-md-2">Edit Pasien</h4>
</div>
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/home">Pasien</a></li>
        <li class="breadcrumb-item"><a href="/detail-pasien/{{ $pasien->id }}">Detail Pasien</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Pasien</li>
    </ol>
</nav>



<div class="container">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="/edit-pasien/save" class="mt-3 forms-sample ml-3">
                        @csrf
                        <input type="hidden" name="id" value="{{ $pasien->id }}">
                        <div class="form-group">
                            <label for="nomor">Nomor</label>
                            <input type="text" class="form-control @error('nomor') is-invalid @enderror" id="nomor" name="nomor" value="{{ $pasien->nomor }}" autocomplete="nomor" autofocus placeholder="Nomor">

                            @error('nomor')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ $pasien->nama }}" autocomplete="nama" placeholder="Nama">

                            @error('nama')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="ttl">Tanggal Lahir</label>
                            <input type="date" class="form-control @error('ttl') is-invalid @enderror" id="ttl" name="ttl" value="{{ $pasien->ttl }}" autocomplete="ttl">

                            @error('ttl')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tlp">Nomor Telepon</label>
                            <input type="number" class="form-control @error('tlp') is-invalid @enderror" id="tlp" name="tlp" value="{{ $pasien->tlp }}" autocomplete="tlp" placeholder="Nomor Telepon">

                            @error('tlp')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat</label>

                            <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" value="{{ $pasien->alamat }}" autocomplete="alamat" placeholder="Alamat">
                            @error('alamat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="bb">Berat Badan</label>

                            <input type="number" class="form-control @error('bb') is-invalid @enderror" id="bb" name="bb" value="{{ ($pasien->bb == null)? 0 : $pasien->bb }}" autocomplete="bb" placeholder="Berat Badan">
                            @error('bb')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tb">Tinggi Badan</label>

                            <input type="number" class="form-control @error('tb') is-invalid @enderror" id="tb" name="tb" value="{{ ($pasien->tb == null)? 0 : $pasien->tb }}" autocomplete="tb" placeholder="Tinggi Badan">
                            @error('tb')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="gender">Jenis Kelamin</label>
                            <select class="form-control" name="gender" id="gender">
                                <option value="L" @if($pasien->gender == 'L') selected @endif>Laki - Laki </option>
                                <option value="P" @if($pasien->gender == 'P') selected @endif>Perempuan </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="hobi">Hobi / Kegiatan</label>

                            <input type="text" class="form-control @error('hobi') is-invalid @enderror" id="hobi" name="hobi" value="{{ $pasien->hobi }}" autocomplete="hobi" placeholder="Hobi atau Kegiatan">
                            @error('hobi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="instansi">Instansi</label>

                            <input type="text" class="form-control @error('instansi') is-invalid @enderror" id="instansi" name="instansi" value="{{ $pasien->instansi }}" autocomplete="instansi" placeholder="Instansi">
                            @error('instansi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                        <a href="/detail-pasien/{{ $pasien->id }}" class="btn btn-light">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection