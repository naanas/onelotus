@extends('layouts.master', ['title' => 'Ubah Password'])

@section('content')

<div>
    <h4 class="mb-3 mb-md-2">Ubah Password User {{ $user->name }}</h4>
</div>
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/user">User</a></li>
        <li class="breadcrumb-item active" aria-current="page">Ubah password</li>
    </ol>
</nav>



<div class="container mt-5">
    <div class="row">
        <div class="col-md-9 grid-margin stretch-card mx-auto">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="/user/{{ $user->id }}/update-password" class="mt-3 forms-sample ml-3">
                        @csrf
                        <input type="hidden" name="id" value="{{ $user->id }}">

                        <div class="form-group mb-5">
                            <label for="password">Masukan Password Baru</label>

                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" autocomplete="new-password" placeholder="Password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                        <a href="/user" class="btn btn-light">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection