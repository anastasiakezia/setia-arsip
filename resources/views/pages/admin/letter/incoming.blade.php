@extends('layouts.admin')
{{-- @include('sweetalert::alert') --}}

@section('title')
Surat Masuk
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
                            Data Surat Masuk
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
                            <a class="btn btn-sm btn-danger" href="{{ route('surat-masuk-terhapus', $status_condition) }}">
                                <i data-feather="trash-2"></i> &nbsp;
                                Data Terhapus
                            </a>
                            <a class="btn btn-sm btn-warning" href="{{ route('letter.create') }}">
                                <i data-feather="plus-square"></i> &nbsp;
                                Tambah Surat
                            </a>
                            <a class="btn btn-sm btn-success" href="{{ route('print-surat-masuk') }}" target="_blank">
                                <i data-feather="printer"></i> &nbsp;
                                Cetak Laporan
                            </a>
                            {{-- <button class="btn btn-primary" id="kanan">kanan</button> --}}
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
                                        <th>Tanggal Masuk</th>
                                        <th>No. Surat</th>
                                        <th>Sifat Surat</th>
                                        <th>Perihal</th>
                                        <th>Jenis Pengirim</th>
                                        {{-- <th>Pengirim</th> --}}
                                        <th>Nama Pengirim</th>
                                        {{-- <th>Direksi/Karyawan Pengirim</th> --}}
                                        {{-- <th>Unit Tujuan</th> --}}
                                        <th>Direksi / Karyawan Tujuan</th>
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
    {{-- Modal Add Disposisi--}}
    <div class="modal fade" id="createModal" role="dialog" aria-labelledby="createModal" aria-hidden="true" style="overflow-auto;" data-focus="false">
        <div class="modal-dialog modal-xl" role="document" style="max-width:64%">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalDisposisi">Tambah Disposisi / Eskalasi</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <form action="{{ route('disposisi.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body overflow-auto" >
                        <div class="mb-3">
                            <div class="col-md-12">
                                @foreach ($letters as $letter)
                                <input id="edit_modal_form_eskalasi_disposisi" type="hidden" name="letter_id" value={{ $letter->id }}>
                                @endforeach
                                <label for="post_id"><b>Jenis Surat</b></label>
                                <select name="letter_type" class="form-control" required>
                                    <option value="Surat Masuk" {{ (old('letter_type') == 'Surat Masuk')? 'selected':''; }}>Surat Masuk</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="col-md-12">
                                <label for="post_id"><b>Pilih Jenis Pengiriman Surat</b></label>
                                <div class="mb-3">
                                    <div class="col-md-12">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status_surat" id="inlineRadio1" value="0">
                                            <label class="form-check-label" for="inlineRadio1">Disposisi</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status_surat" id="inlineRadio2" value="1">
                                            <label class="form-check-label" for="inlineRadio2">Eskalasi</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="col-md-12">
                                <label for="post_id"><b>Asal Unit</b></label>
                                <select class="form-control single-select-field" id="asal_unit" data-placeholder="pilih unit" required style=" margin-top: 336px;">
                                    <option>== Pilih Unit ==</option>
                                        @foreach ($departments as $department)
                                        <option value="{{ $department->id }}" {{ (old('department_id') == $department->id)? 'selected':''; }}>{{ $department->name }}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="col-md-12" style="margin-bottom:30px" >
                                {{-- <label for="post_id">Tujuan Disposisi</label>
                                <input type="text" name="tujuan_disposisi" class="form-control" placeholder="Masukkan Tujuan Disposisi.." required> --}}
                                <label for="post_id"><b>Asal Direksi / Karyawan</b></label>
                                <select class="form-control single-select-field" name="asal_disposisi" id="asal_direksi_karyawan" data-placeholder="pilih unit" required>                                    
                                    <option>== Pilih Direksi / Karyawan ==</option>
                                        {{-- @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}" {{ (old('department_id') == $employee->id)? 'selected':''; }}>{{ $employee->employee_name }} - {{ $employee->position }}</option>
                                        @endforeach --}}
                                </select>
                                @error('department_id')
                                <div class="invalid-feedback">
                                    {{ $message; }}
                                </div>
                                @enderror
                            </div>
                        </div><hr style="border-top: 2px dotted black; width:90%; margin: 0 auto;">
                        <div class="mb-3">
                            <div class="col-md-12" style="margin-top: 20px">
                                {{-- <label for="post_id">Tujuan Disposisi</label>
                                <input type="text" name="tujuan_disposisi" class="form-control" placeholder="Masukkan Tujuan Disposisi.." required> --}}
                                <label for="post_id"><b>Tujuan Unit</b></label>
                                <select class="form-control single-select-field" id="tujuan_disposisi" data-placeholder="pilih unit" required>                                    
                                        <option>== Tujuan Unit ==</option>
                                        @foreach ($departments as $department)
                                        <option value="{{ $department->id }}" {{ (old('department_id') == $department->id)? 'selected':''; }}>{{ $department->name }}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="col-md-12">
                                {{-- <label for="post_id">Tujuan Disposisi</label>
                                <input type="text" name="tujuan_disposisi" class="form-control" placeholder="Masukkan Tujuan Disposisi.." required> --}}
                                <label for="post_id"><b>Tujuan Direksi / Karyawan</b></label>
                                <select class="form-control single-select-field" name="tujuan_disposisi" id="direksi_tujuan" data-placeholder="pilih unit" required>
                                    <option>---Pilih Direksi / Karyawan---</option>
                                    {{-- <option>== Pilih Direksi / Karyawan ==</option> --}}
                                        {{-- @foreach ($departments as $department)
                                        <option value="{{ $department->id }}" {{ (old('department_id') == $department->id)? 'selected':''; }}>{{ $department->name }}</option>
                                        @endforeach --}}
                                </select>
                                @error('department_id')
                                <div class="invalid-feedback">
                                    {{ $message; }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="col-md-12">
                                <label for="post_id"><b>Isi Disposisi / Eskalasi</b></label>
                                {{-- <textarea id="disposisi_desc" class="disposisi-desc" cols="50" rows ="4" name="disposisi_desc" placeholder="Masukan isi Disposisi.." class="form-control" required style="border: 1px solid #cccccc; border-radius:5px;"></textarea> --}}
                                <textarea type="text" name="isi_disposisi" class="form-control disposisi-desc" placeholder="Masukkan isi Disposisi / Eskalasi.." required style="height: 100px; width:770px;"></textarea>
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
    {{-- End Modal Disposisi --}}

    {{-- Add Modal Tindak Lanjut --}}
    <div class="modal fade" id="createModalTindak" role="dialog" aria-labelledby="createModal" aria-hidden="true" style="overflow-auto;">
        <div class="modal-dialog" role="document" style="max-width:64%">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModal">Tambah Tindak Lanjut</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('disposisi.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body overflow-auto" >
                        <div class="mb-3">
                            <div class="col-md-12">
                                @foreach ($letters as $letter)
                                <input type="hidden" name="letter_id" value={{ $letter->id }}>
                                @endforeach
                                <label for="post_id"><b>Nomor Surat</b></label>
                                {{-- <select name="letter_type" class="form-control" required> --}}
                                    {{-- <option value="Surat Masuk" {{ (old('letter_type') == 'Surat Masuk')? 'selected':''; }}>Surat Masuk</option> --}}
                                    <input type="text" class="form-control @error('letter_no') is-invalid @enderror" value="{{ $letter->letter_no }}" name="letter_no" placeholder="No. Surat.." disabled>
                                {{-- </select>--}}
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="col-md-12">
                                {{-- <label for="post_id">Tujuan Disposisi</label>
                                <input type="text" name="tujuan_disposisi" class="form-control" placeholder="Masukkan Tujuan Disposisi.." required> --}}
                                <label for="post_id"><b>Unit</b></label>
                                <select class="form-control single-select-field" id="asal_unit_tindakLanjut" data-placeholder="pilih unit" required>
                                    <option>== Pilih Unit ==</option>
                                        @foreach ($departments as $department)
                                        <option value="{{ $department->id }}" {{ (old('department_id') == $department->id)? 'selected':''; }}>{{ $department->name }}</option>
                                        @endforeach
                                </select>
                                {{-- @error('department_id')
                                <div class="invalid-feedback">
                                    {{ $message; }}
                                </div>
                                @enderror --}}
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="col-md-12" style="margin-bottom:30px">
                                {{-- <label for="post_id">Tujuan Disposisi</label>
                                <input type="text" name="tujuan_disposisi" class="form-control" placeholder="Masukkan Tujuan Disposisi.." required> --}}
                                <label for="post_id"><b>Direksi / Karyawan</b></label>
                                <select class="form-control single-select-field" name="asal_disposisi" id="asal_direksi_karyawan_tindak_lanjut" data-placeholder="pilih unit" required>                                    <option>== Pilih Direksi / Karyawan ==</option>
                                        {{-- @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}" {{ (old('department_id') == $employee->id)? 'selected':''; }}>{{ $employee->employee_name }} - {{ $employee->position }}</option>
                                        @endforeach --}}
                                </select>
                                @error('department_id')
                                <div class="invalid-feedback">
                                    {{ $message; }}
                                </div>
                                @enderror
                            </div>
                        {{-- </div><hr style="border-top: 2px dotted black; width:90%; margin: 0 auto;"> --}}
                        <div class="mb-3">
                            <div class="col-md-12">
                                <label for="post_id"><b>Isi Tindak Lanjut</b></label>
                                {{-- <textarea id="disposisi_desc" class="disposisi-desc" cols="50" rows ="4" name="disposisi_desc" placeholder="Masukan isi Disposisi.." class="form-control" required style="border: 1px solid #cccccc; border-radius:5px;"></textarea> --}}
                                <textarea type="text" name="isi_disposisi" class="form-control disposisi-desc" placeholder="Masukkan isi Tindak Lanjut.." required style="height: 100px; width:770px;"></textarea>
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
    {{-- End Modal Tindak Lanjut --}}
</main>
@endsection

@push('addon-style')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" /> --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.1.1/dist/select2-bootstrap-5-theme.min.css" /> --}}
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" /> --}}
@endpush


@push('addon-script')
<script>
    var datatable = $('#crudTable').DataTable({
        processing: true,
        serverSide: true,
        ordering: true,
        // scrollX: true,
        scrollCollapse: true,
        autoWidth : true,
        fixedHeader: {
            header: true,
            // headerOffset: 20,
            },
        responsive:true,
        ajax: {
            url: '{!! url()->current() !!}',
        },
        columns: [{
                "data": 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                data: 'letter_date',
                name: 'letter_date',
                width: '10%'
            },
            {
                data: 'letter_no',
                name: 'letter_no',
                width: '10%'
            },
            {
                data: 'letter_char',
                name: 'letter_char',
            },
            {
                data: 'regarding',
                name: 'regarding',
                width: '10%'
            },
            {
                data: 'sender_type',
                name: 'sender_type',
            },
            {
                data: 'sender_name',
                // data: 'sender_internal',
                name: 'sender_name',
                width: '10%'
            },
            // {
            //     data: 'unit_sender_internal',
            //     name: 'unit_sender_internal',
            // },
            // {
            //     data: 'sender_name_internal',
            //     name:'sender_name_internal'
            // },
            {
                data: 'employee.nama',
                name: 'employee.nama',
                width: '10%'
            },
            // {
            //     data:'employee.position',
            //     name: 'employee.position'
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

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script>
    $('#tujuan_disposisi').change(function() {
            var id = $(this).val();
            // if (id) {
                $.ajax({
                    type: "GET",
                    // url: 'http://setia-arsip.test/admin/karyawan-dropdown',
                    url:'{{ route('karyawan.dropdown') }}',
                    data:{id:id},
                    dataType: 'JSON',
                    success: function(response) {
                        if (response) {
                            $("#direksi_tujuan").empty();
                            $("#direksi_tujuan").append('<option>---Pilih Direksi / Karyawan---</option>');
                            $.each(response, function(id, value) {
                                $("#direksi_tujuan").append('<option value="' + value.id + '">' + value.nama + ' - '+value.position+'</option>');
                            });
                        } else {
                            $("#direksi_tujuan").empty();
                        }
                    }
                });
        });
    
    // yang buat asal direksi dan unit (bagian disposisi)
    $(document).ready(function(){
        $('#asal_unit').change(function() {
            var id = $(this).val();
            // if (id) {
                $.ajax({
                    type: "GET",
                    // url: 'http://setia-arsip.test/admin/karyawan-dropdown',
                    url:'{{ route('karyawan.dropdown') }}',
                    data:{id:id},
                    dataType: 'JSON',
                    success: function(response) {
                        if (response) {
                            $("#asal_direksi_karyawan").empty();
                            $("#asal_direksi_karyawan").append('<option>---Pilih Direksi / Karyawan---</option>');
                            $.each(response, function(id, value) {
                                $("#asal_direksi_karyawan").append('<option value="' + value.id + '">' + value.nama + ' - '+value.position+'</option>');
                            });
                        } else {
                            $("#direksi_tujasal_direksi_karyawanuan").empty();
                        }
                    }
                });
            // } else {
            //     $("#direksi_tujuan").empty();
            // }
        });
    });
    // $('#createModalDisposisi').on('shown.bs.modal', function () {
    // });
    

    // yang buat asal direksi dan unit (bagian tindak lanjut)
    $(document).ready(function(){
        $('#asal_unit_tindakLanjut').change(function() {
            var id = $(this).val();
            // if (id) {
                $.ajax({
                    type: "GET",
                    // url: 'http://setia-arsip.test/admin/karyawan-dropdown',
                    url:'{{ route('karyawan.dropdown') }}',
                    data:{id:id},
                    dataType: 'JSON',
                    success: function(response) {
                        if (response) {
                            $("#asal_direksi_karyawan_tindak_lanjut").empty();
                            $("#asal_direksi_karyawan_tindak_lanjut").append('<option>---Pilih Direksi / Karyawan---</option>');
                            $.each(response, function(id, value) {
                                $("#asal_direksi_karyawan_tindak_lanjut").append('<option value="' + value.id + '">' + value.nama + ' - '+value.position+'</option>');
                            });
                        } else {
                            $("#direksi_tujasal_direksi_karyawanuan").empty();
                        }
                    }
                });
        });
    });

    // SEARCH DROPDOWN
    $(document).ready(function(){
        $('#createModal').on('shown.bs.modal', function (){
            $('#asal_unit').select2({
                dropdownParent: $('#createModal .modal-body'),
                dropdownAutoWidth: true,
                dropdownCssClass: 'force-dropdown-to-bottom',
                dropdownPosition: 'below',
                theme: "bootstrap-5",
                width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            });
            $('#asal_direksi_karyawan').select2({
                dropdownParent: $('#createModal .modal-body'),
                dropdownAutoWidth: true,
                dropdownCssClass: 'force-dropdown-to-bottom',
                dropdownPosition: 'below',
                theme: "bootstrap-5",
                width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            });
            $('#tujuan_disposisi').select2({
                dropdownParent: $('#createModal .modal-body'),
                dropdownAutoWidth: true,
                dropdownCssClass: 'dropdown-static',
                dropdownPosition: 'below',
                theme: "bootstrap-5",
                width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            });
            $('#direksi_tujuan').select2({
                dropdownParent: $('#createModal .modal-body'),
                dropdownAutoWidth: true,
                dropdownCssClass: 'dropdown-static',
                dropdownPosition: 'below',
                theme: "bootstrap-5",
                width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            });
        });
        });
    // END SEARCH DROPDOWN

</script>
@endpush
