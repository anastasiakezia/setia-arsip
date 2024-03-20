@extends('layouts.admin')

@section('title')
Tambah Laporan Dinas Luar
@endsection

@section('container')
<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-fluid px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="file-text"></i></div>
                            Tambah Laporan Dinas Luar
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary" href="{{ route('surat-keluar') }}">
                            <i class="me-1" data-feather="arrow-left"></i>
                            Kembali ke Semua Laporan Dinas Luar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-fluid px-4">
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
        <form action="{{ route('dinasLuar.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row gx-4">
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header">Form Laporan Dinas Luar</div>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <label for="letter_type" class="col-sm-3 col-form-label">Jenis Surat <b style="color: red">*</b></label>
                                <div class="col-sm-9">
                                    <select name="letter_type" class="form-control" required>
                                        <option value="Laporan Dinas Luar" {{ (old('letter_type') == 'Laporan Dinas Luar')? 'selected':''; }}>Laporan Dinas Luar</option>
                                    </select>
                                </div>
                                @error('letter_type')
                                <div class="invalid-feedback">
                                    {{ $message; }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3 row">
                                <label for="tanggal_laporan" class="col-sm-3 col-form-label">Tanggal Laporan <b style="color: red">*</b></label>
                                <div class="col-sm-9">
                                    <input type="date" id="todayDate" class="form-control @error('tanggal_laporan') is-invalid @enderror" value="{{ old('tanggal_laporan') }}" name="tanggal_laporan" required>
                                    <script>
                                        document.getElementById("todayDate").valueAsDate = new Date();
                                    </script>
                                </div>
                                @error('tanggal_laporan')
                                <div class="invalid-feedback">
                                    {{ $message; }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3 row">
                                <label for="unit_tujuan" class="col-sm-3 col-form-label">Unit<b style="color: red">*</b></label>
                                <div class="col-sm-9">
                                    <select name="unit_sender_internal" id="unit_id" class="form-control  single-select-field" required>
                                        <option value="">Pilih Unit...</option>
                                        @foreach ($departments as $department)
                                        {{-- <option value="{{ $department->id }}" {{ (old('unit_tujuan') == $department->id)? 'selected':''; }}>{{ $department->name }}</option> --}}
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="karyawan_tujuan" class="col-sm-3 col-form-label">Nama Direksi / Karyawan <b style="color: red">*</b></label>
                                <div class="col-sm-9">
                                    <select name="employees_id_destination" id="kepada" class="form-control single-select-field" required>
                                        <option selected disabled>..Nama Direksi / Karyawan...</option>
                                    </select>
                                </div>
                                @error('employees_id_destination')
                                <div class="invalid-feedback">
                                    {{ $message; }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3 row">
                                <label for="surat_tugas" class="col-sm-3 col-form-label">Surat Tugas <b style="color: red">*</b></label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control @error('surat_tugas') is-invalid @enderror" value="{{ old('surat_tugas') }}" name="surat_tugas" required>
                                    <div id="surat_tugas" class="form-text">Ekstensi .pdf</div>
                                </div>
                                @error('surat_tugas')
                                <div class="invalid-feedback">
                                    {{ $message; }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3 row">
                                <label for="laporan_dinas_luar" class="col-sm-3 col-form-label" style="font">Laporan <br> Dinas Luar <b style="color: red">*</b></label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control @error('laporan_dinas_luar') is-invalid @enderror" value="{{ old('laporan_dinas_luar') }}" name="laporan_dinas_luar" required>
                                    <div id="laporan_dinas_luar" class="form-text">Ekstensi .pdf</div>
                                </div>
                                @error('laporan_dinas_luar')
                                <div class="invalid-feedback">
                                    {{ $message; }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3 row">
                                <label for="dokumen_lain" class="col-sm-3 col-form-label">Dokumen <br> Lain-lain</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control @error('dokumen_lain') is-invalid @enderror" value="{{ old('dokumen_lain') }}" name="dokumen_lain" required>
                                    <div id="dokumen_lain" class="form-text">Ekstensi .pdf</div>
                                </div>
                                @error('dokumen_lain')
                                <div class="invalid-feedback">
                                    {{ $message; }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3 row">
                                <label for="letter_file" class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>
@endsection

@push('addon-style')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endpush

@push('addon-script')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function(){
        $('#unit_id').change(function() {
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
                            $("#kepada").empty();
                            $("#kepada").append('<option>...Surat ditujukan ke...</option>');
                            $.each(response, function(id, value) {
                                $("#kepada").append('<option value="' + value.id + '">' + value.nama + ' - '+value.position+'</option>');
                            });
                        } else {
                            $("#kepada").empty();
                        }
                    }
            });
        });
        $('.single-select-field').select2({
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
        });
    });
</script>
@endpush