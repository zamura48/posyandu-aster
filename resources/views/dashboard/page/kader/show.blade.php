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
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Kelola Data {{ $activePage }}</li>
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
                    {{-- TOMBOL UNTUK KEMBALI KEHALAMAN BALITA --}}
                    <a href="{{ route('kader.index') }}" class="btn btn-info btn-block text-white"><i
                            class="fa fa-angle-left"></i> Kembali</a>

                    {{-- CARD UNTUK MENAMPILKAN DATA DIRI BALITA --}}
                    <div class="card mt-3">
                        <div class="card-header bg-info">
                            <h3 class="card-title mt-2">Data Kader</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="text-muted">
                                        <p class="text-sm">NIK
                                            <b class="d-block">{{ $data->nik }}</b>
                                        </p>
                                        <p class="text-sm">Nama
                                            <b class="d-block">{{ $data->nama_istri }}</b>
                                        </p>
                                        <p class="text-sm">Tanggal Lahir
                                            <b class="d-block">{{ $data->tanggal_lahir }}</b>
                                        </p>
                                        <p class="text-sm">Jenis Kelamin
                                            <b class="d-block">{{ $data->nomor_telepon }}</b>
                                        </p>
                                        <p class="text-sm">Alamat
                                            <b class="d-block">{{ $data->alamat }}</b>
                                        </p>
                                        <p class="text-sm">Role
                                            <b class="d-block">{{ $data->user->role }}</b>
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
                    {{-- CARD UNTUK MENAMPILKAN DATA IMUNISASI --}}
                    <div class="card">
                        <div class="card-header bg-info">
                            <h3 class="card-title mt-2">Ibu Hamil</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table class="table table-bordered table-head-fixed text-nowrap">
                                <thead class="text-center">
                                    <th>NIK</th>
                                    <th>Nama Ibu Hamil</th>
                                    <th>Nama Suami</th>
                                    <th>Umur Kehamilan Saat Daftar</th>
                                    <th>Nomor Telepon</th>
                                </thead>
                                <tbody>
                                    @forelse ($ibu_hamils as $ibu_hamil)
                                        <tr>
                                            <td>{{ $ibu_hamil->ibu_hamil->nik }}</td>
                                            <td>{{ $ibu_hamil->ibu_hamil->nama_istri }}</td>
                                            <td>{{ $ibu_hamil->ibu_hamil->nama_suami }}</td>
                                            <td>{{ $ibu_hamil->umur_kehamilan }}</td>
                                            <td>{{ $ibu_hamil->ibu_hamil->nomor_telepon }}</td>
                                        </tr>
                                    @empty
                                        <td colspan="12" class="text-center">Belum Ada Data Ibu Hamil</td>
                                    @endforelse
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
