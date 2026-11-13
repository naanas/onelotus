@extends('layouts.master', ['title' => 'Export'])

@section('content')

<div>
    <h4 class="mb-3 mb-md-2">Export Data Pasien</h4>
</div>
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/home">Pasien</a></li>
        <li class="breadcrumb-item active" aria-current="page">Export Excel</li>
    </ol>
</nav>



<div class="container">
    <div class="row mt-4">
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body table-responsive">
                    <form method="GET" action="/export/download" class="mt-3 forms-sample ml-3">
                        @csrf

                        <div class="form-group">
                            <label for="bulan">Pilih Bulan dan Tahun</label>
                            <input type="month" class="form-control @error('bulan') is-invalid @enderror" id="bulan" name="bulan" value="{{ old('bulan') }}" autocomplete="bulan" placeholder="bulan">

                            @error('bulan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>



                        <button type="submit" class="btn btn-primary mr-2">Export ke Excel</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>

@endsection