@extends('layouts.app', [$activePage])

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Kelola Data {{ $activePage }}</h1>
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
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title mt-2">Data {{ $activePage }}</h3>

                    <div class="card-tools">
                        <a href="imunisasi/create" type="button" class="btn btn-success">
                            Tambah Data {{ $activePage }}
                        </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4 mt-2">
                            <input type="date" name="form_date" id="form_date" class="form-control"
                                placeholder="Start date">
                        </div>
                        <div class="col-md-4 mt-2">
                            <input type="date" name="to_date" id="to_date" class="form-control" placeholder="End date">
                        </div>
                        <div class="col-md-4 mt-2">
                            <button class="btn btn-primary" id="filter" name="filter">Filter</button>
                            <button class="btn btn-default" id="reset" name="reset">Reset</button>
                        </div>
                    </div>
                    <table id="table_imunisasi" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Nama</th>
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
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection

@push('js')
    <script>
        $(function() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            load_data_imunisasi();

            function load_data_imunisasi(form_date = '', to_date = '') {
                $('#table_imunisasi').DataTable({
                    pangging: true,
                    autoWidth: true,
                    // responsive: true,
                    scrollX: true,
                    scrollCollapse: true,
                    fixedColumns: {
                        left: 1
                    },
                    processing: true,
                    serverside: true,
                    ajax: {
                        url: '{{ route("imunisasi.index") }}',
                        data: {
                            form_date: form_date,
                            to_date: to_date,
                        }
                    },
                    columns: [{
                            data: 'balita.nama_lengkap',
                            name: 'balita.nama_lengkap',
                            width: '15%'
                        },
                        {
                            data: 'hb0',
                            orderable: false
                        },
                        {
                            data: 'bcg',
                            orderable: false
                        },
                        {
                            data: 'p1',
                            orderable: false
                        },
                        {
                            data: 'dpt1',
                            orderable: false
                        },
                        {
                            data: 'p2',
                            orderable: false
                        },
                        {
                            data: 'pcv1',
                            orderable: false
                        },
                        {
                            data: 'dpt2',
                            orderable: false
                        },
                        {
                            data: 'p3',
                            orderable: false
                        },
                        {
                            data: 'pcv2',
                            orderable: false
                        },
                        {
                            data: 'dpt3',
                            orderable: false
                        },
                        {
                            data: 'p4',
                            orderable: false
                        },
                        {
                            data: 'pcv3',
                            orderable: false
                        },
                        {
                            data: 'ipv',
                            orderable: false
                        },
                        {
                            data: 'campak',
                            orderable: false
                        }
                    ]
                });
            }

            $("#filter").click(function(e) {
                e.preventDefault();

                let form_date = $("#form_date").val();
                let to_date = $("#to_date").val();
                if (form_date != '' && to_date != '') {
                    $('#table_imunisasi').DataTable().destroy();
                    load_data_imunisasi(form_date, to_date);
                } else {
                    Toast.fire({
                        icon: 'warning',
                        title: 'Tanggal wajib disi.'
                    });
                }
            });

            $("#reset").click(function (e) {
                e.preventDefault();

                $("#table_imunisasi").DataTable().destroy();
                load_data();
            });
        });
    </script>
@endpush
