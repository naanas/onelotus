@extends('layouts.master', ['title' => 'Result Form'])


@push('plugin-styles')
<link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />

@endpush
@section('content')

<?php
$url = 'https://opensheet.elk.sh/12wgPMZDmuPqb_Nc9KD6OVa6sMgrllm8D5VI1hM4CXAI/form1';
$json = file_get_contents($url);
$jo = json_decode($json, true);
function cekForm($form, $timestamp, $nama)
{
    $cek = false;
    foreach ($form as $key) {
        if ($key->timestamp == $timestamp && $key->nama == $nama) {
            $cek = true;
            break;
        }
    }
    return $cek;
}

?>
<div class="row">
    <div class="col-md-9">
        <div>
            <h4 class="mb-3 mb-md-2 mt-3">Hasil Formulir Pasien</h4>
        </div>
    </div>
    <div class="col-md-3 mt-4">
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
                                <option value="2">Nama</option>
                                <option value="3">Alamat</option>
                                <option value="4">Tempat/Tgl. Lahir</option>
                                <option value="5">Tgl. Daftar</option>
                                <option value="@role('admin') 7 @else 6 @endrole">Jenis Kelamin</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="column_filter form-control input-md" id="col0_filter">
                        </div>
                    </div>


                    <table class="table" id="dataTableExample">
                        <thead>
                            <th>No.</th>
                            <th>Aksi</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Tempat/Tgl. Lahir</th>
                            <th>Tgl. daftar</th>
                            @role('admin')
                            <th>No. HP</th>
                            @endrole
                            <th>Jenis Kelamin</th>
                            <th>BB / TB</th>
                            <th>Instansi Pekerjaan</th>
                            <th>Hobi/Kegiatan</th>
                            <th>Keluhan / Cedera</th>
                            <th>Penyebab Cedera</th>
                            <th>Lama Cedera</th>
                            <th>MRI atau Rontgen</th>
                        </thead>
                        <?php
                        $i = 1;
                        foreach (array_reverse($jo) as $a) {
                            ?>
                            <tr>
                                <td>{{ $i }}</td>
                                <td>
                                    @if(cekForm($form, $a['Timestamp'], $a['Nama']) == true)
                                    <button type="button" class="btn btn-sm btn-outline-secondary" disabled><small>Data sudah ditambahkan</small></button>
                                    @else
                                    <form action="save-form" method="post">
                                        @csrf
                                        <input type="hidden" value="{{ $a['Nama'] }}" name="Nama">
                                        <input type="hidden" value="{{ $a['Alamat'] }}" name="Alamat">
                                        <input type="hidden" value="{{ $a['Timestamp'] }}" name="Timestamp">
                                        <input type="hidden" value="{{ $a['Tanggal Lahir'] }}" name="Tanggal_Lahir">
                                        <input type="hidden" value="{{ $a['Nomor Telepon'] }}" name="Nomor_Telepon">
                                        <input type="hidden" value="{{ $a['Jenis Kelamin'] }}" name="Jenis_Kelamin">
                                        <input type="hidden" value="{{ $a['Instansi Pekerjaan'] }}" name="Instansi">
                                        <input type="hidden" value="{{ $a['Tempat Lahir'] }}" name="Tempat_Lahir">
                                        <input type="hidden" value="{{ $a['Berat Badan'] }}" name="Berat_Badan">
                                        <input type="hidden" value="{{ $a['Tinggi Badan'] }}" name="Tinggi_Badan">
                                        <input type="hidden" value="{{ $a['Hobi/Kegiatan'] }}" name="Hobi/Kegiatan">
                                        <input type="hidden" value="{{ $a['Keluhan/Cedera'] }}" name="Keluhan/Cedera">
                                        <input type="hidden" value="{{ $a['Penyebab Cedera'] }}" name="Penyebab_Cedera">
                                        <input type="hidden" value="{{ $a['Lama Cedera'] }}" name="Lama_Cedera">
                                        @if(isset($a['Hasil Rontgen atau MRI']))
                                        <input type="hidden" value="{{  $a['Hasil Rontgen atau MRI'] }}" name="Rontgen">
                                        @else
                                        <input type="hidden" value="" name="Rontgen">
                                        @endif

                                        <button type="submit" class="btn btn-sm btn-primary">Tambah Pasien</button>
                                    </form>
                                    @endif
                                </td>
                                <td>{{ $a["Nama"] }}</td>
                                <td>{{ $a["Alamat"] }}</td>
                                <td>{{ $a["Tempat Lahir"] }},{{ $a['Tanggal Lahir'] }} </td>
                                <td>{{ $a["Timestamp"] }}</td>
                                @role('admin')
                                <td>{{ $a["Nomor Telepon"] }}</td>
                                @endrole
                                <td>{{ $a["Jenis Kelamin"] }}</td>
                                <td>{{ $a["Berat Badan"] }} / {{$a['Tinggi Badan']}} </td>
                                <td>{{ $a["Instansi Pekerjaan"] }}</td>
                                <td>{{ $a["Hobi/Kegiatan"] }}</td>
                                <td>{{ $a["Keluhan/Cedera"] }}</td>
                                <td>{{ $a["Penyebab Cedera"] }}</td>
                                <td>{{ $a["Lama Cedera"] }}</td>
                                <td>
                                    @if(isset($a['Hasil Rontgen atau MRI']))
                                    <a href="{{ $a['Hasil Rontgen atau MRI'] }}">link</a>
                                    @else
                                    -
                                    @endif
                                </td>
                            </tr>
                            <?php
                            $i++;
                        }
                        ?>
                    </table>
                </div>
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