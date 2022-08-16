@extends('layouts.app', [$activePage])

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> {{ $activePage }}</h1>
                </div><!-- /.col -->
                {{-- <div class="col-sm-6">
                    <button class="btn btn-success float-right" data-toggle="modal"
                        data-target="#modalTambahBalitaOrtu">Tambah Balita</button>
                </div><!-- /.col --> --}}
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="card card-outline card-primary">
                <div class="card-body" id="body_balita_chart">
                    <div class="row" id="balita_chart"></div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

    <div class="modal fade" id="modalUbahBalitaOrtu">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h4 class="modal-title">Ubah Profil {{ $activePage }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formUbahBalitaOrtu">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <span class="text-danger">*</span><small> Wajib Diisi</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnik">NIK <span class="text-danger">*</span></label>
                                    <input type="text" id="inputid" hidden name="id" class="form-control">
                                    <input type="text" readonly id="inputnik" name="nik" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnama_lengkap">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" id="inputnama_lengkap" name="nama_lengkap"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputtanggal_lahir">Tanggal Lahir <span
                                            class="text-danger">*</span></label>
                                    <input type="date" id="inputtanggal_lahir" name="tanggal_lahir"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group" id="jenis_kelamin">
                                    <label for="selectjenis_kelamin">Jenis Kelamin <span
                                            class="text-danger">*</span></label>
                                    <select class="custom-select rounded-0" id="selectjenis_kelamin"
                                        name="jenis_kelamin">
                                        <option value=""></option>
                                        <option value="Laki-Laki">Laki-Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group" id="proses_lahiran">
                                    <label for="selectproses_lahiran">Proses Lahiran <span
                                            class="text-danger">*</span></label>
                                    <select class="custom-select rounded-0" id="selectproses_lahiran"
                                        name="proses_lahiran">
                                        <option value=""></option>
                                        <option value="Normal">Normal</option>
                                        <option value="SC">SC</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="inputbbl">BBL</label>
                                    <input type="text" id="inputbbl" name="bbl" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="inputpb">PB</label>
                                    <input type="text" id="inputpb" name="pb" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputtempat_lahir">Tempat Lahir (RS)</label>
                                    <input type="text" id="inputtempat_lahiran" name="tempat_lahiran"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="inputketerangan">Keterangan</label>
                                    <input type="text" id="inputketerangan" name="keterangan" class="form-control" placeholder="Masukkan keterangan kenapa ingin diperbarui">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-warning">Simpan</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal tambah -->
@endsection

@push('js')
    {{-- Highchart --}}
    <script src="{{ asset('vendor/AdminLTE-3.1.0/plugins/highchart/highcharts.js') }}"></script>
    <script>
        $(function() {
            load_data_anak();

            $('#selectjenis_kelamin').select2({
                theme: 'bootstrap4',
                placeholder: 'Pilih Jenis Kelamin',
                minimumResultsForSearch: -1
            });

            $('#selectproses_lahiran').select2({
                theme: 'bootstrap4',
                placeholder: 'Pilih Proses Lahiran',
                minimumResultsForSearch: -1
            });

            $("#formTambahBalitaOrtu").submit(function(e) {
                e.preventDefault();
                removeError("TambahBalitaOrtu");
                var formData = new FormData(this);

                $.ajax({
                    type: "POST",
                    url: "anak",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status == 200) {
                            remove_balita_chart();
                            $("#modalTambahBalitaOrtu").modal('toggle');
                            $("#formTambahBalitaOrtu")[0].reset();
                            toastr.success('Berhasil Menambah Data Balita.');
                        }
                    },
                    error: function(response) {
                        $.each(response.responseJSON.errors, function(index, value) {
                            errorFrom("TambahBalitaOrtu", index, value);
                        });
                        toastr.error('Gagal Menambah Data Balita.');
                    }
                });
            });

            $("#formUbahBalitaOrtu").submit(function(e) {
                e.preventDefault();
                removeError("UbahBalitaOrtu");
                var formData = new FormData(this);
                var id = "";

                for (var key of formData.entries()) {
                    if (key[0] == "id") {
                        id = key[1];
                    }
                }
                // console.log(id);

                $.ajax({
                    type: "POST",
                    url: "anak/" + id,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response == 200) {
                            remove_balita_chart();
                            $("#modalUbahBalitaOrtu").modal('toggle');
                            $("#formUbahBalitaOrtu")[0].reset();
                            toastr.success('Berhasil Mengubah Data Balita.');
                        }
                    },
                    error: function(response) {
                        toastr.error('Gagal Mengubah Data Balita.');
                        $.each(response.responseJSON.errors, function(index, value) {
                            errorFrom("UbahBalitaOrtu", index, value)
                        });
                    }
                });
            });
        });

        function load_data_anak() {
            $.get("anak", function(data, textStatus, jqXHR) {
                const dt = JSON.parse(data);
                let x = 1;
                if (Array.isArray(dt) && dt.length === 0) {
                    var template =
                        '<div class="col-md-12 text-center"><strong>Belum Ada Data</strong></div>';
                    $('.card #balita_chart').append(template);
                } else {
                    $.each(dt, function(index, val) {
                        var template_data =
                            '<div class="col-md-4" id="ubah' + val.id +
                            '"><hr><strong>NIK</strong><p class="text-muted">' + val.nik +
                            '</p><strong>Nama Balita</strong><p class="text-muted">' + val
                            .nama_lengkap +
                            '</p><strong>Tanggal Lahir</strong><p class="text-muted">' + val
                            .tanggal_lahir +
                            '</p><strong>Jenis Kelamin</strong><p class="text-muted">' + val
                            .jenis_kelamin +
                            '</p><a href="balita/' + btoa(val.id) +
                            '" type="button" class="btn btn-info"> Detail</a> <button class="btn btn-warning" onclick="ubahDataBalita(' +
                            val
                            .id +
                            ')">Ubah</button> <button class="btn btn-primary float-right" id="tampil_chart' +
                            val.id + '" onclick="highchart(' + val.id +
                            ')">Tampilkan Chart</button></div> ';
                        var template_chart = template_data +
                            '<hr><div class="col-md-8"><hr><div id="linechart' + val.id +
                            '"></div></div>';
                        $('.card #balita_chart').append(template_chart);
                    });
                }
            });
        };

        function remove_balita_chart() {
            $("#balita_chart").remove();
            $("#body_balita_chart").append('<div class="row" id="balita_chart"></div>');
            load_data_anak();
        }

        function highchart(id) {
            // get data penimbangan
            $.get("get_penimbangan/" + id, function(data, textStatus, jqXHR) {
                if (Array.isArray(data) && data.length === 0) {
                    // console.log('berhasil');
                    $('#linechart' + id).append('<p id="ket' + id +
                        '" class="text-muted text-center text-lg">Belum ada data penimbangan</p>');
                } else {
                    Highcharts.chart('linechart' + id, {
                        title: {
                            text: 'Pertumbuhan Balita'
                        },
                        subtitle: {
                            text: data.tahun
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

            $('#tampil_chart' + id).remove();
            $('#ubah' + id).append('<button class="btn btn-danger float-right" id="tutup_chart' + id +
                '" onclick="close_highchart(' + id + ')">Tutup Chart</button>');
        }

        function close_highchart(id) {
            $('#tutup_chart' + id).remove();
            if ($('#linechart' + id + ' .highcharts-container ').length) {
                $('#linechart' + id + ' .highcharts-container ').remove();
            }
            $('p#ket' + id).remove();
            $('#ubah' + id).append('<button class="btn btn-info float-right" id="tampil_chart' +
                id + '" onclick="highchart(' +
                id + ')">Tampilkan Chart</button>');
        }

        function ubahDataBalita(id) {
            $.get("balita/" + id + "/edit", function(data) {
                $("#formUbahBalitaOrtu #inputid").val(data.id);
                $("#formUbahBalitaOrtu #inputnik").val(data.nik);
                $("#formUbahBalitaOrtu #inputnama_lengkap").val(data.nama_lengkap);
                $("#formUbahBalitaOrtu #inputtanggal_lahir").val(data.tanggal_lahir);
                $("#formUbahBalitaOrtu #selectjenis_kelamin").val(data.jenis_kelamin).trigger('change');
                $("#formUbahBalitaOrtu #selectproses_lahiran").val(data.proses_lahiran).trigger('change');
                $("#formUbahBalitaOrtu #inputbbl").val(data.bbl);
                $("#formUbahBalitaOrtu #inputpb").val(data.pb);
                $("#formUbahBalitaOrtu #inputtempat_lahiran").val(data.tempat_lahiran);
                $("#modalUbahBalitaOrtu").modal('toggle');
            });
        }

        // METHOD UNTUK MENAMPILKAN ERROR SESUAI DENGAN INPUTNYA
        function errorFrom(aksi, index, value) {
            if ($("#form" + aksi + " #input" + index).length) {
                $("#form" + aksi + " #input" + index).addClass('is-invalid')
                    .after('<span id="input' + index + '-error" class="error invalid-feedback">' + value + '</span>');
            } else {
                $("#form" + aksi + " #select" + index)
                    .addClass('is-invalid');
                $("#form" + aksi + " #" + index + " .select2").after(
                    '<span style="color: #dc3545;" class="text-sm">' + value + '</span>');
            }
        }

        // METHOD UNTUK MENGHAPUS/REMOVE ERROR YANG TAMPIL
        function removeError(aksi) {
            if ($("#form" + aksi + " .is-invalid").length) {
                $("#form" + aksi + " input.is-invalid").removeClass('is-invalid');
                $("#form" + aksi + " select.is-invalid").removeClass('is-invalid');
                $("#form" + aksi + " span.error").remove();
                $("#form" + aksi + " span.text-sm").remove();
            }
        }
    </script>
@endpush
