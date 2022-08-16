@extends('layouts.app', [$activePage])

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> {{ $activePage }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('ibu_hamil.index') }}">Kelola Data
                                {{ $activePage }} </a></li>
                        <li class="breadcrumb-item active">Detail Data {{ $activePage }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    {{-- TOMBOL UNTUK KEMBALI KEHALAMAN IBU HAMIL --}}
                    <a href="{{ route('ibu_hamil.index') }}" class="btn btn-info btn-block text-white"><i
                            class="fa fa-angle-left"></i> Kembali</a>

                    {{-- CARD UNTUK MENAMPILKAN DATA DIRI IBU HAMIL --}}
                    <div class="card mt-3">
                        <div class="card-header bg-info">
                            <h3 class="card-title mt-2">Data Ibu Hamil</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="text-muted">
                                        <p class="text-sm">NIK
                                            <b class="d-block">{{ $ibu_hamil->nik }}</b>
                                        </p>
                                        <p class="text-sm">Nama Ibu Hamil
                                            <b class="d-block">{{ $ibu_hamil->nama_istri }}</b>
                                        </p>
                                        <p class="text-sm">Tanggal Lahir
                                            <b class="d-block">{{ $ibu_hamil->tanggal_lahir }}</b>
                                        </p>
                                        <p class="text-sm">Pekerjaan Istri
                                            <b class="d-block">{{ $ibu_hamil->pekerjaan_istri }}</b>
                                        </p>
                                        <p class="text-sm">Nama Suami
                                            <b class="d-block">{{ $ibu_hamil->nama_suami }}</b>
                                        </p>
                                        <p class="text-sm">Pekerjaan Suami
                                            <b class="d-block">{{ $ibu_hamil->pekerjaan_suami }}</b>
                                        </p>
                                        <p class="text-sm">Nomor Telepon
                                            <b class="d-block">{{ $ibu_hamil->nomor_telepon }}</b>
                                        </p>
                                        <p class="text-sm">Alamat
                                            <b class="d-block">{{ $ibu_hamil->alamat }}</b>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-10">
                    {{-- CARD UNTUK MENAMPILKAN DATA RIWAYAT CEK IBU HAMIL --}}
                    <div class="card">
                        <div class="card-header bg-info">
                            <h3 class="card-title mt-2">Riwayat Pemeriksaan Ibu Hamil</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="table_detail_ibuhamil" class="table table-bordered table-head-fixed text-nowrap">
                                <thead class="text-center">
                                    <th>Umur Kehamilan</th>
                                    <th>Tablet Tambah Darah</th>
                                    <th>Hasil Pemeriksaan</th>
                                    <th>Keterangan</th>
                                    <th>Tanggal Pemeriksaan</th>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection

@push('js')
    <script>
        $(function() {
            $("#table_detail_ibuhamil").DataTable({
                scrollX: true,
                scrollCollapse: true,
                ajax: {
                    url: {{ $ibu_hamil->id }},
                },
                columns: [{
                        data: 'umur_kehamilan',
                        name: 'umur_kehamilan',
                        width: '13%'
                    },
                    {
                        data: 'pemberian_tablet_tambah_darah',
                        name: 'pemberian_tablet_tambah_darah',
                        width: '25%'
                    },
                    {
                        data: 'hasil_pemeriksaan',
                        name: 'hasil_pemeriksaan',
                        width: '20%',
                        orderable: false
                    },
                    {
                        data: 'keterangan',
                        orderable: false
                    },
                    {
                        data: 'tanggal_pemeriksaan'
                    }
                ]
            });
        })
    </script>
@endpush
