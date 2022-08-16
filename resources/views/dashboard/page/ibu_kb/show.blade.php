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
                        <li class="breadcrumb-item"><a href="{{ route('ibu_kb.index') }}">Kelola Data
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
                    <a href="{{ route('ibu_kb.index') }}" class="btn btn-info btn-block text-white"><i
                            class="fa fa-angle-left"></i> Kembali</a>

                    {{-- CARD UNTUK MENAMPILKAN DATA DIRI IBU HAMIL --}}
                    <div class="card mt-3">
                        <div class="card-header bg-info">
                            <h3 class="card-title mt-2">Data Ibu KB</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="text-muted">
                                        <p class="text-sm">NIK
                                            <b class="d-block">{{ $ibu_kb->nik }}</b>
                                        </p>
                                        <p class="text-sm">Nama Ibu KB
                                            <b class="d-block">{{ $ibu_kb->nama_istri }}</b>
                                        </p>
                                        <p class="text-sm">Tanggal Lahir
                                            <b class="d-block">{{ $ibu_kb->tanggal_lahir }}</b>
                                        </p>
                                        <p class="text-sm">Pekerjaan Istri
                                            <b class="d-block">{{ $ibu_kb->pekerjaan_istri }}</b>
                                        </p>
                                        <p class="text-sm">Nama Suami
                                            <b class="d-block">{{ $ibu_kb->nama_suami }}</b>
                                        </p>
                                        <p class="text-sm">Pekerjaan Suami
                                            <b class="d-block">{{ $ibu_kb->pekerjaan_suami }}</b>
                                        </p>
                                        <p class="text-sm">Nomor Telepon
                                            <b class="d-block">{{ $ibu_kb->nomor_telepon }}</b>
                                        </p>
                                        <p class="text-sm">Alamat
                                            <b class="d-block">{{ $ibu_kb->alamat }}</b>
                                        </p>
                                        <p class="text-sm">Jumlah Anak
                                            <b class="d-block">{{ $ibu_kb->jumlah_anak }}</b>
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
                            <table id="table_riwayat_ibukb" class="table table-bordered table-head-fixed text-nowrap">
                                <thead class="text-center">
                                    <th>Riwayat KB</th>
                                    <th>Suntik Awal</th>
                                    <th>Suntik Akhir</th>
                                    <th>Hasil Pemeriksaan</th>
                                    <th>Tanggal Pemeriksaan</th>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($riwayat_ibu_kbs as $rik)
                                        <tr>
                                            <td>{{ $rik->riwayat_kb }}</td>
                                            <td>{{ $rik->suntik_awal }}</td>
                                            <td>{{ $rik->suntik_akhir }}</td>
                                            <td>{{ $rik->hasil_pemeriksaan }}</td>
                                            <td>{{ $rik->created_at }}</td>
                                        </tr>
                                    @endforeach --}}
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
            $("#table_riwayat_ibukb").DataTable({
                scrollX: true,
                scrollCollapse: true,
                ajax: {
                    url: {{ $ibu_kb->id }},
                },
                columns: [{
                        data: 'riwayat_kb',
                        name: 'riwayat_kb',
                        width: '13%'
                    },
                    {
                        data: 'suntik_awal',
                        name: 'suntik_awal',
                        width: '15%'
                    },
                    {
                        data: 'suntik_akhir',
                        name: 'suntik_akhir',
                        width: '15%'
                    },
                    {
                        data: 'hasil_pemeriksaan',
                        orderable: false
                    },
                    {
                        data: 'suntik_awal'
                    }
                ]
            });
        })
    </script>
@endpush
