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
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
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
                        <button type="button" class="btn btn-success" data-toggle="modal"
                            data-target="#modalTambahKeuanganPMT">
                            Tambah Data {{ $activePage }}
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="table_keuangan_pmt" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Uang Masuk</th>
                                <th>Tanggal Masuk</th>
                                <th>Uang Keluar</th>
                                <th>Tanggal Keluar</th>
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

    <div class="modal fade" id="modalTambahKeuanganPMT">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h4 class="modal-title">Tambah Data {{ $activePage }} Baru</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formTambahKeuanganPMT">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputuang_masuk">Uang Masuk</label>
                                    <input type="text" id="inputuang_masuk" name="uang_masuk" class="form-control"
                                        autofocus>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputtanggal_masuk">Tanggal Masuk</label>
                                    <input type="text" id="inputtanggal_masuk" name="tanggal_masuk"
                                        class="form-control datepicker" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputuang_keluar">Uang Keluar</label>
                                    <input type="text" id="inputuang_keluar" name="uang_keluar" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputtanggal_keluar">Tanggal Keluar</label>
                                    <input type="text" id="inputtanggal_keluar" name="tanggal_keluar"
                                        class="form-control datepicker" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea class="form-control" rows="3" id="inputketerangan" name="keterangan"
                                        placeholder="Masukkan keterangan uang digunkan untuk apa ..."></textarea>
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

    <div class="modal fade" id="modalUbahKeuanganPMT">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h4 class="modal-title">Ubah Data {{ $activePage }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formUbahKeuanganPMT">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputuang_masuk">Uang Masuk</label>
                                    <input type="text" id="inputid" name="id" class="form-control">
                                    <input type="text" id="inputuang_masuk" name="uang_masuk" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputtanggal_masuk">Tanggal Masuk</label>
                                    <input type="text" id="inputtanggal_masuk" name="tanggal_masuk"
                                        class="form-control datepicker" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputuang_keluar">Uang Keluar</label>
                                    <input type="text" id="inputuang_keluar" name="uang_keluar" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputtanggal_keluar">Tanggal Keluar</label>
                                    <input type="text" id="inputtanggal_keluar" name="tanggal_keluar"
                                        class="form-control datepicker" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputketerangan">Keterangan</label>
                                    <input type="text" id="inputketerangan" name="keterangan" class="form-control">
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
            $(".datepicker").datepicker({
                format: "yyyy-mm-dd",
                autoclose: true
            });

            load_data_keuangan_pmt();

            $("#formTambahKeuanganPMT").submit(function(e) {
                e.preventDefault();
                removeError("TambahKeuanganPMT");
                var formData = new FormData(this);

                $.ajax({
                    type: "POST",
                    url: "keuangan_pmt",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response == 200) {
                            $("#table_keuangan_pmt").DataTable().ajax.reload(null, false);
                            $("#modalTambahKeuanganPMT").modal('toggle');
                            $('#formTambahKeuanganPMT')[0].reset();
                            toastr.success('Berhasil Menambah Data Keuangan PMT.');
                        }
                    },
                    error: (response) => {
                        toastr.error('Gagal Menambah Data Keuangan PMT Baru.');
                        $.each(response.responseJSON.errors, function(index, value) {
                            errorFrom("TambahKeuanganPMT", index, value);
                        });
                    }
                });
            });

            $("#formUbahKeuanganPMT").submit(function(e) {
                e.preventDefault();
                removeError("UbahKeuanganPMT");
                var formData = new FormData(this);
                var id = "";

                for (var key of formData.entries()) {
                    if (key[0] == "id") {
                        id = key[1];
                    }
                }

                $.ajax({
                    type: "POST",
                    url: "keuangan_pmt/" + id,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response == 200) {
                            $("#table_keuangan_pmt").DataTable().ajax.reload(null, false);
                            $("#modalUbahKeuanganPMT").modal('toggle');
                            $("#formUbahKeuanganPMT")[0].reset();
                            toastr.success('Berhasil Menambah Data Keuangan PMT.');
                        }
                    },
                    error: (response) => {
                        toastr.error('Gagal Menambah Data Keuangan PMT.');
                        $.each(response.responseJSON.errors, function(index, value) {
                            errorFrom("UbahKeuanganPMT", index, value);
                        });
                    }
                });
            });
        });

        function load_data_keuangan_pmt() {
            $('#table_keuangan_pmt').DataTable({
                scrollX: true,
                scrollCollapse: true,
                fixedColumns: {
                    left: 1
                },
                ajax: 'keuangan_pmt',
                columns: [{
                        data: 'uang_masuk',
                        name: 'uang_masuk',
                        width: '20%'
                    },
                    {
                        data: 'tanggal_masuk',
                        name: 'tanggal_masuk',
                        width: '20%'
                    },
                    {
                        data: 'uang_keluar',
                        name: 'uang_keluar',
                        width: '20%'
                    },
                    {
                        data: 'tanggal_keluar',
                        name: 'tanggal_keluar',
                        width: '20%'
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan',
                        width: '20%'
                    },
                    {
                        data: 'aksi',
                        orderable: false,
                    }
                ]
            });
        }

        function ubahDataKeuanganPMT(id) {
            $.get("keuangan_pmt/" + id + "/edit", function(data) {
                const d = JSON.parse(atob(data));
                $("#formUbahKeuanganPMT #inputid").val(btoa(d.id)).hide();
                $("#formUbahKeuanganPMT #inputuang_masuk").val(d.uang_masuk);
                $("#formUbahKeuanganPMT #inputtanggal_masuk").val(d.tanggal_masuk);
                $("#formUbahKeuanganPMT #inputuang_keluar").val(d.uang_keluar);
                $("#formUbahKeuanganPMT #inputtanggal_keluar").val(d.tanggal_keluar);
                $("#formUbahKeuanganPMT #inputketerangan").val(d.keterangan);
                $("#modalUbahKeuanganPMT").modal('toggle');
            });
        }

        function hapusDataKeuanganPMT(id) {
            Swal.fire({
                title: 'Apakah kamu yakin, menghapus data ini ?',
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
                        url: "keuangan_pmt/delete/" + id,
                        data: {
                            id: id,
                            _token: $("meta[name=csrf-token]").attr('content')
                        },
                        success: function(response) {
                            if (response == 200) {
                                toastr.success('Berhasil Menghapus Data KeuanganPMT.');
                                $("#table_keuangan_pmt").DataTable().ajax.reload(null, false);
                            }
                        },
                        error: (response) => {
                            toastr.error(response.responseJSON.message);
                        }
                    });
                }
            })
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
