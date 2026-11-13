@extends('layouts.master', ['title' => 'Detail Pasien'])

@section('content')

<div>
    <h4 class="mb-3 mb-md-2">Data Pasien</h4>
</div>
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/home">Pasien</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail Pasien</li>
    </ol>
</nav>



<div class="container">
    <div class="row mt-4">
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <td> Nomor Pasien </td>
                            <td>: {{ $pasien->nomor }} </td>
                        </tr>
                        <tr>
                            <td> Nama </td>
                            <td>: {{ $pasien->nama }} </td>
                        </tr>
                        <tr>
                            <td> Tanggal Lahir </td>
                            <td>: {{ $pasien->ttl }} </td>
                        </tr>
                        @role('admin')
                        <tr>
                            <td> Nomor Telepon </td>
                            <td>: {{ $pasien->tlp }} </td>
                        </tr>
                        @endrole
                        <tr>
                            <td> Alamat </td>
                            <td>: {{ $pasien->alamat }} </td>
                        </tr>
                        <tr>
                            <td> Berat Badan </td>
                            <td>: {{ $pasien->bb }} </td>
                        </tr>
                        <tr>
                            <td> Tinggi Badan </td>
                            <td>: {{ $pasien->tb }} </td>
                        </tr>
                        <tr>
                            <td> Jenis Kelamin </td>
                            <td>:
                                @if($pasien->gender == 'L')
                                Laki - Laki
                                @elseif($pasien->gender == 'P')
                                Perempuan
                                @else
                                {{ $pasien->gender }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td> Instansi </td>
                            <td>: {{ $pasien->instansi }} </td>
                        </tr>
                        <tr>
                            <td> Hobi / Kegiatan </td>
                            <td>: {{ $pasien->hobi }} </td>
                        </tr>
                    </table>
                    <div class="col-md-4 mt-5">
                        <a href="/edit-pasien/{{ $pasien->id }}" class="btn btn-secondary">Edit Data Pasien</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <a href="/detail-pasien/{{$pasien->id}}/tambah-pemeriksaan" class="btn btn-primary mt-3 mb-5">Tambah Pemeriksaan</a>
                    <div class="table-responsive">
                        @if(count($pasien->perawatan) > 0 )
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Keluhan</th>
                                    <th scope="col">Penyebab</th>
                                    <th scope="col">Lama Cedera</th>
                                    <th scope="col">Diagnosa</th>
                                    <th scope="col">Treatment</th>
                                    <th scope="col">Bagian yang ditangani</th>
                                    <th scope="col">Kesimpulan</th>
                                    <th scope="col">Terapis</th>
                                    <th scope="col">MRI/Rontgen</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pasien->perawatan as $p)
                                <tr>
                                    <td>
                                        {{ date('d-m-Y', strtotime($p->created_at)) }}
                                    </td>
                                    <td>
                                        {{ $p->keluhan }}
                                    </td>
                                    <td>
                                        {{ $p->penyebab }}
                                    </td>
                                    <td>
                                        {{ $p->lama_cedera }}
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
                                        {{ $p->kesimpulan }}
                                    </td>
                                    <td>
                                        {{ $p->terapis }}
                                    </td>
                                    <td>
                                        @if(isset($p->hasil_rontgen) && $p->hasil_rontgen != '-')
                                        <a href="{{ $p->hasil_rontgen }}">link</a>
                                        @else
                                        -
                                        @endif
                                    </td>
                                    <td style="text-align:center">
                                        <a href="/detail-pasien/edit-pemeriksaan/{{ $p->id }}" class="btn btn-secondary btn-sm">edit</a>
                                        <a href="/detail-pasien/{{ $p->id }}/delete" class="btn btn-danger btn-sm" onclick="return confirm('Konfirmasi hapus pemeriksaan ? ');">Hapus</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="d-flex justify-content-center mt-5 ">
                        Tidak ada data pemerisaan pada pasien.
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection