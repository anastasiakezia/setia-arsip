@extends('layouts.admin')

@section('title')
Surat Keluar
@endsection

@section('container')
<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="mail"></i><i data-feather="arrow-left"></i></div>
                            Data Surat Keluar
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
                            @php($status_condition=1)
                            <a class="btn btn-sm btn-danger" href="{{ route('surat-keluar-terhapus', $status_condition) }}">
                                <i data-feather="trash-2"></i> &nbsp;
                                Data Terhapus
                            </a>
                            <a class="btn btn-sm btn-warning" href="{{ route('letterout.create') }}">
                                <i data-feather="plus-square"></i> &nbsp;
                                Tambah Surat
                            </a>
                            <a class="btn btn-sm btn-success" href="{{ route('print-surat-keluar') }}" target="_blank">
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
                                        <th width="10">No.</th>
                                        <th>Tanggal</th>
                                        <th>No. Surat</th>
                                        <th>Jenis Surat Keluar</th>
                                        <th>Sifat Surat</th>
                                        <th>Nama Surat</th>
                                        <th>Tujuan</th>
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
    {{-- Modal Add --}}
    <div class="modal fade" id="createModal" role="dialog" aria-labelledby="createModal" aria-hidden="true" style="overflow:hidden;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModal">Tambah Catatan</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('department.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <div class="col-md-12">
                                <label for="post_id">Nama Unit</label>
                                <input type="text" name="name" class="form-control" placeholder="Masukan Nama Unit.." required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="col-md-12">
                                <label for="post_id">Isi Catatan</label>
                                {{-- <textarea id="disposisi_desc" class="disposisi-desc" cols="50" rows ="4" name="disposisi_desc" placeholder="Masukan isi Disposisi.." class="form-control" required style="border: 1px solid #cccccc; border-radius:5px;"></textarea> --}}
                                <textarea type="text" name="note_desc" class="form-control note-desc" placeholder="Masukan isi Catatan.." required style="height: 100px; width:465px;"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                </form>
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
            {
                data: 'letterout_date',
                name: 'letterout_date'
            },
            {
                data: 'letter_no',
                name: 'letter_no'
            },
            {
                data: 'letterout_type',
                name: 'letterout_type'
            },
            {
                data: 'letterout_char',
                name: 'letterout_char'
            },
            {
                data: 'letterout_name',
                name: 'letterout_name'
            },
            {
                data: 'purpose',
                name: 'purpose'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searcable: false,
                width: '15%'
            },
        ]
    });
</script>
@endpush