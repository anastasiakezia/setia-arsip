@extends('layouts.admin')

@section('title')
Surat Disposisi
@endsection

@section('container')
<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="mail"></i></div>
                            Data Surat Disposisi
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
                            <a class="btn btn-sm btn-warning" href="{{ route('disposisi.create') }}">
                                <i data-feather="plus-square"></i> &nbsp;
                                Tambah Surat
                            </a>
                            <a class="btn btn-sm btn-success" href="{{ route('print-surat-disposisi') }}" target="_blank">
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
                            <table class="table table-striped table-hover table-sm table-responsive" id="disposisiTable">
                                <thead>
                                    <tr>
                                        <th width="10">No.</th>
                                        <th>No.Surat</th>
                                        <th>Asal Unit</th>
                                        <th>Asal Direksi / Karyawan</th>
                                        <th>Tujuan Unit</th>
                                        <th>Tujuan Direksi / Karyawan</th>  
                                        <th>Isi Disposisi</th>
                                        <th>Status</th>
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
    var datatable = $('#disposisiTable').DataTable({
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
            {
                data: 'letter.letter_no',
                // label: 'No.Surat'
                name: 'letter.letter_no'
            },
            {
                data: 'asal_disposisi.department.name',
                name: 'asal_disposisi.department.name'
            },
            {
                data: 'asal_disposisi.nama',
                name: 'asal_disposisi.nama'
            },
            {
                data: 'tujuan_disposisi.department.name',
                name: 'tujuan_disposisi.department.name'
            },
            {
                data: 'tujuan_disposisi.nama',
                name: 'tujuan_disposisi.nama'
            },
            {
                data: 'isi_disposisi',
                name: 'isi_disposisi'
                // label:'isi_disposisi'
            },
            {
                data: 'status_surat',
                render: function(data){
                        // return data == '0' ? 'Disposisi' : 'Eskalasi';
                        if(data == '0'){
                            return '<span style="color:blue;">Disposisi</span>';
                        }if(data == '1'){
                            return '<span style="color:green;">Eskalasi</span>';
                        }
                    },
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searcable: false,
                width: '15%'
            },
        ],
        columnDefs: [{target: 3,
        }]
    });
</script>
@endpush