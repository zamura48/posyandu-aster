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
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalTambahIbuKB">
                            Tambah Data {{ $activePage }}
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    {{-- Aksi Tambahan --}}
                    {{-- <div class="row mb-3">
                        <div class="col-md-4 mt-2">
                            <label for="">Filter Berdasarkan Tanggal Pemeriksaan</label>
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
                            <a href="javascript:void(0)" id="export_excel" class="btn btn-info">Excel</a>
                        </div>
                    </div> --}}

                    {{-- TABEL --}}
                    <table id="table_ibu_kb" class="table table-bordered table-striped text-nowrap">
                        <thead>
                            <tr>
                                <th>NIK</th>
                                <th>Nama Ibu KB</th>
                                <th>Riwayat KB</th>
                                <th>Suntik Awal</th>
                                <th>Suntik Akhir</th>
                                <th>Hasil Pemeriksaan</th>
                                <th>Tanggal Pemeriksaan</th>
                                <th>Nomor Telepon</th>
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

    <div class="modal fade" id="modalTambahIbuKB">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h4 class="modal-title">Tambah Data {{ $activePage }} Baru</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formTambahIbuKB">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <small> Masukkan Nama Ibu KB terlebih dahulu untuk mengecek nama tersebut sudah ada atau
                                    belum.</small>
                            </div>
                            <div class="col-md-3 mb-3">
                                <span class="text-danger">*</span><small> Wajib Diisi</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group" id="dialog">
                                    <label for="inputnama_istri">Nama Ibu KB <span class="text-danger">*</span></label>
                                    <input type="text" id="inputnama_istri" name="nama_istri" class="form-control" placeholder="Contoh: Siti">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="inputnik">NIK <span class="text-danger">*</span></label>
                                    <input type="text" id="inputnik" name="nik" class="form-control"
                                        placeholder="Contoh: 357xxxxxxxxxxxxx">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="inputtanggal_lahir">Tanggal Lahir <span class="text-danger">*</span></label>
                                    <input type="text" id="inputtanggal_lahir" name="tanggal_lahir"
                                        class="form-control datepicker" autocomplete="off" placeholder="Contoh: 1995-02-01">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="inputnomor_telepon">Nomor Telepon <span class="text-danger">*</span></label>
                                    <input type="text" id="inputnomor_telepon" name="nomor_telepon" class="form-control"
                                        placeholder="Contoh: 088217643823">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="inputpekerjaan_istri">Pekerjaan Istri <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="inputpekerjaan_istri" name="pekerjaan_istri"
                                        class="form-control" placeholder="Contoh: Guru">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="inputnama_suami">Nama Suami <span class="text-danger">*</span></label>
                                    <input type="text" id="inputnama_suami" name="nama_suami" class="form-control" placeholder="Contoh: Budi">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="inputpekerjaan_suami">Pekerjaan Suami <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="inputpekerjaan_suami" name="pekerjaan_suami"
                                        class="form-control" placeholder="Swasta">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputalamat">Alamat <span class="text-danger">*</span></label>
                                    <input type="text" id="inputalamat" name="alamat" class="form-control"
                                        placeholder="Contoh: jln. veteran / Gg. Puskesmas">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="inputjumlah_anak">Jumlah Anak </label>
                                    <input type="text" id="inputjumlah_anak" name="jumlah_anak" class="form-control" placeholder="Contoh: 1">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="inputriwayat_kb">Riwayat KB <span class="text-danger">*</span></label>
                                    <input type="text" id="inputriwayat_kb" name="riwayat_kb" class="form-control" placeholder="Contoh: 1">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="inputsuntik_awal">Suntik Awal <span class="text-danger">*</span></label>
                                    <input type="text" id="inputsuntik_awal" name="suntik_awal"
                                        class="form-control datepicker" autocomplete="off" placeholder="Contoh: 2020-10-10">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="inputsuntik_akhir">Suntik Akhir </label>
                                    <input type="text" id="inputsuntik_akhir" name="suntik_akhir"
                                        class="form-control datepicker" autocomplete="off" placeholder="Contoh: 2020-10-10">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputhasil_pemeriksaan">Hasil Pemeriksaan <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="inputhasil_pemeriksaan" name="hasil_pemeriksaan"
                                        class="form-control" placeholder="Sehat">
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

    <div class="modal fade" id="modalUbahIbuKB">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h4 class="modal-title">Ubah Data {{ $activePage }} Baru</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formUbahIbuKB">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <small> Masukkan Nama Ibu KB terlebih dahulu untuk mengecek nama tersebut sudah ada atau
                                    belum.</small>
                            </div>
                            <div class="col-md-3 mb-3">
                                <span class="text-danger">*</span><small> Wajib Diisi</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group" id="dialog">
                                    <label for="inputnama_istri">Nama Ibu KB <span class="text-danger">*</span></label>
                                    <input type="text" id="inputnama_istri" name="nama_istri" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="inputnik">NIK <span class="text-danger">*</span></label>
                                    <input type="text" id="inputnik" name="nik" class="form-control"
                                        placeholder="ex. 1234567890123456">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="inputtanggal_lahir">Tanggal Lahir <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="inputtanggal_lahir" name="tanggal_lahir"
                                        class="form-control datepicker" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="inputnomor_telepon">Nomor Telepon <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="inputnomor_telepon" name="nomor_telepon"
                                        class="form-control" placeholder="ex. 088217643823">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="inputpekerjaan_istri">Pekerjaan Istri <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="inputpekerjaan_istri" name="pekerjaan_istri"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="inputnama_suami">Nama Suami <span class="text-danger">*</span></label>
                                    <input type="text" id="inputnama_suami" name="nama_suami" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="inputpekerjaan_suami">Pekerjaan Suami <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="inputpekerjaan_suami" name="pekerjaan_suami"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputalamat">Alamat <span class="text-danger">*</span></label>
                                    <input type="text" id="inputalamat" name="alamat" class="form-control"
                                        placeholder="ex. jln. veteran">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="inputjumlah_anak">Jumlah Anak <span class="text-danger">*</span></label>
                                    <input type="text" id="inputjumlah_anak" name="jumlah_anak" class="form-control">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="inputriwayat_kb">Riwayat KB <span class="text-danger">*</span></label>
                                    <input type="text" id="inputriwayat_kb" name="riwayat_kb" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="inputsuntik_awal">Suntik Awal <span class="text-danger">*</span></label>
                                    <input type="text" id="inputsuntik_awal" name="suntik_awal"
                                        class="form-control datepicker" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="inputsuntik_akhir">Suntik Akhir <span class="text-danger">*</span></label>
                                    <input type="text" id="inputsuntik_akhir" name="suntik_akhir"
                                        class="form-control datepicker" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputhasil_pemeriksaan">Hasil Pemeriksaan <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="inputhasil_pemeriksaan" name="hasil_pemeriksaan"
                                        class="form-control">
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
    <!-- /.modal ubah -->
