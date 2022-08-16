@extends('layouts.app', [$activePage])
{{-- @php
    dd(auth()->user()->kader()->nama_lengkap);
@endphp --}}
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        {{-- <li class="breadcrumb-item"><a href="#">Home</a></li> --}}
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                @can('ketua')
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box" style="background-color: Fuchsia; color: white">
                            <div class="inner">
                                <h3>{{ $total_kader }}</h3>

                                <p>Kader</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                @endcan
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $total_balita }}</h3>

                            <p>Balita</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                
            </div>
            <!-- /.row -->
            @can('is_KaderAndIbuBalita')
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Pengumuman</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Kegiatan</th>
                                            <th>Pesan</th>
                                            <th class="w-25">Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($pengumumans as $pengumuman)
                                            <tr>
                                                <td>{{ $pengumuman['nama_kegiatan'] }}</td>
                                                <td>{{ $pengumuman['pesan'] }}</td>
                                                <td>{{ $pengumuman['tanggal'] }}</td>
                                            </tr>
                                        @empty
                                            <td>Belum ada pengumuman</td>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
            @endcan
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
