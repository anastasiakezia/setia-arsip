@extends('layouts.admin')

@section('title')
Laporan Dinas Luar
@endsection

@section('container')
<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="mail"></i><i data-feather="arrow-right"></i></div>
                            Data Laporan Dinas Luar
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-header-actions mb-4">
                    <div class="card-header">
                        Data :
                        <div>
                            <a class="btn btn-sm btn-warning" href="{{ route('create') }}">
                                <i data-feather="plus-square"></i> &nbsp;
                                Tambah Surat
                            </a>
                            <a class="btn btn-sm btn-success" href="{{ route('print-surat-masuk') }}" target="_blank">
                                <i data-feather="printer"></i> &nbsp;
                                Cetak Laporan
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- Alert --}}
                        @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        {{-- List Data --}}
                        <div class="table table-responsive">
                            <table class="table table-striped table-hover table-sm" id="crudTable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Petugas</th>
                                        <th>Jabatan</th>
                                        <th>Unit</th>
                                        {{-- <th>Surat Tugas</th>
                                        <th>Laporan Dinas Luar</th>
                                        <th>Dokumen Lain</th> --}}
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@push('addon-script')
<script>
    var datatable = $('#crudTable').DataTable({
        processing: true,
        serverSide: true,
        ordering: true,
        ajax: {
            url: '{!! url()->current() !!}',
        },
        columns: [{
                "data": 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            // {
            //     data: 'letter_no',
            //     name: 'letter_no'
            // },
            {
                data: 'tanggal_laporan',
                name: 'tanggal_laporan',
                width: '10%'
            },
            {
                data: 'nama_petugas',
                name: 'nama_petugas',
                width: '10%'
            },
            {
                data: 'jabatan',
                name: 'jabatan'
            },
            {
                data: 'unit',
                name: 'unit'
            },
            // {
            //     data: 'disposisi',
            //     name: 'disposisi'
            // },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searcable: true,
                width: '15%'
            },
        ]
    });
</script>
@endpush