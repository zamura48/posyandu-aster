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

                    {{-- <div class="card-tools">
                        <button type="button" class="btn btn-success" data-toggle="modal"
                            data-target="#modalTambahPemberianVitamin">
                            Tambah Data {{ $activePage }}
                        </button>
                    </div> --}}
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <i class="nav-icon fa fa-exclamation text-warning"></i>
                            <span>
                                Pemberian Vitamin dilakukan 2 kali setiap 1 tahun yaitu bulan Januari dan bulan Agustus
                            </span>
                        </div>
                        <div class="col-md-2 mt-2">
                            <select class="form-control" id="bulan" name="bulan" style="width: 100%;">
                                <option value=""></option>
                                <option value="1">Januari</option>
                                <option value="8">Agustus</option>
                            </select>
                        </div>
                        <div class="col-md-1 mt-2">
                            <input type="text" name="tahun" id="tahun" class="form-control" placeholder="Tahun"
                                autocomplete="off">
                        </div>
                        <div class="col-md-9 mt-2">
                            <button class="btn btn-primary mr-1" id="filter" name="filter">Filter</button>
                            <button class="btn btn-default" id="reset" name="reset">Reset</button>
                            @can('kader')
                                <a href="export/pemberian_vitamin/0&0" class="btn btn-info mr-1" id="export"
                                    name="export">Export Excel</a>
                            @endcan
                        </div>
                    </div>
                    {{-- TABLE --}}
                    <table id="table_timbang_dan_vitamin" class="table table-bordered table-hover text-nowrap">
                        <thead class="text-center">
                            <th class="align-middle" rowspan="2">Nama</th>
                            <th colspan="2">Vitamin</th>
                            <th class="align-middle" rowspan="2">BB</th>
                            <th class="align-middle" rowspan="2">TB</th>
                            <th class="align-middle" rowspan="2">Aksi Eksklusif</th>
                            <th class="align-middle" rowspan="2">IMD</th>
                            <th class="align-middle" rowspan="2">Tanggal</th>
                            <th class="align-middle" rowspan="2">Aksi</th>
                            <tr>
                                <th>Merah</th>
                                <th>Biru</th>
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

    {{-- MODAL UBAH --}}
    <div class="modal fade" id="modalUbahPemberianVitamin">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h4 class="modal-title">Ubah Data {{ $activePage }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formUbahPemberianVitamin">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="text-muted">
                                    <p class="text-lg">Nama Balita
                                        <b class="d-block" id="nama_balita"></b>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-muted">
                                    <p class="text-lg">Nama Ayah
                                        <b class="d-block" id="pemberian_vitamin_nama_ayah"></b>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-muted">
                                    <p class="text-lg">Nama Ibu
                                        <b class="d-block" id="pemberian_vitamin_nama_ibu"></b>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="selectvitamin_a">Vitamin A <span class="text-danger">*</span></label>
                                    <select class="custom-select rounded-0" id="selectvitamin_a" name="vitamin_a" required>
                                        <option value="">-</option>
                                        <option value="Biru">Biru</option>
                                        <option value="Merah">Merah</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputbb">Berat Badan Balita <span class="text-danger">*</span></label>
                                    <input type="text" id="inputbb" name="bb" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputtb">Tinggi Badan <span class="text-danger">*</span></label>
                                    <input type="text" id="inputtb" name="tb" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="selectaksi_eksklusif">Aksi Eksklusif </label>
                                    <select class="custom-select rounded-0" id="selectaksi_eksklusif"
                                        name="aksi_eksklusif">
                                        <option value="">-</option>
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak">Tidak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="selectinisiatif_menyusui_dini">Inisiatif Menyusui Dini (IMD) </label>
                                    <select class="custom-select rounded-0" id="selectinisiatif_menyusui_dini"
                                        name="inisiatif_menyusui_dini">
                                        <option value="">-</option>
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak">Tidak</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-warning text-white">Perbarui</button>
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
            // MEMANGGIL METHOD DAN MELOAD DATATABLE
            load_data_pemberian_vitamin();

            // MENGGUNAKAN PLUGIN DATEPICKER
            $("#tahun").datepicker({
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years",
                autoclose: true //to close picker once year is selected
            });

            // MENGGUNAKAN PLUGIN SELECT2
            $("#bulan").select2({
                theme: 'bootstrap4',
                placeholder: 'Pilih Bulan',
                minimumResultsForSearch: -1
            });

            $("#selectvitamin_a").select2({
                theme: 'bootstrap4',
                placeholder: 'Pilih Vitamin',
                minimumResultsForSearch: -1
            });

            $("#selectaksi_eksklusif").select2({
                theme: 'bootstrap4',
                placeholder: 'Pilih Aksi Eksklusif',
                minimumResultsForSearch: -1
            });

            $("#selectinisiatif_menyusui_dini").select2({
                theme: 'bootstrap4',
                placeholder: 'Pilih IMD',
                minimumResultsForSearch: -1
            });

            // MENGGUNAKAN PLUGIN SELECT2
            $('#select_get_nama_balita_pemberian_vitamin').select2({
                theme: 'bootstrap4',
                placeholder: 'Pilih/Cari Nama Balita'
            });

            // SEARCH NAMA BALITA BERDASARKAN ID BALITA
            $('#select_get_nama_balita_pemberian_vitamin').on('select2:select', function(e) {
                const id = e.params.data.id;

                // MENGAMBIL DATA BALITA BERDASARKAN ID BALITA
                $.get("get_nama_balita/" + id, function(data) {
                    const ortu = data;
                    $("#pemberian_vitamin_nama_ayah").text(data.nama_ayah);
                    $("#pemberian_vitamin_nama_ibu").text(data.nama_ibu);
                    $('#pemberian_vitamin_info_nama_ayah').show();
                    $('#pemberian_vitamin_info_nama_ibu').show();
                });
            });

            // EVENT UNTUK MENAMBAH DATA BARU
            $('#formTambahPemberianVitamin').submit(function(e) {
                e.preventDefault();
                removeError("TambahPemberianVitamin");
                let formData = new FormData(this);

                $.ajax({
                    type: "POST",
                    url: "{{ route('pemberian_vitamin.store') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response === 200) {
                            $('#table_timbang_dan_vitamin').DataTable().ajax.reload(null,
                                false);
                            $('#formTambahPemberianVitamin')[0].reset();
                            $('#modalTambahPemberianVitamin').modal('toggle');
                            kosongkan()
                            toastr.success('Berhasil Menambah Data Pemberian Vitamin.');
                        }
                    },
                    error: (response) => {
                        if (response.status == 422) {
                            toastr.error('Gagal Menambah Data Pemberian Vitamin.');
                            $.each(response.responseJSON.errors, function(index, value) {
                                errorFrom("TambahPemberianVitamin", index, value);
                            });
                        } else {
                            toastr.error(response.responseJSON.message);
                        }
                    }
                });
            });

            // EVENT UNTUK MENGUBAH DATA YANG ADA BERDASARKAN ID BALITA
            $('#formUbahPemberianVitamin').submit(function(e) {
                e.preventDefault();
                removeError("UbahPemberianVitamin");
                let formData = new FormData(this);
                let id = "";

                for (var key of formData.entries()) {
                    if (key[0] == "id") {
                        id = key[1];
                    }
                }

                $.ajax({
                    type: "POST",
                    url: "pemberian_vitamin/" + id,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response === 200) {
                            $('#table_timbang_dan_vitamin').DataTable().ajax.reload(null,
                                false);
                            $('#formUbahPemberianVitamin')[0].reset();
                            $('#modalUbahPemberianVitamin').modal('toggle');
                            toastr.success('Berhasil Mengubah Data Pemberian Vitamin.');
                        }
                    },
                    error: (response) => {
                        if (response.status == 422) {
                            toastr.error('Gagal Mengubah Data Pemberian Vitamin.');
                            $.each(response.responseJSON.errors, function(index, value) {
                                errorFrom("UbahPemberianVitamin", index, value);
                            });
                        } else {
                            toastr.error(response.responseJSON.message);
                        }
                    }
                });
            });

            // EVENT UNTUK FILTER DAN MENGINISIALISASI BUTTON EXPORT BERDASARKAN TAHUN
            $("#filter").click(function(e) {
                e.preventDefault();

                let bulan = $("#bulan").val();
                let tahun = $("#tahun").val();
                if (bulan != '' && tahun != '') {
                    $("#table_timbang_dan_vitamin").DataTable().destroy();
                    load_data_pemberian_vitamin(bulan, tahun);
                    $("#export").prop("href", "export/pemberian_vitamin/" + bulan + "&" + tahun);
                } else {
                    toastr.warning('Bulan dan Tahun wajib diisi.');
                }
            });

            // EVENT UNTUK MERESET INPUT TAHUN DAN TOMBOL RESET
            $("#reset").click(function(e) {
                e.preventDefault();

                $("#bulan").val('').trigger('change');
                // INISIALISASI LINK EXPORT
                $("#export").prop("href", "export/pemberian_vitamin/0&0");
                // MENGOSONGKAN INPUT TAHUN
                $("#tahun").val("");
                // MERESET/MENGHAPUS DATATABLE YANG ADA
                $("#table_timbang_dan_vitamin").DataTable().destroy();
                // MELOAD DATATABLE BARU
                load_data_pemberian_vitamin();
            });
        });

        // METHOD UNTUK MENGAMBIL DATA DAN MENGISIKAN DATA KEDALAM DATATABLE
        function load_data_pemberian_vitamin(bulan = "", tahun = "") {
            $('#table_timbang_dan_vitamin').DataTable({
                scrollX: true,
                scrollCollapse: true,
                fixedColumns: {
                    left: 1
                },
                processing: true,
                serverside: true,
                ajax: {
                    url: 'pemberian_vitamin',
                    data: {
                        bulan: bulan,
                        tahun: tahun
                    }
                },
                columns: [{
                        data: 'balita.nama_lengkap',
                        name: 'balita.nama_lengkap'
                    },
                    {
                        data: 'vitamin_a',
                        orderable: false,
                        render: function(data) {
                            if (data == "Merah") {
                                return data;
                            } else {
                                return "-";
                            }
                        }
                    },
                    {
                        data: 'vitamin_a',
                        orderable: false,
                        render: function(data) {
                            if (data == "Biru") {
                                return data;
                            } else {
                                return "-";
                            }
                        }
                    },
                    {
                        data: 'bb'
                    },
                    {
                        data: 'tb'
                    },
                    {
                        data: 'aksi_eksklusif',
                        render: function(data) {
                            if (data != null) {
                                return data;
                            } else {
                                return "-";
                            }
                        },
                        width: '10%'
                    },
                    {
                        data: 'inisiatif_menyusui_dini',
                        render: function(data) {
                            if (data != null) {
                                return data;
                            } else {
                                return "-";
                            }
                        },
                        width: '10%'
                    },
                    {
                        data: 'tanggal_input',
                        name: 'tanggal_input',
                        width: '17%'
                    },
                    {
                        data: 'aksi',
                        orderable: false,
                        width: '17%'
                    }
                ],
                columnDefs: [{
                        targets: 1,
                        className: 'text-center'
                    },
                    {
                        targets: 2,
                        className: 'text-center'
                    },
                    {
                        targets: 5,
                        className: 'text-center'
                    },
                    {
                        targets: 6,
                        className: 'text-center'
                    },
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

        // METHOD UNTUK MENGAMBIL DATA BERDASARKAN ID
        function ubahDataPemberianVitamin(id) {
            $.get("pemberian_vitamin/" + id + "/edit", function(data, textStatus, jqXHR) {
                const d = JSON.parse(atob(data));

                $('#formUbahPemberianVitamin #nama_balita').before(
                    '<input type="text" id="inputid" name="id" class="form-control" value="' + d
                    .pemberian_vitamin.id + '">');
                $('#formUbahPemberianVitamin #inputid').hide();
                $('#formUbahPemberianVitamin #nama_balita').text(d.balita.nama_lengkap);
                $('#formUbahPemberianVitamin #pemberian_vitamin_nama_ayah').text(d.balita.ortu_balita
                    .nama_suami);
                $('#formUbahPemberianVitamin #pemberian_vitamin_nama_ibu').text(d.balita.ortu_balita
                    .nama_istri);
                $('#formUbahPemberianVitamin #selectvitamin_a').val(d.pemberian_vitamin.vitamin_a).trigger(
                'change');
                $('#formUbahPemberianVitamin #inputbb').val(d.pemberian_vitamin.bb);
                $('#formUbahPemberianVitamin #inputtb').val(d.pemberian_vitamin.tb);
                $('#formUbahPemberianVitamin #selectaksi_eksklusif').val(d.pemberian_vitamin
                    .aksi_eksklusif).trigger('change');
                $('#formUbahPemberianVitamin #selectinisiatif_menyusui_dini').val(d.pemberian_vitamin
                    .inisiatif_menyusui_dini).trigger('change');
                $('#modalUbahPemberianVitamin').modal('toggle');
            });
        }

        // METHOD UNTUK MENGHAPUS DATA BERDASRKAN ID
        function hapusDataPemberianVitamin(id) {
            Swal.fire({
                title: 'Apakah kamu yakin?',
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
                        url: "pemberian_vitamin/delete/" + id,
                        data: {
                            id: id,
                            _token: $("meta[name=csrf-token]").attr('content')
                        },
                        success: function(response) {
                            if (response == 200) {
                                $('#table_timbang_dan_vitamin').DataTable().ajax.reload(null, false);
                                toastr.success('Berhasil Menghapus Data Balita.');
                            }
                        },
                        error: (response) => {
                            toastr.error(response.responseJSON.message);
                        }
                    });
                }
            })
        }

        // METHOD UNTUK MENGOSONGKAN INPUT DAN MENGOSONGKAN SELECT
        function kosongkan() {
            $('#select_get_nama_balita_pemberian_vitamin').select2({
                theme: 'bootstrap4',
                placeholder: 'Pilih Nama Balita'
            });
            $("#pemberian_vitamin_nama_ayah").text('');
            $("#pemberian_vitamin_nama_ibu").text('');
            $('#pemberian_vitamin_info_nama_ayah').hide();
            $('#pemberian_vitamin_info_nama_ibu').hide();
        }
    </script>
@endpush
