@extends('layouts.master', ['title' => 'Home'])

@push('plugin-styles')
<link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
<div class="row">
    <div class="col-md-9">
        <div>
            <h4 class="mb-3 mb-md-2 mt-3">Data Pasien</h4>
        </div>
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Seluruh Data Pasien</li>
            </ol>
        </nav>
    </div>
    <div class="col-md-3 mt-4">
        <a href="/tambah-pasien" class="btn btn-primary btn-block">Tambah Pasien</a>
    </div>
</div>

<div class="row mt-5">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <div class="table-responsive">

                    <div class="row pb-2">
                        <div class="col-md-1">Search </div>
                        <div class="col-md-2">
                            <select id="op">
                                <option value="1">No. Pasien</option>
                                <option value="2">Nama</option>
                                <option value="3">Tgl. Lahir</option>
                                <option value="@role('admin') 5 @else 4 @endrole">Alamat</option>
                                <option value="@role('admin') 6 @else 5 @endrole">Jenis Kelamin</option>
                                <option value="@role('admin') 7 @else 6 @endrole">Tgl. Terakhir Kunjungan</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="column_filter form-control input-md" id="col0_filter">
                        </div>
                    </div>

                    @if(count($pasien) > 0 )
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">No. Pasien</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Tanggal Lahir</th>
                                @role('admin')
                                <th scope="col">No. Telepon</th>
                                @endrole
                                <th scope="col">Alamat</th>
                                <th scope="col">Jenis Kelamin</th>
                                <th scope="col">Tgl Terakhir Kunjungan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            ?>
                            @foreach($pasien as $p)
                            <tr>
                                <td>
                                    {{ $no }}
                                </td>
                                <td>
                                    {{ $p->nomor }}
                                </td>
                                <td>
                                    {{ $p->nama }}
                                </td>
                                <td>
                                    {{ date('d-m-Y', strtotime($p->ttl)) }}
                                </td>

                                @role('admin')
                                <td>
                                    {{ $p->tlp }}
                                </td>
                                @endrole
                                <td>
                                    {{ $p->alamat }}
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
                                    @if($p->perawatan->max('created_at') !== null)
                                    {{ $p->perawatan->max('created_at')->format('d-m-Y') }}
                                    @else
                                    Belum ada data kunjungan.
                                    @endif
                                </td>
                                <td style="text-align:center">
                                    <a href="/detail-pasien/{{ $p->id }}" class="btn btn-secondary btn-sm">Detail</a>
                                    <a href="/edit-pasien/{{ $p->id }}" class="btn btn-success btn-sm">Edit</a>
                                    <a href="/pasien/{{ $p->id }}/delete" class="btn btn-danger btn-sm" onclick="return confirm('Konfirmasi hapus pasien {{ $p->nama }}');">Hapus</a>
                                </td>
                            </tr>
                            <?php
                            $no++;
                            ?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="d-flex justify-content-center mt-5 ">
                    Tidak ada data pasien.
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#dataTableExample').DataTable();

        $('input.column_filter').on('keyup click', function() {
            filterColumn($('#op').val());
        });

        $('#op').on('click', function() {
            $('#col0_filter').val("")
        });
    });



    function filterColumn(i) {
        $('#dataTableExample').DataTable().column(i).search(
            $('#col0_filter').val()
        ).draw();
    }

    $('#dataTableExample').dataTable({
        dom: 'lrtp'
    });
</script>

@endsection

@push('plugin-scripts')
<script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush