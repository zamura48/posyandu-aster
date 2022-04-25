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
            $('#table_imunisasi').DataTable({
                pangging: true,
                autoWidth: true,
                // responsive: true,
                scrollX: true,
                scrollCollapse: true,
                fixedColumns: {
                    left: 1
                },
                ajax: 'imunisasi',
                columns: [{
                        data: 'balita.nama_lengkap',
                        name: 'balita.nama_lengkap',
                        width: '15%'
                    },
                    {
                        data: 'hb0',
                        orderable: false,
                        render: function(data) {
                            if (data !== null) {
                                let date = new Date(data);
                                return date.getDate() + "-" + date.getMonth() + "-" + date
                                    .getFullYear();
                            } else {
                                return '';
                            }
                        }
                    },
                    {
                        data: 'bcg',
                        orderable: false,
                        render: function(data) {
                            if (data !== null) {
                                let date = new Date(data);
                                return date.getDate() + "-" + date.getMonth() + "-" + date
                                    .getFullYear();
                            } else {
                                return '';
                            }
                        }
                    },
                    {
                        data: 'p1',
                        orderable: false,
                        render: function(data) {
                            if (data !== null) {
                                let date = new Date(data);
                                return date.getDate() + "-" + date.getMonth() + "-" + date
                                    .getFullYear();
                            } else {
                                return '';
                            }
                        }
                    },
                    {
                        data: 'dpt1',
                        orderable: false,
                        render: function(data) {
                            if (data !== null) {
                                let date = new Date(data);
                                return date.getDate() + "-" + date.getMonth() + "-" + date
                                    .getFullYear();
                            } else {
                                return '';
                            }
                        }
                    },
                    {
                        data: 'p2',
                        orderable: false,
                        render: function(data) {
                            if (data !== null) {
                                let date = new Date(data);
                                return date.getDate() + "-" + date.getMonth() + "-" + date
                                    .getFullYear();
                            } else {
                                return '';
                            }
                        }
                    },
                    {
                        data: 'pcv1',
                        orderable: false,
                        render: function(data) {
                            if (data !== null) {
                                let date = new Date(data);
                                return date.getDate() + "-" + date.getMonth() + "-" + date
                                    .getFullYear();
                            } else {
                                return '';
                            }
                        }
                    },
                    {
                        data: 'dpt2',
                        orderable: false,
                        render: function(data) {
                            if (data !== null) {
                                let date = new Date(data);
                                return date.getDate() + "-" + date.getMonth() + "-" + date
                                    .getFullYear();
                            } else {
                                return '';
                            }
                        }
                    },
                    {
                        data: 'p3',
                        orderable: false,
                        render: function(data) {
                            if (data !== null) {
                                let date = new Date(data);
                                return date.getDate() + "-" + date.getMonth() + "-" + date
                                    .getFullYear();
                            } else {
                                return '';
                            }
                        }
                    },
                    {
                        data: 'pcv2',
                        orderable: false,
                        render: function(data) {
                            if (data !== null) {
                                let date = new Date(data);
                                return date.getDate() + "-" + date.getMonth() + "-" + date
                                    .getFullYear();
                            } else {
                                return '';
                            }
                        }
                    },
                    {
                        data: 'dpt3',
                        orderable: false,
                        render: function(data) {
                            if (data !== null) {
                                let date = new Date(data);
                                return date.getDate() + "-" + date.getMonth() + "-" + date
                                    .getFullYear();
                            } else {
                                return '';
                            }
                        }
                    },
                    {
                        data: 'p4',
                        orderable: false,
                        render: function(data) {
                            if (data !== null) {
                                let date = new Date(data);
                                return date.getDate() + "-" + date.getMonth() + "-" + date
                                    .getFullYear();
                            } else {
                                return '';
                            }
                        }
                    },
                    {
                        data: 'pcv3',
                        orderable: false,
                        render: function(data) {
                            if (data !== null) {
                                let date = new Date(data);
                                return date.getDate() + "-" + date.getMonth() + "-" + date
                                    .getFullYear();
                            } else {
                                return '';
                            }
                        }
                    },
                    {
                        data: 'ipv',
                        orderable: false,
                        render: function(data) {
                            if (data !== null) {
                                let date = new Date(data);
                                return date.getDate() + "-" + date.getMonth() + "-" + date
                                    .getFullYear();
                            } else {
                                return '';
                            }
                        }
                    },
                    {
                        data: 'campak',
                        orderable: false,
                        render: function(data) {
                            if (data !== null) {
                                let date = new Date(data);
                                return date.getDate() + "-" + date.getMonth() + "-" + date
                                    .getFullYear();
                            } else {
                                return '';
                            }
                        }
                    }
                ]
            });
        });
    </script>
@endpush
