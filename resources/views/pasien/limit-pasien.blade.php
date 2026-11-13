@extends('layouts.master', ['title' => 'Data Pasien'])

@section('content')

<div>
    <h4 class="mb-3 mb-md-2">Data Pasien</h4>
</div>
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/home">Pasien</a></li>
        <li class="breadcrumb-item active" aria-current="page">Rekap Data Pasien </li>
    </ol>
</nav>



<div class="container">
    <div class="row mt-4">
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body table-responsive">
                    <form method="GET" action="/pasien" class="mt-3 forms-sample ml-3">
                        @csrf

                        <div class="form-group">
                            <label for="limit">Pilih Bulan dan Tahun</label>
                            <input type="month" class="form-control @error('limit') is-invalid @enderror" id="limit" name="limit" value="{{ old('limit') }}" autocomplete="limit" placeholder="limit">

                            @error('limit')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>



                        <button type="submit" class="btn btn-primary mr-2">Lihat</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    @if(isset($pasien))
    <div class="row mt-4">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3 mt-3">
                        <h4>
                            Data Pemeriksaan pada
                            {{ date("F", mktime(0, 0, 0, $date[1], 1)) }}
                            , {{ $date[0] }}
                        </h4>
                        <span class="breadcrumb-item active">
                            Jumlah Pemeriksaan : {{ count($pasien) }}
                        </span>
                    </div>
                    @if(count($pasien) > 0)
                    <div class="table-responsive">

                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">No. Pasien</th>
                                    <th scope="col">Nama Pasien</th>
                                    <th scope="col">Jenis Kelamin</th>
                                    <th scope="col">Tanggal Lahir</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Keluhan</th>
                                    <th scope="col">Diagnosa</th>
                                    <th scope="col">Treatment</th>
                                    <th scope="col">Bagian yang ditangani</th>
                                    <th scope="col">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $nomor = 1; ?>
                                <?php
                                ?>
                                @foreach($pasien as $p)
                                <tr>
                                    <td>
                                        {{ $nomor }}
                                    </td>
                                    <td>
                                        {{ $p->id }}
                                    </td>
                                    <td>
                                        {{ $p->nama }}
                                    </td>
                                    <td>
                                        @if($p->gender == 'L')
                                        Laki - Laki
                                        @elseif($p->gender == 'P')
                                        Perempuan
                                        @else
                                        {{ $p->gender }}
                                        @endif
                                    </td>
                                    <td>
                                        {{ date('d-m-Y', strtotime($p->ttl)) }}
                                    </td>
                                    <td>
                                        {{ $p->alamat }}
                                    </td>
                                    <td>
                                        {{ $p->keluhan }}
                                    </td>
                                    <td>
                                        {{ $p->analisa }}
                                    </td>
                                    <td>
                                        {{ $p->treatment }}
                                    </td>
                                    <td>
                                        {{ $p->bagian_penenang }}
                                    </td>
                                    <td>
                                        {{ $p->created_at->format('d-m-Y') }}
                                    </td>
                                </tr>
                                <?php $nomor++; ?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="d-flex justify-content-center mt-5 mb-3">
                        Tidak ada data pemeriksaan.
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

@endsection