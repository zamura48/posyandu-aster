{{-- {{ dd($penimbangans) }} --}}
@extends('layouts.app', [$activePage])

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> Detail {{ $activePage }} - {{ $data->nama_lengkap }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('balita.index') }}">Kelola Data Balita</a></li>
                        <li class="breadcrumb-item active">Detail {{ $activePage }}</li>
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
                    @can('kader')
                        <a href="{{ route('balita.index') }}" class="btn btn-info btn-block text-white"><i
                                class="fa fa-angle-left"></i> Kembali</a>
                    @endcan
                    @can('ibu_balita')
                        <a href="{{ route('anak.index') }}" class="btn btn-info btn-block text-white"><i
                                class="fa fa-angle-left"></i> Kembali</a>
                    @endcan

                    {{-- CARD UNTUK MENAMPILKAN DATA DIRI BALITA --}}
                    <div class="card mt-3">
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
                                            <b class="d-block">{{ $data->ortu_balita->nama_suami }}</b>
                                        </p>
                                        <p class="text-sm">Nama Ibu
                                            <b class="d-block">{{ $data->ortu_balita->nama_istri }}</b>
                                        </p>
                                        <p class="text-sm">Alamat
                                            <b class="d-block">{{ $data->ortu_balita->alamat }}</b>
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
                                    @forelse ($imunisasis as $imunisasi)
                                        <tr>
                                            <td>{{ str_replace(',', '', $imunisasi->hb0) }}</td>
                                            <td>{{ str_replace(',', '', $imunisasi->bcg) }}</td>
                                            <td>{{ str_replace(',', '', $imunisasi->p1) }}</td>
                                            <td>{{ str_replace(',', '', $imunisasi->dpt1) }}</td>
                                            <td>{{ str_replace(',', '', $imunisasi->p2) }}</td>
                                            <td>{{ str_replace(',', '', $imunisasi->pcv1) }}</td>
                                            <td>{{ str_replace(',', '', $imunisasi->dpt2) }}</td>
                                            <td>{{ str_replace(',', '', $imunisasi->p3) }}</td>
                                            <td>{{ str_replace(',', '', $imunisasi->pcv2) }}</td>
                                            <td>{{ str_replace(',', '', $imunisasi->dpt3) }}</td>
                                            <td>{{ str_replace(',', '', $imunisasi->p4) }}</td>
                                            <td>{{ str_replace(',', '', $imunisasi->pcv3) }}</td>
                                            <td>{{ str_replace(',', '', $imunisasi->ipv) }}</td>
                                            <td>{{ str_replace(',', '', $imunisasi->campak) }}</td>
                                        </tr>
                                    @empty
                                        <td colspan="12" class="text-center">Belum Ada Data Imunisasi</td>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    {{-- CARD UNTUK MENAMPILKAN DATA PENIMBANGAN --}}
                    <div class="card">
                        <div class="card-header bg-info">
                            <h3 class="card-title mt-2">Penimbangan</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <span>BB = Berat Badan <br> TB = Tinggi Badan</span>
                            <table class="table table-bordered table-head-fixed text-nowrap mt-3">
                                <thead>
                                    <tr class="text-center">
                                        <th rowspan="2" class="align-middle">Tahun</th>
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
                                    </tr>
                                    <tr>
                                        @for ($i = 0; $i < 12; $i++)
                                            <th>BB/TB</th>
                                        @endfor
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($penimbangans as $penimbangan)
                                        <tr>
                                            <?php $tahun = date_create($penimbangan->tanggal_input); ?>
                                            <td class="text-center">{{ date_format($tahun, 'Y') }}</td>
                                            <td>{{ str_replace(',', '', $penimbangan->bulan_jan) }}</td>
                                            <td>{{ str_replace(',', '', $penimbangan->bulan_feb) }}</td>
                                            <td>{{ str_replace(',', '', $penimbangan->bulan_mar) }}</td>
                                            <td>{{ str_replace(',', '', $penimbangan->bulan_apr) }}</td>
                                            <td>{{ str_replace(',', '', $penimbangan->bulan_mei) }}</td>
                                            <td>{{ str_replace(',', '', $penimbangan->bulan_jun) }}</td>
                                            <td>{{ str_replace(',', '', $penimbangan->bulan_jul) }}</td>
                                            <td>{{ str_replace(',', '', $penimbangan->bulan_ags) }}</td>
                                            <td>{{ str_replace(',', '', $penimbangan->bulan_sep) }}</td>
                                            <td>{{ str_replace(',', '', $penimbangan->bulan_okt) }}</td>
                                            <td>{{ str_replace(',', '', $penimbangan->bulan_nov) }}</td>
                                            <td>{{ str_replace(',', '', $penimbangan->bulan_des) }}</td>
                                        </tr>
                                    @empty
                                        <td colspan="12" class="text-center">Belum Ada Data Penimbangan</td>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    {{-- CARD UNTUK MENAMPILKAN DATA TIMBANGAN DAN VITAMIN --}}
                    <div class="card">
                        <div class="card-header bg-info">
                            <h3 class="card-title mt-2">Pemberian Vitamin</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <span>
                                BB = Berat Badan <br>
                                TB = Tinggi Badan <br>
                                IMD = Inisiatif Menyusui Dini
                            </span>
                            <table class="table table-bordered table-head-fixed text-nowrap mt-3">
                                <thead class="text-center">
                                    <th colspan="2">Vitamin</th>
                                    <th class="align-middle" rowspan="2">BB</th>
                                    <th class="align-middle" rowspan="2">TB</th>
                                    <th class="align-middle" rowspan="2">Aksi Eksklusif</th>
                                    <th class="align-middle" rowspan="2">IMD</th>
                                    <th class="align-middle" rowspan="2">Tanggal</th>
                                    <tr>
                                        <th>Merah</th>
                                        <th>Biru</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @forelse ($timbangan_dan_vitamins as $vit)
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
                                            <td>{{ $vit->tanggal_input }}</td>
                                        </tr>
                                    @empty
                                        <td colspan="12" class="text-center">Belum Ada Data Pemberian Vitamin</td>
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
