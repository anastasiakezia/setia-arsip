@extends('layouts.admin')

@section('title')
Detail Surat
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
                            Detail Surat
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <button class="btn btn-sm btn-light text-primary" onclick="javascript:window.history.back();">
                            <i class="me-1" data-feather="arrow-left"></i>
                            Kembali Ke Semua Surat
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-fluid px-4">
        <div class="row gx-4">
            <div class="col-lg-7">
                <div class="card mb-4">
                    <div class="card-header">Detail Surat</div>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <table class="table">
                                <tbody>              
                                    <tr>
                                        <th>Jenis Surat</th>
                                        <td>{{ $item->letter_type }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Surat</th>
                                        <td>{{ Carbon\Carbon::parse($item->letter_date)->translatedFormat('l, d F Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nomor Surat</th>
                                        <td>{{ $item->letter_no }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Surat</th>
                                        <td>{{ $item->letter_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Sifat Surat</th>
                                        <td>{{ $item->letter_char}}</td>
                                    </tr>
                                    <tr>
                                        <th>Asal Pengirim</th>
                                        <td>{{ $item->sender_type}}</td>
                                    </tr>
                                    <tr>
                                        <th>Perihal</th>
                                        <td>{{ $item->regarding }}</td>
                                    </tr>
                                    <tr>
                                        @if ($item->PengirimUnitInternal)
                                            @if($item->sender_type == "Internal")
                                            <th>Unit Pengirim</th>
                                            <td>{{ $item->PengirimUnitInternal->name }}</td>
                                            @elseif($item->sender_type == "Eksternal")
                                            {{-- <th style="display: none">Unit Pengirim</th> --}}
                                            {{-- <td>{{'-'}}</td> --}}
                                            @endif                                           
                                        @else
                                        <th>Unit Pengirim</th>
                                        <td>{{'-'}}</td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <th>Pengirim Surat</th>
                                        <td>{{ $item->sender_name}}</td>
                                    </tr>
                                    <tr>
                                        <th>Unit Tujuan</th>
                                        <td>{{ $item->employee->department->name}}</td>
                                    </tr>
                                    <tr>
                                        <th>Direksi / Karyawan Tujuan</th>
                                        <td>{{ $item->employee->nama}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card mb-4">
                    <div class="card-header">
                        File Surat -
                        <a href="{{ route('download-surat', $item->id) }}" class="btn btn-sm btn-primary">
                            <i class="fa fa-download" aria-hidden="true"></i> &nbsp; Download Surat
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <iframe src="{{ Storage::url($item->letter_file) }}" width="500" height="375" type="application/pdf">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection