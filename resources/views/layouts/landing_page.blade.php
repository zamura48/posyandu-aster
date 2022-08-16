<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Posyandu Aster</title>
    <link rel="stylesheet" href="{{ asset('assets') }}/css/bootstrap.min.css" />
    <script src="{{ asset('assets') }}/js/bootstrap.bundle.min.js"></script>

    <!-- SweetAlert2 -->
    <link rel="stylesheet"
        href="{{ asset('vendor/AdminLTE-3.1.0') }}/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- SweetAlert2 -->
    <script src="{{ asset('vendor/AdminLTE-3.1.0') }}/plugins/sweetalert2/sweetalert2.min.js"></script>
</head>
<style>
    body {
        background-image: linear-gradient(to bottom right, #be93c5, #7bc6cc);
        color: white;
        font-family: "Courier New", Courier, monospace;
    }

    .navbar-toggler:focus {
        box-shadow: none;
    }

    .form-control:focus {
        border-color: transparent;
        box-shadow: none;
    }

    a {
        color: white;
        text-decoration-line: none;
    }

    a:hover {
        color: black;
    }

    main {
        background: rgba(0, 0, 0, 0.3);
    }
</style>

<body class="d-flex flex-column min-vh-100">

    <!-- navbar -->
    <div class="container p-4">
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: transparent">
            <div class="container">
                <a class="navbar-brand fw-bold" href="#" onclick="home()">
                    <img src="{{ asset('disk/logo_posyandu.png') }}" width="30" height="30" alt="Posyandu Logo">
                    Posyandu Aster</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav d-flex m-auto">
                        <li class="nav-item">
                            <a type="button" class="nav-link active" onclick="home()">Home</a>
                        </li>
                        <!-- end li -->
                    </ul>
                    <!-- end ul -->
                </div>
                <!-- end collapse -->
            </div>
            <!-- end container -->
        </nav>
        <!-- end nav -->
    </div>
    <!-- end container -->

    <!-- container -->
    <div class="container">
        <div class="row justify-content-center m-4">
            <div class="col-md-6">
                <div class="card text-center shadow rounded-3"
                    style="background-color: transparent; border-color: transparent;">
                    <div class="card-body m-3">
                        <label for="" class="form-label">Masukkan NIK Balita</label>
                        <input type="text" class="form-control" id="cari" name="cari">
                        <button id="btnkosongkan" class="btn btn-info text-white mt-2">Kosongkan</button>
                        <button id="btncari" class="btn btn-primary mt-2">Cari</button>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->

    <main class="m-5 mt-1 text-light shadow" id="my-project" hidden>
        <div class="row m-3">
            <div class="col-md-5 mt-2">
                <p class="fs-2 fw-bold mt-3 text-center">Data Balita</p>
                <p>NIK: <span id="nik"></span></p>
                <p>Nama: <span id="nama"></span></p>
                <p>Tanggal Lahir: <span id="tanggal_lahir"></span></p>
                <p>Jenis Kelamin: <span id="jenis_kelamin"></span></p>
            </div>
            <!-- end col -->
            <div class="col-md-7 mt-2">
                <p class="fs-2 fw-bold mt-3 text-center ">Grafik Pertumbuhan</p>
                <div class="text-center">
                    <div class="row">

                        <div class="col-md-4">
                            <button class="btn" style="background-color: rgba(255,253,59,0.5)"></button>
                            <p>balita kurang gizi</p>
                        </div>
                        <div class="col-md-4">
                            <button class="btn" style="background-color: rgba(198,253,0,0.5)"></button>
                            <p>ideal</p>
                        </div>
                        <div class="col-md-4">
                            <button class="btn" style="background-color: rgba(174,235,0,0.5)"></button>
                            <p>balita kelebihan gizi</p>
                        </div>
                    </div>
                </div>
                <div id="body_balita_chart">
                    <div id="balita_chart">
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </main>
    <!-- end main -->

    <footer class="mt-auto text-dark-50 text-center">
        <p>Created by Zamura</p>
    </footer>
    <!-- end footer -->

    {{-- Highchart --}}
    <script src="{{ asset('vendor/AdminLTE-3.1.0/plugins/highchart/highcharts.js') }}"></script>
    <!-- jQuery -->
    <script src="{{ asset('vendor/AdminLTE-3.1.0') }}/plugins/jquery/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#btncari').click(function(e) {
                e.preventDefault();
                remove_balita_chart();
                $("#my-project").attr('hidden', true);
                let nik = $("#cari").val();

                if (nik == null || nik == "") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'NIK harus diisi.',
                        showConfirmButton: false,
                        timer: 1800
                    });
                } else {
                    $.get("anak/?nik=" + nik, function(data, textStatus, jqXHR) {
                        $("#nik").text(data['balita'].nik);
                        $("#nama").text(data['balita'].nama_lengkap);
                        $("#jenis_kelamin").text(data['balita'].jenis_kelamin);
                        $("#tanggal_lahir").text(data['balita'].tanggal_lahir);
                        $("#my-project").removeAttr('hidden');
                        highchart(data['balita'].id);
                    });
                }

            });

            $("#btnkosongkan").click(function(e) {
                e.preventDefault();
                remove_balita_chart();
                $("#my-project").attr('hidden', true);
            });
        });

        function remove_balita_chart() {
            $("#balita_chart").remove();
            $("#body_balita_chart").append('<div id="balita_chart"></div>');
            $("#nik").text('');
            $("#nama").text('');
            $("#jenis_kelamin").text('');
            $("#tanggal_lahir").text('');
        }

        function highchart(id) {
            let ideal = [];

            $.get("get_penimbangan/" + id, function(data, textStatus, jqXHR) {
                if (data.jenis_kelamin == 'Laki-Laki') {
                    if (data.umur <= 1) {
                        ideal = [1.6, 5.5];
                    } else if (data.umur >= 2 || data.umur <= 3) {
                        ideal = [12.2, 14.3];
                    } else if (data.umur >= 3 || data.umur <= 4) {
                        ideal = [14.3, 16.3];
                    } else if (data.umur >= 4 || data.umur <= 5) {
                        ideal = [16.3, 18.3];
                    } else if (data.umur >= 1 || data.umur <= 2) {
                        ideal = [9.6, 14.3];
                    }
                } else if (data.jenis_kelamin == 'Perempuan') {
                    if (data.umur <= 2) {
                        ideal = [1.3, 4.5];
                    } else if (data.umur >= 2 || data.umur <= 3) {
                        ideal = [11.5, 13.9];
                    } else if (data.umur >= 3 || data.umur <= 4) {
                        ideal = [13.9, 16.1];
                    } else if (data.umur >= 4 || data.umur <= 5) {
                        ideal = [16.1, 18.2];
                    } else if (data.umur >= 1 || data.umur <= 2) {
                        ideal = [8.3, 11.5];
                    }
                }

                if (Array.isArray(data) && data.length === 0) {
                    console.log('berhasil');
                    $('#balita_chart').append(
                        '<p id="ket" class="fs-1 text-center text-lg">Belum ada data penimbangan</p>');
                } else {
                    Highcharts.chart('balita_chart', {
                        title: {
                            text: 'Pertumbuhan Balita'
                        },
                        subtitle: {
                            text: data.tahun
                        },
                        yAxis: {
                            plotBands: [{
                                from: 0,
                                to: ideal[0],
                                color: 'rgba(255,253,59,0.5)'
                            }, {
                                from: ideal[0],
                                to: ideal[1],
                                color: 'rgba(198,253,0,0.5)'
                            }, {
                                from: ideal[1],
                                to: data.end,
                                color: 'rgba(174,235,0,0.5)'
                            },]
                        },
                        xAxis: {
                            categories: data.bulan,
                            accessibility: {
                                rangeDescription: data.daterange
                            }
                        },
                        legend: {
                            layout: 'vertical',
                            align: 'right',
                            verticalAlign: 'middle'
                        },
                        // plotOptions: {
                        //     series: {
                        //         label: {
                        //             connectorAllowed: false
                        //         },
                        //         pointStart: 2011
                        //     }
                        // },
                        series: [{
                            name: 'Berat Badan',
                            data: data.bb
                        }],
                        responsive: {
                            rules: [{
                                condition: {
                                    maxWidth: 500
                                },
                                chartOptions: {
                                    legend: {
                                        layout: 'horizontal',
                                        align: 'center',
                                        verticalAlign: 'bottom'
                                    }
                                }
                            }]
                        }
                    });
                }
            });
        }
    </script>
    <!-- end script -->
</body>

</html>
