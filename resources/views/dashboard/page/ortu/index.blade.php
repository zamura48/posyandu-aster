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
                    <button class="btn btn-success float-right" data-toggle="modal"
                        data-target="#modalTambahBalitaOrtu">Tambah Balita</button>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="card card-outline card-primary">
                {{-- <div class="card-header">
                </div> --}}
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row" id="balita_chart">
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

    <div class="modal fade" id="modalVerifikasiIbuBalita">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h4 class="modal-title">Ubah Data {{ $activePage }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formVerifikasiIbuBalita">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnik">NIK</label>
                                    <input type="text" id="inputid" name="id" hidden class="form-control">
                                    <input type="text" id="inputnik" disabled name="nik" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnama_ibu">Nama Ibu</label>
                                    <input type="text" id="inputnama_ibu" disabled name="nama_ibu" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnama_ayah">Nama Ayah</label>
                                    <input type="text" id="inputnama_ayah" disabled name="nama_ayah" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnomor_telepon">Nomor Telepon</label>
                                    <input type="text" id="inputnomor_telepon" disabled name="nomor_telepon"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputalamat">Alamat</label>
                                    <input type="text" id="inputalamat" disabled name="alamat" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="selectstatus">Verifikasi Akun</label>
                                    <select class="custom-select rounded-0" id="selectstatus" name="status">
                                        <option value="0">Belum Verifikasi</option>
                                        <option value="1">Terverifikasi</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row" id="nama_balita">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-info text-white">Verifikasi</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal ubah -->
@endsection

@push('js')
    <script>
        $(function() {
            $.get("anak", function(data, textStatus, jqXHR) {
                const dt = JSON.parse(data);
                let x = 1;
                $.each(dt, function(index, val) {
                    var template_data =
                        '<div class="col-md-4" id="ubah' + val.id +
                        '"><hr><strong>NIK</strong><p class="text-muted">' + val
                        .nik +
                        '</p><strong>Nama Balita</strong><p class="text-muted">' + val
                        .nama_lengkap +
                        '</p><strong>Tanggal Lahir</strong><p class="text-muted">' + val
                        .tanggal_lahir +
                        '</p><strong>Jenis Kelamin</strong><p class="text-muted">' + val
                        .jenis_kelamin +
                        '</p><button class="btn btn-warning">Ubah</button><button class="btn btn-info float-right" id="tampil_chart' +
                        val.id + '" onclick="highchart(' +
                        val.id + ')">Tampilkan Chart</button></div> ';
                    var template_chart = template_data +
                        '<hr><div class="col-md-8"><hr><div id="linechart' + val.id +
                        '"></div></div>';

                    // chart

                    $('.card #balita_chart').append(template_chart);
                });
            });
        });

        function highchart(id) {
            // get data penimbangan
            $.get("get_penimbangan/" + id, function(data, textStatus, jqXHR) {
                if (Array.isArray(data) && data.length === 0) {
                    console.log('berhasil');
                    $('#linechart'+id).append('<p id="ket'+id+'" class="text-muted text-center text-lg">Belum ada data penimbangan</p>');
                } else {
                    Highcharts.chart('linechart' + id, {
                        title: {
                            text: 'Pertumbuhan Balita'
                        },
                        subtitle: {
                            text: '2022'
                        },
                        xAxis: {
                            categories: [
                                'Jan',
                                'Feb',
                                'Mar',
                                'Apr',
                                'Mei',
                                'Jun',
                                'Jul',
                                'Ags'
                            ]
                            // accessibility: {
                            //     rangeDescription: 'Range: 2010 to 2019'
                            // }
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
                            data: data
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

            $('#tampil_chart' + id).remove();
            $('#ubah' + id).append('<button class="btn btn-danger float-right" id="tutup_chart' + id +
                '" onclick="close_highchart(' + id + ')">Tutup Chart</button>');
        }

        function close_highchart(id) {
            $('#tutup_chart' + id).remove();
            if ($('#linechart'+id+' .highcharts-container ').length) {
                $('#linechart'+id+' .highcharts-container ').remove();
            }
            $('p#ket'+id).remove();
            $('#ubah' + id).append('<button class="btn btn-info float-right" id="tampil_chart' +
                id + '" onclick="highchart(' +
                id + ')">Tampilkan Chart</button>');
        }
    </script>
@endpush
