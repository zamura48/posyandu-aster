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
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-1 mt-2">
                            <input type="text" name="tahun" id="tahun" class="form-control" placeholder="Tahun"
                                autocomplete="off">
                        </div>
                        <div class="col-md-4 mt-2">
                            <button class="btn btn-primary" id="cari">Filter</button>
                            <button class="btn btn-default" id="reset">Reset</button>
                            @can('kader')
                                <a href="penimbangan/export/{{ date('Y') }}" class="btn btn-info" id="export_excel">Export
                                    Excel</a>
                            @endcan
                        </div>
                    </div>
                    <hr>
                    <table id="table_penimbangan" class="table table-bordered table-hover text-nowrap">
                        <thead class="text-center">
                            <th rowspan="2" class="align-middle">Nama</th>
                            <th>Jan</th>
                            <th>Feb</th>
                            <th>Mar</th>
                            <th>Apr</th>
                            <th>Mei</th>
                            <th>Juni</th>
                            <th>Juli</th>
                            <th>Ags</th>
                            <th>Sep</th>
                            <th>Okt</th>
                            <th>Nov</th>
                            <th>Des</th>
                            <th rowspan="2" class="align-middle">Aksi</th>
                            <tr>
                                <th>BB/TB</th>
                                <th>BB/TB</th>
                                <th>BB/TB</th>
                                <th>BB/TB</th>
                                <th>BB/TB</th>
                                <th>BB/TB</th>
                                <th>BB/TB</th>
                                <th>BB/TB</th>
                                <th>BB/TB</th>
                                <th>BB/TB</th>
                                <th>BB/TB</th>
                                <th>BB/TB</th>
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

    {{-- <div class="modal fade" id="modalTambahPenimbangan">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h4 class="modal-title">Tambah Data {{ $activePage }} Baru</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formTambahPenimbangan">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nama Balita <span class="text-danger">*</span></label>
                                    <select class="form-control" id="select_get_nama_balita_penimbangan" name="balita_id"
                                        style="width: 100%;" required>
                                        <option value=""></option>
                                        @foreach ($balitas as $balita)
                                            <option value="{{ encrypt($balita->id) }}">
                                                {{ $balita->nama_lengkap }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4" style="display: none;" id="penimbangan_info_nama_ayah">
                                <div class="text-muted">
                                    <p class="text-lg">Nama Ayah
                                        <b class="d-block" id="penimbangan_nama_ayah"></b>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-4" style="display: none;" id="penimbangan_info_nama_ibu">
                                <div class="text-muted">
                                    <p class="text-lg">Nama Ibu
                                        <b class="d-block" id="penimbangan_nama_ibu"></b>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="inputbulan_tahun">Bulan-Tahun <span class="text-danger">*</span></label>
                                    <input type="text" id="inputbulan_tahun" name="bulan_tahun" class="form-control"
                                        value="{{ date('m-Y') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputbb">Berat Badan Balita (kg) <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="inputbb" name="bb" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputttb">Tinggi Badan (cm) <span class="text-danger">*</span></label>
                                    <input type="text" id="inputttb" name="tb" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputketerangan">Keterangan</label>
                                    <input type="text" id="inputketerangan" name="keterangan" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal tambah --> --}}
@endsection

@push('js')
    <script>
        $(function() {
            load_data_penimbangan();

            // MENGGUNAKAN PLUGIN DATEPICKER
            $("#formUbahPenimbangan #inputtanggal_input").datepicker({
                format: "yyyy-mm-dd",
                autoclose: true //to close picker once year is selected
            });

            // MENGGUNAKAN PLUGIN DATEPICKER
            $("#tahun").datepicker({
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years",
                autoclose: true //to close picker once year is selected
            });

            $("#cari").click(function(e) {
                e.preventDefault();
                let tahun = $("#tahun").val();

                if (tahun != "") {
                    $("#table_penimbangan").DataTable().destroy();
                    load_data_penimbangan(tahun);
                    $("#export_excel").prop("href", "penimbangan/export/" + tahun);
                } else {
                    toastr.warning("Tahun Wajib diisi!");
                }
            });

            // EVENT UNTUK MERESET INPUT TAHUN DAN TOMBOL RESET
            $("#reset").click(function(e) {
                e.preventDefault();
                let tahun = new Date();

                // INISIALISASI LINK EXPORT
                $("#export_excel").prop("href", "export/penimbangan/" + tahun.getFullYear());
                // MENGOSONGKAN INPUT TAHUN
                $("#tahun").val("");
                // MERESET/MENGHAPUS DATATABLE YANG ADA
                $("#table_penimbangan").DataTable().destroy();
                // MELOAD DATATABLE BARU
                load_data_penimbangan();
            });

            $('#select_get_nama_balita_penimbangan').select2({
                theme: 'bootstrap4',
                placeholder: 'Pilih Nama Balita'
            });

            // EVENT UNTUK MENCARI NAMA AYAH DAN IBU BALITA BERDASARKAN ID
            $('#select_get_nama_balita_penimbangan').on('select2:select', function(e) {
                e.preventDefault();
                const id = e.params.data.id;

                $.get("get_nama_balita/" + id, function(data, textStatus, jqXHR) {
                    const ortu = data;
                    $("#formTambahPenimbangan #penimbangan_nama_ayah").text(data.nama_ayah);
                    $("#formTambahPenimbangan #penimbangan_nama_ibu").text(data.nama_ibu);
                    $('#formTambahPenimbangan #penimbangan_info_nama_ayah').show();
                    $('#formTambahPenimbangan #penimbangan_info_nama_ibu').show();
                });
            });

            $('#formTambahPenimbangan').submit(function(e) {
                e.preventDefault();
                removeError("TambahPenimbangan");

                let formData = new FormData(this);

                $.ajax({
                    type: "POST",
                    url: "penimbangan",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response == 200) {
                            // MERESET/MENGHAPUS DATATABLE YANG ADA
                            $("#table_penimbangan").DataTable().destroy();
                            // MELOAD DATATABLE BARU
                            load_data_penimbangan();
                            $('#modalTambahPenimbangan').modal('toggle');
                            $('#formTambahPenimbangan')[0].reset();
                            kosongkan()
                            toastr.success('Berhasil Menambah Data Penimbangan Baru.');
                        }
                    },
                    error: (response) => {
                        toastr.error('Gagal Menambah Data Penimbangan.');
                        $.each(response.responseJSON.errors, function(index, value) {
                            errorFrom("TambahPenimbangan", index, value);
                        });
                    }
                });
            });

            $("#modalUbahPenimbangan").on("hidden.bs.modal", function() {
                if ($("#formUbahPenimbangan #inputid").length) {
                    $("#formUbahPenimbangan #inputid").remove();
                }
            });
        });

        // METHOD UNTUK MENGAMBIL DATA DAN MENGISIKAN DATA KEDALAM DATATABLE
        function load_data_penimbangan(tahun = "") {
            $('#table_penimbangan').DataTable({
                scrollX: true,
                fixedColumns: {
                    left: 1
                },
                processing: true,
                serverside: true,
                ajax: {
                    url: 'penimbangan',
                    data: {
                        tahun: tahun
                    }
                },
                columns: [{
                        data: 'balita.nama_lengkap',
                        name: 'balita.nama_lengkap',
                        width: '30%'
                    },
                    {
                        data: 'bulan_jan',
                        orderable: false,
                        render: function(data) {
                            return data.replace(/,/gi, "");
                        },
                        width: '25%'
                    },
                    {
                        data: 'bulan_feb',
                        orderable: false,
                        render: function(data) {
                            return data.replace(/,/gi, "");
                        },
                        width: '25%'
                    },
                    {
                        data: 'bulan_mar',
                        orderable: false,
                        render: function(data) {
                            return data.replace(/,/gi, "");
                        },
                        width: '25%'
                    },
                    {
                        data: 'bulan_apr',
                        orderable: false,
                        render: function(data) {
                            return data.replace(/,/gi, "");
                        },
                        width: '25%'
                    },
                    {
                        data: 'bulan_mei',
                        orderable: false,
                        render: function(data) {
                            return data.replace(/,/gi, "");
                        },
                        width: '25%'
                    },
                    {
                        data: 'bulan_jun',
                        orderable: false,
                        render: function(data) {
                            return data.replace(/,/gi, "");
                        },
                        width: '25%'
                    },
                    {
                        data: 'bulan_jul',
                        orderable: false,
                        render: function(data) {
                            return data.replace(/,/gi, "");
                        },
                        width: '25%'
                    },
                    {
                        data: 'bulan_ags',
                        orderable: false,
                        render: function(data) {
                            return data.replace(/,/gi, "");
                        },
                        width: '25%'
                    },
                    {
                        data: 'bulan_sep',
                        orderable: false,
                        render: function(data) {
                            return data.replace(/,/gi, "");
                        },
                        width: '25%'
                    },
                    {
                        data: 'bulan_okt',
                        orderable: false,
                        render: function(data) {
                            return data.replace(/,/gi, "");
                        },
                        width: '25%'
                    },
                    {
                        data: 'bulan_nov',
                        orderable: false,
                        render: function(data) {
                            return data.replace(/,/gi, "");
                        },
                        width: '25%'
                    },
                    {
                        data: 'bulan_des',
                        orderable: false,
                        render: function(data) {
                            return data.replace(/,/gi, "");
                        },
                        width: '25%'
                    },
                    {
                        data: 'aksi',
                        orderable: false,
                        width: '16%',
                        // visible: "{{ auth()->user()->role }}" === "Kader" ? true : false
                    }
                ]
            });
        }

        // METHOD UNTUK MENAMPILKAN ERROR SESUAI DENGAN INPUTNYA
        function errorFrom(aksi, index, value) {
            if ($("#form" + aksi + " #input" + index).length) {
                $("#form" + aksi + " #input" + index).addClass('is-invalid')
                    .after('<span id="input' + index + '-error" class="error invalid-feedback">' + value +
                        '</span>');
            } else {
                $("#form" + aksi + " #select" + index)
                    .addClass('is-invalid');
                $("#form" + aksi + " .select2").after(
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

        // METHOD UNTUK MENGOSONGKAN INPUT DAN MENGOSONGKAN SELECT
        function kosongkan() {
            $('#select_get_nama_balita_penimbangan').select2({
                theme: 'bootstrap4',
                placeholder: 'Pilih Nama Balita'
            });
            $("#penimbangan_nama_ayah").text('');
            $("#penimbangan_nama_ibu").text('');
            $('#penimbangan_info_nama_ayah').hide();
            $('#penimbangan_info_nama_ibu').hide();
        }

        // METHOD UNTUK MENGAMBIL DATA BERDASARKAN ID
        function ubahDataPenimbangan(id) {
            $.get("penimbangan/" + id + "/edit", function(data, textStatus, jqXHR) {
                const d = JSON.parse(atob(data));
                $('#formUbahPenimbangan #nama_balita').before(
                    '<input type="text" id="inputid" name="id" class="form-control" value="' + d.penimbangan
                    .id + '">');
                $('#formUbahPenimbangan #inputid').hide();
                $('#formUbahPenimbangan #penimbangan_nama_ayah').text(d.balita.ortu_balita.nama_suami);
                $('#formUbahPenimbangan #penimbangan_nama_ibu').text(d.balita.ortu_balita.nama_istri);
                $('#formUbahPenimbangan #nama_balita').text(d.balita.nama_lengkap);
                $('#formUbahPenimbangan #inputbulan_tahun').val(d.penimbangan.tanggal_input);
                $('#formUbahPenimbangan #inputbb').val(d.penimbangan.bb);
                $('#formUbahPenimbangan #inputtb').val(d.penimbangan.tb);
                $('#formUbahPenimbangan #inputketerangan').val(d.penimbangan.keterangan);
                $('#modalUbahPenimbangan').modal('toggle');
            });
        }

        // METHOD UNTUK MENGHAPUS DATA BERDASRKAN ID
        function hapusDataPenimbangan(id) {
            Swal.fire({
                title: 'Jika kamu menghapus data penimbangan ini, maka semua data penimbangan balita ini akan terhapus?',
                showClass: {
                    popup: 'animated__animated animated__fadeIn'
                },
                hideClass: {
                    popup: 'animated__animated animated__fadeOut'
                },
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "penimbangan/delete/" + id,
                        data: {
                            id: id,
                            _token: $("meta[name=csrf-token]").attr('content')
                        },
                        success: function(response) {
                            if (response == 200) {
                                $('#table_penimbangan').DataTable().ajax.reload(null, false);
                                toastr.success('Berhasil Menghapus Data Penimbangan.');
                            }
                        }
                    });
                }
            })
        }
    </script>
@endpush