@endsection

@push('js')
    <script>
        $(function() {
            load_data_ibukb();

            $("#inputtanggal_lahir").datepicker({
                format: "yyyy-mm-dd",
                autoclose: true
            });
            $("#formTambahIbuKB .datepicker").datepicker({
                format: "yyyy-mm-dd",
                autoclose: true
            });
            $("#formUbahIbuKB .datepicker").datepicker({
                format: "yyyy-mm-dd",
                autoclose: true
            });

            $("#formTambahIbuKB #inputnama_istri").autocomplete({
                appendTo: "#dialog",
                source: function(request, response) {
                    $.ajax({
                        type: "post",
                        url: "get_ibu_kb",
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
                    $('#formTambahIbuKB #inputnik').val(ui.item.nik);
                    $('#formTambahIbuKB #inputnama_istri').val(ui.item.label);
                    $('#formTambahIbuKB #inputtanggal_lahir').val(ui.item.tanggal_lahir);
                    $('#formTambahIbuKB #inputalamat').val(ui.item.alamat);
                    $('#formTambahIbuKB #inputnomor_telepon').val(ui.item.nomor_telepon);
                    $('#formTambahIbuKB #inputpekerjaan_istri').val(ui.item.pekerjaan_istri);
                    $('#formTambahIbuKB #inputnama_suami').val(ui.item.nama_suami);
                    $('#formTambahIbuKB #inputpekerjaan_suami').val(ui.item.pekerjaan_suami);
                    $('#formTambahIbuKB #inputjumlah_anak').val(ui.item.jumlah_anak);
                    return false;
                }
            });

            $('#formTambahIbuKB').submit(function(e) {
                e.preventDefault();
                removeError("TambahIbuKB");

                let formData = new FormData(this);

                $.ajax({
                    type: "POST",
                    url: "ibu_kb",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response === 200) {
                            $('#table_ibu_kb').DataTable().ajax.reload(null, false);
                            $('#formTambahIbuKB')[0].reset();
                            $('#modalTambahIbuKB').modal('toggle');
                            toastr.success('Berhasil Menambah Data Ibu KB.');
                            kosongkan();
                        }
                    },
                    error: (response) => {
                        if (response.status == 422) {
                            toastr.error('Gagal Menambah Data Ibu KB.');
                            $.each(response.responseJSON.errors, function(index, value) {
                                errorFrom("TambahIbuKB", index, value);
                            });
                        } else {
                            toastr.error(response.responseJSON.message);
                        }
                    }
                });
            });

            $('#formUbahIbuKB').submit(function(e) {
                e.preventDefault();
                removeError("UbahIbuKB");

                let formData = new FormData(this);
                let id = "";

                for (var key of formData.entries()) {
                    if (key[0] == "id") {
                        id = key[1];
                    }
                }

                $.ajax({
                    type: "POST",
                    url: "ibu_kb/" + id,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response === 200) {
                            $('#table_ibu_kb').DataTable().ajax.reload(null,
                                false);
                            $('#formUbahIbuKB')[0].reset();
                            $('#modalUbahIbuKB').modal('toggle');
                            toastr.success('Berhasil Mengubah Data Ibu KB.');
                        }
                    },
                    error: (response) => {
                        if (response.status == 422) {
                            toastr.error('Gagal Mengubah Data Ibu KB.');
                            $.each(response.responseJSON.errors, function(index, value) {
                                errorFrom("UbahIbuKB", index, value);
                            });
                        } else {
                            toastr.error(response.responseJSON.message);
                        }
                    }
                });
            });
        });

        function load_data_ibukb(dari_tannggal = "", sampai_tanggal = "") {
            $("#table_ibu_kb").DataTable({
                scrollX: true,
                fixedColumns: {
                    left: 1
                },
                ajax: {
                    url: 'ibu_kb',
                    // dari_tannggal: dari_tannggal,
                    // sampai_tanggal: sampai_tanggal
                },
                columns: [{
                        data: 'ibu_kb.nik',
                        name: 'ibu_kb.nik'
                    },
                    {
                        data: 'ibu_kb.nama_istri',
                        name: 'ibu_kb.nama_istri'
                    },
                    {
                        data: 'riwayat_kb',
                    },
                    {
                        data: 'suntik_awal'
                    },
                    {
                        data: 'suntik_akhir'
                    },
                    {
                        data: 'hasil_pemeriksaan'
                    },
                    {
                        data: 'suntik_awal',
                    },
                    {
                        data: 'ibu_kb.nomor_telepon',
                        name: 'ibu_kb.nomor_telepon'
                    },
                    {
                        data: 'aksi',
                        orderable: false,
                    }
                ]
            });
        }

        function ubahDataIbuKB(id) {
            $.get("ibu_kb/" + id + "/edit", function(data, textStatus, jqXHR) {
                const d = JSON.parse(atob(data));
                // console.log(d);
                $('#formUbahIbuKB #inputnik').before(
                    '<input type="text" id="inputid" name="id" class="form-control" value="' + d
                    .id + '">');
                $('#formUbahIbuKB #inputid').hide();
                $('#formUbahIbuKB #inputnik').val(d.ibu_kb.nik);
                $('#formUbahIbuKB #inputnama_istri').val(d.ibu_kb.nama_istri);
                $('#formUbahIbuKB #inputtanggal_lahir').val(d.ibu_kb.tanggal_lahir);
                $('#formUbahIbuKB #inputalamat').val(d.ibu_kb.alamat);
                $('#formUbahIbuKB #inputnomor_telepon').val(d.ibu_kb.nomor_telepon);
                $('#formUbahIbuKB #inputpekerjaan_istri').val(d.ibu_kb.pekerjaan_istri);
                $('#formUbahIbuKB #inputnama_suami').val(d.ibu_kb.nama_suami);
                $('#formUbahIbuKB #inputpekerjaan_suami').val(d.ibu_kb.pekerjaan_suami);
                $('#formUbahIbuKB #inputjumlah_anak').val(d.ibu_kb.jumlah_anak);
                // riwayat kb
                $('#formUbahIbuKB #inputriwayat_kb').val(d.riwayat_kb);
                $('#formUbahIbuKB #inputsuntik_awal').val(d.suntik_awal);
                $('#formUbahIbuKB #inputsuntik_akhir').val(d.suntik_akhir);
                $('#formUbahIbuKB #inputhasil_pemeriksaan').val(d.hasil_pemeriksaan);
                $('#modalUbahIbuKB').modal('toggle');
            });
        }

        function hapusDataIbuKB(id) {
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
                        url: "ibu_kb/delete/" + id,
                        data: {
                            id: id,
                            _token: $("meta[name=csrf-token]").attr('content')
                        },
                        success: function(response) {
                            if (response == 200) {
                                toastr.success('Berhasil Menghapus Data Ibu KB.');
                                $('#table_ibu_kb').DataTable().ajax.reload(null, false);
                            }
                        },
                        error: (response) => {
                            if (response.status == 422) {
                                toastr.error('Gagal Menghapus Data Ibu KB.');
                            } else {
                                toastr.error(response.responseJSON.message);
                            }
                        }
                    });
                }
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
    </script>
@endpush
