@extends('layouts.admin')

@section('title')
Tambah Surat Keluar
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
                            Tambah Surat Keluar
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary" href="{{ route('surat-keluar') }}">
                            <i class="me-1" data-feather="arrow-left"></i>
                            Kembali ke Semua Surat keluar
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
        <form action="{{ route('letterout.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row gx-4">
                <div class="col-lg-9">
                    <div class="card mb-4">
                        <div class="card-header">Form Surat Keluar</div>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <label for="letter_type" class="col-sm-3 col-form-label">Jenis Surat <b style="color: red">*</b></label>
                                <div class="col-sm-9">
                                    <select name="letter_type" class="form-control" required>
                                        <option value="Surat Keluar" {{ (old('letter_type') == 'Surat Keluar')? 'selected':''; }}>Surat Keluar</option>
                                    </select>
                                </div>
                                @error('letter_type')
                                <div class="invalid-feedback">
                                    {{ $message; }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3 row">
                                <label for="letterout_date" class="col-sm-3 col-form-label">Tanggal Surat <b style="color: red">*</b></label>
                                <div class="col-sm-9">
                                    <input type="date" id="todayDate" class="form-control @error('letterout_date') is-invalid @enderror" value="{{ old('letterout_date') }}" name="letterout_date" required>
                                    <script>
                                        document.getElementById("todayDate").valueAsDate = new Date();
                                    </script>
                                </div>
                                @error('letterout_date')
                                <div class="invalid-feedback">
                                    {{ $message; }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3 row">
                                <label for="letter_no" class="col-sm-3 col-form-label">No. Surat <b style="color: red">*</b></label>
                                <div class="col-sm-9">
                                    {{-- <input type="text" class="form-control @error('letter_no') is-invalid @enderror" value="{{ old('letter_no') }}" name="letter_no" placeholder="Nomor Surat.." required> --}}
                                    <input type="text" name="letter_no" class="form-control" id="nomor_surat_keluar" placeholder="No Surat...">
                                    <spa class="col-sm-12 col-form-label" id="no_surat_keluar_error" style="color:red; margin-left:5px;"></spa>
                                    <script>
                                        // jQuery
                                        $('#nomor_surat_keluar').on('blur', function() {
                                            var noSuratKeluar=$(this).val();

                                            $.ajax({
                                                type:'GET',
                                                url:'{{url("admin/letterout/surat-keluar/check_no_surat_keluar")}}',
                                                data:{'letter_no':noSuratKeluar},
                                                dataType:'json',
                                                success: function(response) {
                                                    if (response.duplicate) {
                                                        $('#no_surat_keluar_error').text('Nomor surat sudah ada di database');
                                                    }else{
                                                        $('#no_surat_keluar_error').text('Nomor surat tidak ada di database');
                                                    }
                                                }
                                            });
                                        });
                                    </script>
                                </div>
                                @error('letter_no')
                                <div class="invalid-feedback">
                                    {{ $message; }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3 row">
                                <label for="letterout_type" class="col-sm-3 col-form-label">Jenis Surat Keluar <b style="color: red">*</b></label>
                                <div class="col-sm-9">
                                    <select name="letterout_type" class="form-control" id="letterout_type" required>
                                        <option value="">Pilih Jenis Surat Keluar..</option>
                                        <option value="Surat Edaran">Surat Edaran</option>
                                        <option value="Surat Pemberitahuan">Surat Pemberitahuan</option>
                                        <option value="Surat Permohonan">Surat Permohonan</option>
                                        <option value="Surat Keterangan">Surat Keterangan</option>
                                        <option value="Surat Tugas">Surat Tugas</option>
                                        <option value="Surat Rekomendasi">Surat Rekomendasi</option>
                                        <option value="Surat Kuasa">Surat Kuasa</option>
                                        <option value="Pakta Integritas">Pakta Integritas</option>
                                        <option value="Surat Balasan/Tindak Lanjut">Surat Balasan/Tindak Lanjut</option>
                                    </select>
                                </div>
                                @error('letter_char')
                                <div class="invalid-feedback">
                                    {{ $message; }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3 row">
                                <label for="letterout_char" class="col-sm-3 col-form-label">Sifat Surat <b style="color: red">*</b></label>
                                <div class="col-sm-9">
                                    <select name="letterout_char" class="form-control" id="letterout_char" required>
                                        <option value="">Pilih Sifat Surat..</option>
                                        <option value="Biasa">Biasa</option>
                                        <option value="Penting">Penting</option>
                                        <option value="Rahasia">Rahasia</option>
                                        <option value="Segera">Segera</option>
                                    </select>
                                </div>
                                @error('letterout_char')
                                <div class="invalid-feedback">
                                    {{ $message; }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3 row">
                                <label for="letterout_name" class="col-sm-3 col-form-label">Nama Surat <b style="color: red">*</b></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('letterout_name') is-invalid @enderror" value="{{ old('letterout_name') }}" name="letterout_name" placeholder="Nama Surat.." required>
                                </div>
                                @error('letterout_name')
                                <div class="invalid-feedback">
                                    {{ $message; }}
                                </div>
                                @enderror
                            </div>
                            {{-- <div class="mb-3 row">
                                <label for="regarding" class="col-sm-3 col-form-label">Perihal</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('regarding') is-invalid @enderror" value="{{ old('regarding') }}" name="regarding" placeholder="Perihal.." required>
                                </div>
                                @error('regarding')
                                <div class="invalid-feedback">
                                    {{ $message; }}
                                </div>
                                @enderror
                            </div> --}}
                            <div class="mb-3 row">
                                <label for="purpose" class="col-sm-3 col-form-label">Tujuan <b style="color: red">*</b></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('purpose') is-invalid @enderror" value="{{ old('purpose') }}" name="purpose" placeholder="Tujuan..." required>
                                </div>
                                @error('purpose')
                                <div class="invalid-feedback">
                                    {{ $message; }}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3 row">
                                <label for="letter_file" class="col-sm-3 col-form-label">File <b style="color: red">*</b></label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control @error('letter_file') is-invalid @enderror" value="{{ old('letter_file') }}" name="letter_file" required>
                                    <div id="letter_file" class="form-text">Ekstensi .pdf</div>
                                </div>
                                @error('letter_file')
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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.1.1/dist/select2-bootstrap-5-theme.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
@endpush

@push('addon-script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(".selectx").select2({
        theme: "bootstrap-5"
    });
</script>
@endpush