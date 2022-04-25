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
                    <div class="card">
                        <div class="card-header bg-info">
                            <h3 class="card-title mt-2">Data Balita</h3>
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
                                            <b class="d-block">{{ $data->nama_lengkap }}</b>
                                        </p>
                                        <p class="text-sm">Tanggal Lahir
                                            <b class="d-block">{{ $data->tanggal_lahir }}</b>
                                        </p>
                                        <p class="text-sm">Jenis Kelamin
                                            <b class="d-block">{{ $data->jenis_kelamin }}</b>
                                        </p>
                                        <p class="text-sm">Nama Ayah
                                            <b class="d-block">{{ $data->ibuBalita->nama_ayah }}</b>
                                        </p>
                                        <p class="text-sm">Nama Ibu
                                            <b class="d-block">{{ $data->ibuBalita->nama_ibu }}</b>
                                        </p>
                                        <p class="text-sm">Alamat
                                            <b class="d-block">{{ $data->ibuBalita->alamat }}</b>
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
                    <!-- card imunisasi -->
                    <div class="card">
                        <div class="card-header bg-info">
                            <h3 class="card-title mt-2">Imunisasi</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table class="table table-bordered table-head-fixed text-nowrap">
                                <thead class="text-center">
                                    <th>HB0</th>
                                    <th>BCG</th>
                                    <th>P1</th>
                                    <th>DPT1</th>
                                    <th>P2</th>
                                    <th>PCV1</th>
                                    <th>DPT2</th>
                                    <th>P3</th>
                                    <th>PCV2</th>
                                    <th>DPT3</th>
                                    <th>P4</th>
                                    <th>PCV3</th>
                                    <th>IPV</th>
                                    <th>CAMPAK</th>
                                </thead>
                                <tbody>
                                    @foreach ($imunisasis as $imunisasi)
                                        <tr>
                                            <td>{{ $imunisasi->hb0 }}</td>
                                            <td>{{ $imunisasi->bcg }}</td>
                                            <td>{{ $imunisasi->p1 }}</td>
                                            <td>{{ $imunisasi->dpt1 }}</td>
                                            <td>{{ $imunisasi->p2 }}</td>
                                            <td>{{ $imunisasi->pcv1 }}</td>
                                            <td>{{ $imunisasi->dpt2 }}</td>
                                            <td>{{ $imunisasi->p3 }}</td>
                                            <td>{{ $imunisasi->pcv2 }}</td>
                                            <td>{{ $imunisasi->dpt3 }}</td>
                                            <td>{{ $imunisasi->p4 }}</td>
                                            <td>{{ $imunisasi->pcv3 }}</td>
                                            <td>{{ $imunisasi->ipv }}</td>
                                            <td>{{ $imunisasi->campak }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- card penimbangan -->
                    <div class="card">
                        <div class="card-header bg-info">
                            <h3 class="card-title mt-2">Penimbangan</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table class="table table-bordered table-head-fixed text-nowrap">
                                <thead>
                                    <th>Jan</th>
                                    <th>Feb</th>
                                    <th>Mar</th>
                                    <th>Apr</th>
                                    <th>Mei</th>
                                    <th>Jun</th>
                                    <th>Jul</th>
                                    <th>Ags</th>
                                    <th>Sep</th>
                                    <th>Ott</th>
                                    <th>Nov</th>
                                    <th>Des</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        @foreach ($penimbangans as $penimbangan)
                                            <td>{{ $penimbangan->bulan == 'Januari' ? $penimbangan->bb : '' }}</td>
                                            <td>{{ $penimbangan->bulan == 'Februari' ? $penimbangan->bb : '' }}</td>
                                            <td>{{ $penimbangan->bulan == 'Maret' ? $penimbangan->bb : '' }}</td>
                                            <td>{{ $penimbangan->bulan == 'April' ? $penimbangan->bb : '' }}</td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- card timbangan dan vitamin -->
                    <div class="card">
                        <div class="card-header bg-info">
                            <h3 class="card-title mt-2">Pemberian Vitamin</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table class="table table-bordered table-head-fixed text-nowrap">
                                <thead class="text-center">
                                    <th colspan="2">Vitamin</th>
                                    <th class="align-middle" rowspan="2">BB</th>
                                    <th class="align-middle" rowspan="2">TB</th>
                                    <th class="align-middle" rowspan="2">Aksi Eksklusif</th>
                                    <th class="align-middle" rowspan="2">IMD</th>
                                    <tr>
                                        <th>Merah</th>
                                        <th>Biru</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($timbangan_dan_vitamins as $vit)
                                        <tr>
                                            @if ($vit->vitamin_a == 'Merah')
                                                <td>{{ $vit->vitamin_a }}</td>
                                                <td>-</td>
                                            @else
                                                <td>-</td>
                                                <td>{{ $vit->vitamin_a }}</td>
                                            @endif
                                            <td>{{ $vit->bb }}</td>
                                            <td>{{ $vit->tb }}</td>
                                            <td>{{ $vit->aksi_eksklusif == null ? '-' : $vit->aksi_eksklusif }}</td>
                                            <td>{{ $vit->imd == null ? '-' : $vit->imd }}</td>
                                        </tr>
                                    @endforeach
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
