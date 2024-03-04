@extends('layouts.admin')

@section('title')
Ubah Surat
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
                            Ubah Surat
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <button class="btn btn-sm btn-light text-primary" onclick="javascript:window.history.back();">
                            <i 
                            class="me-1" data-feather="arrow-left"></i>
                            Kembali Ke Semua Surat
                        </button>
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
        <form action="{{ route('letter.update', $item->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row gx-4">
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header">Form Surat</div>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <div class="mb-3 row">
                                    <label for="letter_type" class="col-sm-3 col-form-label">Jenis Surat</label>
                                    <div class="col-sm-9">
                                        <select name="letter_type" class="form-control" required>
                                            <option value="Surat Masuk" {{ (old('letter_type') == 'Surat Masuk')? 'selected':''; }}>Surat Masuk</option>
                                        </select>
                                    </div>
                                    @error('letter_type')
                                    <div class="invalid-feedback">
                                        {{ $message; }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3 row">
                                    <label for="letter_date" class="col-sm-3 col-form-label">Tanggal Surat <b style="color: red">*</b></label>
                                    <div class="col-sm-9">
                                        <input type="date" id="todayDate" class="form-control @error('letter_date') is-invalid @enderror" value="{{ $item->letter_date }}" name="letter_date" required>
                                    </div>
                                    @error('letter_date')
                                    <div class="invalid-feedback">
                                        {{ $message; }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3 row">
                                    <label for="letter_no" class="col-sm-3 col-form-label">No. Surat <b style="color: red">*</b></label>
                                    <div class="col-sm-9">
                                        {{-- <input type="text" class="form-control @error('letter_no') is-invalid @enderror" value="{{ old('letter_no') }}" name="letter_no" placeholder="Nomor Surat.." required> --}}
                                        
                                        {{-- <div div id="no_surat_error" style="color:red;"> --}}
                                        <input type="text" name="letter_no" class="form-control" id="nomor_surat" value={{ $item->letter_no }} placeholder="No Surat...">
                                        {{-- </div> --}}
                                        <span class="col-sm-12 col-form-label" id="no_surat_error" style="color:red; margin-left:5px;"></span>
                                           
                                    </div>
                                    @error('letter_no')
                                    <div class="invalid-feedback">
                                        {{ $message; }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3 row">
                                    <label for="letter_char" class="col-sm-3 col-form-label">Sifat Surat <b style="color: red">*</b></label>
                                    <div class="col-sm-9">
                                        <select name="letter_char" class="form-control" id="letter_char" value={{ $item->letter_char }} required>
                                            {{-- <option value="">Pilih Sifat Surat..</option> --}}
                                            <option value="Biasa"{{ (($item->letter_char) == '')? 'selected':''; }}>Biasa</option>
                                            <option value="Penting" {{ (($item->letter_char) == '')? 'selected':''; }}>Penting</option>
                                            <option value="Rahasia"{{ (($item->letter_char) == '')? 'selected':''; }}>Rahasia</option>
                                            <option value="Segera"{{ (($item->letter_char) == '')? 'selected':''; }}>Segera</option>
                                        </select>
                                    </div>
                                    @error('letter_char')
                                    <div class="invalid-feedback">
                                        {{ $message; }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3 row">
                                    <label for="letter_name" class="col-sm-3 col-form-label">Nama Surat <b style="color: red">*</b></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('letter_name') is-invalid @enderror" value="{{ $item->letter_name }}" name="letter_name" placeholder="Nama Surat.." required>
                                    </div>
                                    @error('letter_name')
                                    <div class="invalid-feedback">
                                        {{ $message; }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3 row">
                                    <label for="regarding" class="col-sm-3 col-form-label">Perihal <b style="color: red">*</b></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('regarding') is-invalid @enderror" value="{{ $item->regarding }}" name="regarding" placeholder="Perihal.." required>
                                    </div>
                                    @error('regarding')
                                    <div class="invalid-feedback">
                                        {{ $message; }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3 row">
                                    <label for="sender_type" class="col-sm-3 col-form-label">Jenis Pengirim <b style="color: red">*</b></label>
                                    <div class="col-sm-9">
                                        <select name="sender_type" id="sender_type" class="form-control" required>
                                            {{-- <option value='' selected disabled>Pilih Asal Surat</option> --}}
                                            <option value="Eksternal"{{ (($item->sender_type) == 'Eksternal')? 'selected':''; }}>Eksternal</option>
                                            <option value="Internal"{{ (($item->sender_type) == 'Internal')? 'selected':''; }}>Internal</option>
                                        <select>                                                                      
                                        {{-- <input type="text" class="form-control @error('sender_name') is-invalid @enderror" value="{{ old('sender_name') }}" name="sender_name" placeholder="Isi Pengirim Surat.." required> --}}
                                    </div>
                                    @error('sender_type')
                                    <div class="invalid-feedback">
                                        {{ $message; }}
                                    </div>
                                    @enderror
                                </div>
                                {{-- jika pilih eksternal  --}}
                                @if ($item->sender_type=="Eksternal")
                                    <div class="mb-3 row" id="eksternal_fields">
                                        <label for="sender_name_eksternal" class="col-sm-3 col-form-label">Pengirim Surat <b style="color: red">*</b></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('sender_name') is-invalid @enderror" value="{{ $item->sender_name}}" name="sender_name" placeholder="Nama / Instansi Pengirim..">
                                        </div>
                                        @error('sender_name')
                                        <div class="invalid-feedback">
                                            {{ $message; }}
                                        </div>
                                        @enderror
                                    </div>
                                {{-- END jika pilih eksternal  --}}

                                {{-- jika pilih internal  --}}
                                @else
                                    <div class="mb-3 row" id="pengirim_internal_unit">
                                        <label for="unit_sender_internal" class="col-sm-3 col-form-label">Unit Pengirim<b style="color: red">*</b></label>
                                        <div class="col-sm-9">
                                            <select name="pengirim_unit_internal" id="unit_pengirim" class="form-control">
                                                {{-- <option value="">Pilih Unit Pengirim...</option> --}}
                                                @foreach ($departments as $department)
                                                <option value="{{ $department->id }}" {{ ($item->pengirim_unit_internal == $department->id)? 'selected':''; }}>{{ $department->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('pengirim_unit_internal')
                                        <div class="invalid-feedback">
                                            {{ $message; }}
                                        </div>
                                        @enderror
                                    </div>
                                    {{-- <div class="mb-3 row" id ="pengirim_internal_karyawandireksi"> --}}
                                    <div class="mb-3 row">
                                        <label for="sender_name" class="col-sm-3 col-form-label">Pengirim <b style="color: red">*</b></label>
                                        <div class="col-sm-9">
                                            <select name="sender_name" id="karyawandireksi_pengirim" class="form-control">
                                                <option selected disabled>..Nama Pengirim...</option>
                                                @foreach ($departments as $department)
                                                <option value="{{ $department->id }}" {{ ($item->pengirim_unit_internal == $department->id)? 'selected':''; }}>{{ $item->sender_name }}</option>
                                                @endforeach
                                                
                                                {{-- <option value="{{ $department->id}}" {{ ($item->pengirim_unit_internal == $department->id)? 'selected':''; }}>{{ $item->sender_name }}</option> --}}

                                                <option></option>
                                                
                                            </select>
                                        </div>
                                        @error('sender_name')
                                        <div class="invalid-feedback">
                                            {{ $message; }}
                                        </div>
                                        @enderror
                                    </div>
                                @endif
                                {{-- End jika pilih internal  --}}
                                
                                {{-- <div class="mb-3 row" id="after_jenis_surat_filled">
                                    @error('sender_name')
                                    <div class="invalid-feedback">
                                        {{ $message; }}
                                    </div>
                                    @enderror
                                </div> --}}

                                {{-- Tujuan Pengiriman Surat --}}
                                <div class="mb-3 row">
                                    <label for="unit_tujuan" class="col-sm-3 col-form-label">Unit Tujuan<b style="color: red">*</b></label>
                                    <div class="col-sm-9">
                                        <select name="unit_sender_internal" id="unit_id" class="form-control" required>
                                            <option value="">Pilih Unit Tujuan...</option>
                                            @foreach ($departments as $department)
                                            {{-- <option value="{{ $department->id }}" {{ (old('unit_tujuan') == $department->id)? 'selected':''; }}>{{ $department->name }}</option> --}}
                                            <option value="{{ $department->id }}" {{ ($item->employee->department->id == $department->id)? 'selected':''; }}>{{ $department->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- @error('unit_tujuan')
                                    <div class="invalid-feedback">
                                        {{ $message; }}
                                    </div>
                                    @enderror --}}
                                </div>
                                <div class="mb-3 row">
                                    <label for="karyawan_tujuan" class="col-sm-3 col-form-label">Kepada <b style="color: red">*</b></label>
                                    <div class="col-sm-9">
                                        <select name="employees_id_destination" id="kepada" class="form-control" required>
                                            <option selected disabled>..Surat ditujukan ke...</option>
                                                @foreach ($departments as $department)
                                                <option value="{{ $department->id }}" {{ ($item->employee->department->id == $department->id)? 'selected':''; }}>{{ $item->employee->nama}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                    @error('employees_id_destination')
                                    <div class="invalid-feedback">
                                        {{ $message; }}
                                    </div>
                                    @enderror
                                </div>
                                {{-- END Tujuan Pengiriman Surat --}}

                                {{-- <div class="mb-3 row">
                                    <label for="sender_id" class="col-sm-3 col-form-label">Pengirim</label>
                                    <div class="col-sm-9">
                                        <select name="sender_id" class="form-control" required>
                                            <option value="">Pilih Pengirim..</option>
                                            @foreach ($senders as $sender)
                                            <option value="{{ $sender->id }}" {{ (old('sender_id') == $sender->id)? 'selected':''; }}>{{ $sender->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('sender_id')
                                    <div class="invalid-feedback">
                                        {{ $message; }}
                                    </div>
                                    @enderror
                                </div> --}}
                                <div class="mb-3 row">
                                    <label for="letter_file" class="col-sm-3 col-form-label">File</label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-control @error('letter_file') is-invalid @enderror" value="{{ old('letter_file') }}" name="letter_file">
                                        <div id="letter_file" class="form-text">Ekstensi .pdf | Kosongkan file jika tidak diisi</div>
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
                                    <button type="submit" class="btn btn-primary">Ubah</button>
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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.1.1/dist/select2-bootstrap-5-theme.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
@endpush

@push('addon-script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(".selectx").select2({
        theme: "bootstrap-5"
    });

    //TUJUAN
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
    });

    // $(document).ready(function(){
    $('#unit_pengirim').change(function(){
                var id = $(this).val();
                console.log(id);
                $.ajax({
                    type: "GET",
                    // url: 'http://setia-arsip.test/admin/karyawan-dropdown',
                    url:'{{ route('karyawan.dropdown') }}',
                    data:{id:id},
                    dataType: 'JSON',
                    success: function(response) {
                        console.log(response);
                        if (response) {
                            $("#karyawandireksi_pengirim").empty();
                            $("#karyawandireksi_pengirim").append('<option>...Nama Pengirim...</option>');
                            // $("#karyawandireksi_pengirim").append('<option value="' + value.nama + '">' + value.nama + ' - '+value.position+'</option>');

                            $.each(response, function(id, value) {
                                console.log(response);
                                $("#karyawandireksi_pengirim").append('<option value="' + value.nama + '">' + value.nama + ' - '+value.position+'</option>');
                            });
                        } else {
                            $("#karyawandireksi_pengirim").empty();
                        }
                    }
                });
            });

 // jQuery
$('#nomor_surat').on('blur', function() {
        var noSurat=$(this).val();
        $.ajax({
            type:'GET',
            url:'{{url("admin/letter/check_no_surat")}}',
            data:{'letter_no':noSurat},
            dataType:'json',
            success: function(response) {
                if (response.is_duplicate) {
                    $('#no_surat_error').text('Nomor surat sudah ada di database');
                }else{
                    $('#no_surat_error').text('Nomor surat belum ada di database');
                }
            }
        });
    });

    
    // bagian pengirim surat
    // $(document).ready(function(){
    //     $('#sender_type').change(function() {
    //         var point = $(this).val();
    //         if(point == "Eksternal"){
    //             $('#eksternal_fields').show();
    //             $('#pengirim_internal_unit').hide();
    //             $('#pengirim_internal_karyawandireksi').hide();
    //         }else {
    //             $('#eksternal_fields').hide();
    //             $('#pengirim_internal_unit').show();
    //             $('#pengirim_internal_karyawandireksi').show();
    //             $('#unit_pengirim').change(function(){
    //                 var id = $(this).val();
    //                 $.ajax({
    //                     type: "GET",
    //                     // url: 'http://setia-arsip.test/admin/karyawan-dropdown',
    //                     url:'{{ route('karyawan.dropdown') }}',
    //                     data:{id:id},
    //                     dataType: 'JSON',
    //                     success: function(response) {
    //                         if (response) {
    //                             $("#karyawandireksi_pengirim").empty();
    //                             $("#karyawandireksi_pengirim").append('<option>...Nama Pengirim...</option>');
    //                             $.each(response, function(id, value) {
    //                                 $("#karyawandireksi_pengirim").append('<option value="' + value.nama + '">' + value.nama + ' - '+value.position+'</option>');
    //                             });
    //                         } else {
    //                             $("#karyawandireksi_pengirim").empty();
    //                         }
    //                     }
    //                 });
    //             })
    //         }

    //     });
    // });
    
    // $('#sender_type').change(function() {
    //     var point = $(this).val();
    //     console.log('point');
    //         $('#unit_pengirim').change(function(){
    //             var id = $(this).val();
    //             $.ajax({
    //                 type: "GET",
    //                 // url: 'http://setia-arsip.test/admin/karyawan-dropdown',
    //                 url:'{{ route('karyawan.dropdown') }}',
    //                 data:{id:id},
    //                 dataType: 'JSON',
    //                 success: function(response) {
    //                     if (response) {
    //                         // $("#karyawandireksi_pengirim").empty();
    //                         $("#karyawandireksi_pengirim").append('<option>...Nama Pengirim...</option>');
    //                         $.each(response, function(id, value) {
    //                             $("#karyawandireksi_pengirim").append('<option value="' + value.nama + '">' + value.nama + ' - '+value.position+'</option>');
    //                         });
    //                     } else {
    //                         $("#karyawandireksi_pengirim").empty();
    //                     }
    //                 }
    //             });
    //         })
        

    // });
</script>
@endpush