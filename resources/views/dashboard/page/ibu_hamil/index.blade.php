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
                    <h3 class="card-title mt-2 mb-2">Data {{ $activePage }}</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-success btn-block" data-toggle="modal"
                            data-target="#modalTambahIbuHamil">
                            Tambah Data {{ $activePage }}
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    {{-- Aksi Tambahan --}}
                    <div class="row ml-1">
                        <span><b> Filter Berdasarkan Tanggal Pemeriksaan</b></span>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 mt-2">
                            <div class="input-group input-daterange">
                                <input type="text" name="dari_tannggal" id="dari_tannggal" class="form-control"
                                    placeholder="Dari Tanggal" autocomplete="off">
                                <input type="text" name="sampai_tanggal" id="sampai_tanggal" class="form-control"
                                    placeholder="Sampai Tanggal" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-3 mt-2">
                            <button class="btn btn-primary" id="filter" name="filter">Filter</button>
                            <button class="btn btn-default" id="reset" name="reset">Reset</button>
                            <a href="export/ibu_hamil/semua&semua" id="export_excel" class="btn btn-info">Export Excel</a>
                        </div>
                    </div>
                    {{-- TABEL --}}
                    <table id="table_ibu_hamil" class="table table-bordered table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>NIK</th>
                                <th>Nama Ibu Hamil</th>
                                <th>Nomor Telepon</th>
                                <th>Umur Kehamilan (Bulan)</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
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

    <div class="modal fade" id="modalTambahIbuHamil">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h4 class="modal-title">Tambah Data {{ $activePage }} Baru</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formTambahIbuHamil">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <small> Masukkan Nama Ibu Hamil terlebih dahulu untuk mengecek nama tersebut sudah ada atau
                                    belum.</small>
                            </div>
                            <div class="col-md-3 mb-3">
                                <span class="text-danger">*</span><small> Wajib Diisi</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group" id="dialog">
                                    <label for="inputnama_istri">Nama Ibu Hamil <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="inputnama_istri" name="nama_istri" class="form-control" placeholder="Contoh: Siti">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnik">NIK <span class="text-danger">*</span></label>
                                    <input type="text" id="inputnik" name="nik" class="form-control"
                                        placeholder="Contoh: 3581xxxxxxxxxxxx">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputtanggal_lahir">Tanggal Lahir <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="inputtanggal_lahir" name="tanggal_lahir" class="form-control" autocomplete="off" placeholder="Contoh: 1995-02-01">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputalamat">Alamat <span class="text-danger">*</span></label>
                                    <input type="text" id="inputalamat" name="alamat" class="form-control"
                                        placeholder="Contoh: jln. veteran / Gg. Puskesmas">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnomor_telepon">Nomor Telepon <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="inputnomor_telepon" name="nomor_telepon" class="form-control"
                                        placeholder="Contoh: 088217643823">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputpekerjaan_istri">Pekerjaan Istri <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="inputpekerjaan_istri" name="pekerjaan_istri"
                                        class="form-control" placeholder="Contoh: Guru">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnama_suami">Nama Suami <span class="text-danger">*</span></label>
                                    <input type="text" id="inputnama_suami" name="nama_suami" class="form-control" placeholder="Contoh: Budi">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputpekerjaan_suami">Pekerjaan Suami <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="inputpekerjaan_suami" name="pekerjaan_suami"
                                        class="form-control" placeholder="Contoh: Swasta">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="inputumur_kehamilan">Umur Kehamilan <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="inputumur_kehamilan" name="umur_kehamilan"
                                        class="form-control" placeholder="Contoh: 1">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="inputtambah_darah">Tablet Tambah Darah <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control" id="select_tambah_darah" name="tambah_darah"
                                        style="width: 100%;" required>
                                        <option value=""></option>
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak">Tidak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="inputhasil_pemeriksaan">Hasil Pemeriksaan</label>
                                    <input type="text" id="inputhasil_pemeriksaan" name="hasil_pemeriksaan"
                                        class="form-control" placeholder="Contoh: Sehat">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="inputketerangan">Keterangan</label>
                                    <input type="text" id="inputketerangan" name="keterangan" class="form-control" placeholder="Contoh: Pindah">
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
    <!-- /.modal tambah -->

    <div class="modal fade" id="modalUbahIbuHamil">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h4 class="modal-title">Ubah Data {{ $activePage }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formUbahIbuHamil">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <small> Masukkan Nama Ibu Hamil terlebih dahulu untuk mengecek nama tersebut sudah ada atau
                                    belum.</small>
                            </div>
                            <div class="col-md-3 mb-3">
                                <span class="text-danger">*</span><small> Wajib Diisi</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnama_istri">Nama Ibu Hamil <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="inputnama_istri" name="nama_istri" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnik">NIK <span class="text-danger">*</span></label>
                                    <input type="text" id="inputnik" name="nik" class="form-control"
                                        placeholder="ex. 1234567890123456">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputtanggal_lahir">Tanggal Lahir <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="inputtanggal_lahir" name="tanggal_lahir" class="form-control" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputalamat">Alamat <span class="text-danger">*</span></label>
                                    <input type="text" id="inputalamat" name="alamat" class="form-control"
                                        placeholder="ex. jln. veteran">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnomor_telepon">Nomor Telepon <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="inputnomor_telepon" name="nomor_telepon" class="form-control"
                                        placeholder="ex. 088217643823">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputpekerjaan_istri">Pekerjaan Istri <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="inputpekerjaan_istri" name="pekerjaan_istri"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnama_suami">Nama Suami <span class="text-danger">*</span></label>
                                    <input type="text" id="inputnama_suami" name="nama_suami" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputpekerjaan_suami">Pekerjaan Suami <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="inputpekerjaan_suami" name="pekerjaan_suami"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="inputumur_kehamilan">Umur Kehamilan <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="inputumur_kehamilan" name="umur_kehamilan"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="inputtambah_darah">Tablet Tambah Darah <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control" id="select_tambah_darah" name="tambah_darah"
                                        style="width: 100%;" required>
                                        <option value=""></option>
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak">Tidak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="inputhasil_pemeriksaan">Hasil Pemeriksaan </label>
                                    <input type="text" id="inputhasil_pemeriksaan" name="hasil_pemeriksaan"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
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
    <!-- /.modal tambah -->
@endsection

@push('js')
    <script>
        $(function() {
            // MENGGUNAKAN PLUGIN DATEPICKER
            $(".input-daterange input").datepicker({
                format: "yyyy-mm-dd",
                autoclose: true //to close picker once year is selected
            });

            $("#inputtanggal_lahir").datepicker({
                format: "yyyy-mm-dd",
                autoclose: true //to close picker once year is selected
            });

            $('#formTambahIbuHamil #select_tambah_darah').select2({
                theme: 'bootstrap4',
                placeholder: 'Pilih',
                minimumResultsForSearch: -1
            });

            $("#filter").click(function(e) {
                e.preventDefault();
                let dari_tannggal = $("#dari_tannggal").val();
                let sampai_tanggal = $("#sampai_tanggal").val();
                if (dari_tannggal != "" && sampai_tanggal != "") {
                    $("#table_ibu_hamil").DataTable().destroy();
                    load_data_ibu_hamil(dari_tannggal, sampai_tanggal);
                    $("#export_excel").prop("href", "export/ibu_hamil/" + dari_tannggal + "&" +
                        sampai_tanggal);
                } else {
                    toastr.warning("Input Dari Tanggal dan Sampai Tanggal wajib diisi");
                }
            });

            $("#reset").click(function(e) {
                e.preventDefault();
                $("#export_excel").prop("href", "export/ibu_hamil/semua&semua");
                $("#dari_tannggal").val('');
                $("#sampai_tanggal").val('');
                $("#table_ibu_hamil").DataTable().destroy();
                load_data_ibu_hamil();
            });

            // $("#export_excel").click(function (e) {
            //     e.preventDefault();
            //     console.log(this.href);
            //     if (this.href == "javascript:void(0)") {
            //         toastr.warning("Klik Tombol Filter Terlebih dahulu");
            //     }
            // });

            load_data_ibu_hamil();

            $("#formTambahIbuHamil #inputnama_istri").autocomplete({
                appendTo: "#dialog",
                source: function(request, response) {
                    $.ajax({
                        type: "post",
                        url: "get_ibu_hamil",
                        data: {
                            search: request.term,
                            _token: $("meta[name=csrf-token]").attr('content')
                        },
                        dataType: "json",
                        success: function(data) {
                            response(data);
                        }
                    });
                },
                select: function(event, ui) {
                    $('#formTambahIbuHamil #inputnik').val(ui.item.nik);
                    $('#formTambahIbuHamil #inputnama_istri').val(ui.item.label);
                    $('#formTambahIbuHamil #inputtanggal_lahir').val(ui.item.tanggal_lahir);
                    $('#formTambahIbuHamil #inputalamat').val(ui.item.alamat);
                    $('#formTambahIbuHamil #inputnomor_telepon').val(ui.item.nomor_telepon);
                    $('#formTambahIbuHamil #inputpekerjaan_istri').val(ui.item.pekerjaan_istri);
                    $('#formTambahIbuHamil #inputnama_suami').val(ui.item.nama_suami);
                    $('#formTambahIbuHamil #inputpekerjaan_suami').val(ui.item.pekerjaan_suami);
                    return false;
                }
            });

            $('#formTambahIbuHamil').submit(function(e) {
                e.preventDefault();
                removeError("TambahIbuHamil");
                let formData = new FormData(this);
                let nik = $("#inputnik").val();

                $.ajax({
                    type: "POST",
                    url: "ibu_hamil",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response === 200) {
                            $('#table_ibu_hamil').DataTable().ajax.reload(null, false);
                            $('#formTambahIbuHamil')[0].reset();
                            $('#modalTambahIbuHamil').modal('toggle');
                            toastr.success('Berhasil Menambah Data Ibu Hamil.');
                            kosongkan();
                        }
                    },
                    error: (response) => {
                        if (response.status == 422) {
                            toastr.error('Gagal Menambah Data Ibu Hamil.');
                            $.each(response.responseJSON.errors, function(index, value) {
                                errorFrom("TambahIbuHamil", index, value);
                            });
                        } else {
                            toastr.error(response.responseJSON.message);
                        }
                    }
                });
            });

            $('#formUbahIbuHamil').submit(function(e) {
                e.preventDefault();
                removeError("UbahIbuHamil");

                let formData = new FormData(this);
                let id = "";

                for (var key of formData.entries()) {
                    if (key[0] == "id") {
                        id = key[1];
                    }
                }

                $.ajax({
                    type: "POST",
                    url: "ibu_hamil/" + id,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response === 200) {
                            $('#table_ibu_hamil').DataTable().ajax.reload(null, false);
                            $('#formUbahIbuHamil')[0].reset();
                            $('#modalUbahIbuHamil').modal('toggle');
                            toastr.success('Berhasil Mengubah Data Ibu Hamil.');
                        }
                    },
                    error: (response) => {
                        toastr.error('Gagal Mengubah Data Ibu Hamil.');
                        $.each(response.responseJSON.errors, function(index, value) {
                            errorFrom("UbahIbuHamil", index, value)
                        });
                    }
                });
            });
        });

        function load_data_ibu_hamil(dari_tannggal = "", sampai_tanggal = "") {
            $("#table_ibu_hamil").DataTable({
                scrollX: true,
                scrollCollapse: true,
                ajax: {
                    url: 'ibu_hamil',
                    data: {
                        dari_tannggal: dari_tannggal,
                        sampai_tanggal: sampai_tanggal
                    }
                },
                columns: [{
                        data: 'ibu_hamil.nik',
                        name: 'ibu_hamil.nik',
                        width: '13%'
                    },
                    {
                        data: 'ibu_hamil.nama_istri',
                        name: 'ibu_hamil.nama_istri',
                        width: '25%'
                    },
                    {
                        data: 'ibu_hamil.nomor_telepon',
                        name: 'ibu_hamil.nomor_telepon',
                        width: '20%'
                    },
                    {
                        data: 'umur_kehamilan',
                    },
                    {
                        data: 'keterangan'
                    },
                    {
                        data: 'aksi',
                        orderable: false,
                        width: '24%'
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

        function ubahDataIbuHamil(id) {
            $.get("ibu_hamil/" + id + "/edit", function(data, textStatus, jqXHR) {
                const d = JSON.parse(atob(data));
                $('#formUbahIbuHamil #inputnik').before(
                    '<input type="text" id="inputid" name="id" class="form-control" value="' + d
                    .id + '">');
                $('#formUbahIbuHamil #inputid').hide();
                $('#formUbahIbuHamil #inputnik').val(d.ibu_hamil.nik);
                $('#formUbahIbuHamil #inputnama_istri').val(d.ibu_hamil.nama_istri);
                $('#formUbahIbuHamil #inputtanggal_lahir').val(d.ibu_hamil.tanggal_lahir);
                $('#formUbahIbuHamil #inputalamat').val(d.ibu_hamil.alamat);
                $('#formUbahIbuHamil #inputnomor_telepon').val(d.ibu_hamil.nomor_telepon);
                $('#formUbahIbuHamil #inputpekerjaan_istri').val(d.ibu_hamil.pekerjaan_istri);
                $('#formUbahIbuHamil #inputnama_suami').val(d.ibu_hamil.nama_suami);
                $('#formUbahIbuHamil #inputpekerjaan_suami').val(d.ibu_hamil.pekerjaan_suami);
                $('#formUbahIbuHamil #inputumur_kehamilan').val(d.umur_kehamilan);
                $('#formUbahIbuHamil #select_tambah_darah').val(d.pemberian_tablet_tambah_darah);
                $('#formUbahIbuHamil #inputhasil_pemeriksaan').val(d.hasil_pemeriksaan);
                $('#formUbahIbuHamil #inputketerangan').val(d.keterangan);
                $('#modalUbahIbuHamil').modal('toggle');
            });
        }

        function hapusDataIbuHamil(id) {
            Swal.fire({
                title: 'Jika kamu menghapus data ibu hamil ini, maka semua data ibu hamil ini akan terhapus?',
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
                        url: "ibu_hamil/delete/" + id,
                        data: {
                            id: id,
                            _token: $("meta[name=csrf-token]").attr('content')
                        },
                        success: function(response) {
                            if (response == 200) {
                                toastr.success("Berhasil Menghapus Data Ibu Hamil.")
                                $('#table_ibu_hamil').DataTable().ajax.reload(null, false);
                            }
                        },
                        error: function(response) {
                            toastr.error('Gagal Menghapus Data Data Ibu Hamil..');
                        }
                    });
                }
            });
        }
    </script>
@endpush
