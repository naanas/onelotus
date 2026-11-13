@extends('layouts.master', ['title' => 'User Management'])

@push('plugin-styles')
<link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
<div>
    <h4 class="mb-3 mb-md-2 mt-3">User Management</h4>
</div>


<div class="row mt-5">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <a href="user/tambah" class="btn btn-primary px-5 mb-3">Tambah User</a>
                <div class="table-responsive">
                    @if(count($users) > 0 )
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Username</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>
                                    {{ $user->id }}
                                </td>
                                <td>
                                    {{ $user->name }}
                                </td>

                                <td>
                                    {{ $user->username }}
                                </td>
                                <td style="max-width:80px">
                                    @if($user->id != 2)
                                    <a href="/user/{{ $user->id }}/delete" class="btn btn-danger btn-sm" onclick="return confirm('Konfirmasi hapus user {{ $user->username }}');">Hapus</a>
                                    @endif
                                    <a href="/user/{{ $user->id }}/ubah-password" class="btn btn-sm btn-secondary">Ubah Password</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="d-flex justify-content-center mt-5 ">
                    Tidak ada pengajuan analisa contoh.
                </div>
                @endif
            </div>
        </div>
    </div>
</div>



@endsection

@push('plugin-scripts')
<script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('custom-scripts')
<script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush