@extends('layouts.admin')
@include('sweetalert::alert')

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
                                        <th>Pengirim</th>
                                        <th>Disposisi</th>                         
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
    <div class="modal fade" id="createModal" role="dialog" aria-labelledby="createModal" aria-hidden="true" style="overflow-auto;">
        <div class="modal-dialog" role="document" style="max-width:64%">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModal">Tambah Disposisi</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('disposisi.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body overflow-auto">
                        <div class="mb-3">
                            <div class="col-md-12">
                                <label for="post_id"><b>Asal Disposisi</b></label>
                                <select name="letter_type" class="form-control" required>
                                    <option value="Surat Masuk" {{ (old('letter_type') == 'Surat Masuk')? 'selected':''; }}>Surat Masuk</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="col-md-12">
                                {{-- <label for="post_id">Tujuan Disposisi</label>
                                <input type="text" name="tujuan_disposisi" class="form-control" placeholder="Masukkan Tujuan Disposisi.." required> --}}
                                <label for="post_id"><b>Asal Unit</b></label>
                                <select class="form-control" name="department_id" id="unit" data-placeholder="pilih unit" required>
                                    <option>== Pilih Unit ==</option>
                                        @foreach ($departments as $department)
                                        <option value="{{ $department->id }}" {{ (old('department_id') == $department->id)? 'selected':''; }}>{{ $department->name }}</option>
                                        @endforeach
                                </select>
                                @error('department_id')
                                <div class="invalid-feedback">
                                    {{ $message; }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="col-md-12" style="margin-bottom:30px">
                                {{-- <label for="post_id">Tujuan Disposisi</label>
                                <input type="text" name="tujuan_disposisi" class="form-control" placeholder="Masukkan Tujuan Disposisi.." required> --}}
                                <label for="post_id"><b>Asal Direksi / Karyawan</b></label>
                                <select class="form-control" name="department_id" id="unit" data-placeholder="pilih unit" required>
                                    <option>== Pilih Direksi / Karyawan ==</option>
                                        @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}" {{ (old('department_id') == $employee->id)? 'selected':''; }}>{{ $employee->employee_name }} - {{ $employee->position }}</option>
                                        @endforeach
                                </select>
                                @error('department_id')
                                <div class="invalid-feedback">
                                    {{ $message; }}
                                </div>
                                @enderror
                            </div>
                        </div><hr style="border-top: 7px solid; width:90%; margin: 0 auto; color:blue">
                        <div class="mb-3">
                            <div class="col-md-12" style="margin-top: 20px">
                                {{-- <label for="post_id">Tujuan Disposisi</label>
                                <input type="text" name="tujuan_disposisi" class="form-control" placeholder="Masukkan Tujuan Disposisi.." required> --}}
                                <label for="post_id"><b>Tujuan Unit</b></label>
                                <select class="form-control" name="id_unit" id="tujuan_disposisi" data-placeholder="pilih unit" required style="width: 100%">
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
                                <select class="form-control" name="department_id" id="direksi_tujuan" data-placeholder="pilih unit" required>
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
                                <label for="post_id"><b>Isi Disposisi</b></label>
                                {{-- <textarea id="disposisi_desc" class="disposisi-desc" cols="50" rows ="4" name="disposisi_desc" placeholder="Masukan isi Disposisi.." class="form-control" required style="border: 1px solid #cccccc; border-radius:5px;"></textarea> --}}
                                <textarea type="text" name="isi_disposisi" class="form-control disposisi-desc" placeholder="Masukkan isi Disposisi.." required style="height: 100px; width:770px;"></textarea>
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
                data: 'letter_date',
                name: 'letter_date',
                width: '10%'
            },
            {
                data: 'letter_no',
                name: 'letter_no'
            },
            {
                data: 'letter_char',
                name: 'letter_char',
                width: '10%'
            },
            {
                data: 'regarding',
                name: 'regarding'
            },
            {
                data: 'sender_name',
                name: 'sender_name'
            },
            {
                data: 'disposisi',
                name: 'disposisi'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searcable: true,
                width: '15%'
            },
        ]
    });
$(document).ready(function(){
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
        // } else {
        //     $("#direksi_tujuan").empty();
        // }
    });
});
    

//    $('#kecamatan').change(function(){
//     var kecID = $(this).val();    
//     if(kecID){
//         $.ajax({
//            type:"GET",
//            url:"getdesa?kecID="+kecID,
//            dataType: 'JSON',
//            success:function(res){               
//             if(res){
//                 $("#direksi_tujuan").empty();
//                 $("#direksi_tujuan").append('<option>---Pilih Desa---</option>');
//                 $.each(res,function(nama,kode){
//                     $("#direksi_tujuan").append('<option value="'+kode+'">'+nama+'</option>');
//                 });
//             }else{
//                $("#direksi_tujuan").empty();
//             }
//            }
//         });
//     }else{
//         $("#direksi_tujuan").empty();
//     }      
//    });
    
    
</script>
@endpush