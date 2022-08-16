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
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalTambahKader">
                            Tambah Data {{ $activePage }}
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="table-kader" class="table table-bordered table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Posisi</th>
                                <th>RT</th>
                                <th>RW</th>
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

    <div class="modal fade" id="modalTambahKader">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h4 class="modal-title">Tambah Data {{ $activePage }} Baru</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formTambahKader">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnik">NIK <span class="text-danger">*</span></label>
                                    <input type="text" id="inputnik" name="nik" class="form-control" placeholder="Contoh: 1234567890123456">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnama_lengkap">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" id="inputnama_lengkap" name="nama_lengkap" class="form-control" placeholder="Contoh: Siti">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputtanggal_lahir">Tanggal Lahir <span class="text-danger">*</span></label>
                                    <input type="text" id="inputtanggal_lahir" name="tanggal_lahir" class="form-control datepicker" autocomplete="off" placeholder="Contoh: 1999-11-11">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="inputalamat">Alamat <span class="text-danger">*</span></label>
                                    <input type="text" id="inputalamat" name="alamat" class="form-control" placeholder="Contoh: Jl. KH. Hasyim">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="inputrt">RT <span class="text-danger">*</span></label>
                                    <input type="text" id="inputrt" name="rt" class="form-control" placeholder="Contoh: 3">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="inputrw">RW <span class="text-danger">*</span></label>
                                    <input type="text" id="inputrw" name="rw" class="form-control" placeholder="Contoh: 9">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="inputnomor_telepon">Nomor Telepon <span class="text-danger">*</span></label>
                                    <input type="text" id="inputnomor_telepon" name="nomor_telepon" class="form-control" placeholder="Contoh: 088217643823">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="selectrole">Role <span class="text-danger">*</span></label>
                                    <select class="custom-select rounded-0" id="selectrole" name="role">
                                        <option value=""></option>
                                        <option value="Ketua">Ketua</option>
                                        <option value="Kader">Kader</option>
                                    </select>
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

    <div class="modal fade" id="modalUbahKader">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h4 class="modal-title">Ubah Data {{ $activePage }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formUbahKader">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnik">NIK <span class="text-danger">*</span></label>
                                    <input type="text" id="inputid" name="id" class="form-control">
                                    <input type="text" id="inputnik" name="nik" class="form-control" placeholder="Contoh: 1234567890123456">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnama_lengkap">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" id="inputnama_lengkap" name="nama_lengkap" class="form-control" placeholder="Contoh: Siti">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputtanggal_lahir">Tanggal Lahir <span class="text-danger">*</span></label>
                                    <input type="text" id="inputtanggal_lahir" name="tanggal_lahir" class="form-control datepicker" autocomplete="off" placeholder="Contoh: 1999-11-11">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="inputalamat">Alamat <span class="text-danger">*</span></label>
                                    <input type="text" id="inputalamat" name="alamat" class="form-control" placeholder="Contoh: Jl. KH. Hasyim">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="inputrt">RT <span class="text-danger">*</span></label>
                                    <input type="text" id="inputrt" name="rt" class="form-control" placeholder="Contoh: 3">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="inputrw">RW <span class="text-danger">*</span></label>
                                    <input type="text" id="inputrw" name="rw" class="form-control" placeholder="Contoh: 9">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="inputnomor_telepon">Nomor Telepon <span class="text-danger">*</span></label>
                                    <input type="text" id="inputnomor_telepon" name="nomor_telepon" class="form-control" placeholder="Contoh: 088217643823">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="selectrole">Role <span class="text-danger">*</span></label>
                                    <select class="custom-select rounded-0" id="selectrole" name="role">
                                        <option value=""></option>
                                        <option value="Ketua">Ketua</option>
                                        <option value="Kader">Kader</option>
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
            $(".datepicker").datepicker({
                format: "yyyy-mm-dd",
                autoclose: true
            });

            $("#selectrole").select2({
                theme: 'bootstrap4',
                placeholder: 'Pilih Role / Posisi',
                minimumResultsForSearch: -1
            });

            $('#table-kader').DataTable({
                scrollX: true,
                scrollCollapse: true,
                ajax: 'kader',
                columns: [{
                        data: 'nik',
                        name: 'nik',
                        width: '20%'
                    },
                    {
                        data: 'nama_istri',
                        name: 'nama_istri',
                        width: '20%'
                    },
                    {
                        data: 'user.role',
                        name: 'user.role',
                        width: '15%'
                    },
                    {
                        data: 'rt',
                        name: 'rt',
                        width: '15%'
                    },
                    {
                        data: 'rw',
                        name: 'rw',
                        width: '15%'
                    },
                    {
                        data: 'aksi',
                        orderable: false,
                        width: '16%'
                    }
                ]
            });

            $("#formTambahKader").submit(function(e) {
                e.preventDefault();
                removeError("TambahKader");
                var formData = new FormData(this);

                $.ajax({
                    type: "POST",
                    url: "kader",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response == 200) {
                            $("#table-kader").DataTable().ajax.reload(null, false);
                            $("#modalTambahKader").modal('toggle');
                            $('#formTambahKader')[0].reset();
                            toastr.success('Berhasil Menambah Data Kader Baru.');
                        }
                    },
                    error: (response) => {
                        if (response.status == 422) {
                            toastr.error('Gagal Menambah Data Kader.');
                            $.each(response.responseJSON.errors, function(index, value) {
                                errorFrom("TambahKader", index, value);
                            });
                        } else {
                            toastr.error(response.responseJSON.message);
                        }
                    }
                });
            });

            $("#formUbahKader").submit(function(e) {
                e.preventDefault();
                removeError("UbahKader");
                var formData = new FormData(this);
                var id = "";

                for (var key of formData.entries()) {
                    if (key[0] == "id") {
                        id = key[1];
                    }
                }

                $.ajax({
                    type: "POST",
                    url: "kader/" + id,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response == 200) {
                            $("#table-kader").DataTable().ajax.reload(null, false);
                            $("#modalUbahKader").modal('toggle');
                            $("#formUbahKader")[0].reset();
                            toastr.success('Berhasil Mengubah Data Kader.');
                        }
                    },
                    error: (response) => {
                        if (response.status = 422) {
                            toastr.error('Gagal Mengubah Data Kader.');
                            $.each(response.responseJSON.errors, function(index, value) {
                                errorFrom("UbahKader", index, value);
                            });
                        } else {
                            toastr.error(response.responseJSON.message);
                        }
                    }
                });
            });
        });

        function ubahDataKader(id) {
            $.get("kader/" + id + "/edit",
                function(data) {
                    const d = JSON.parse(atob(data));
                    $("#formUbahKader #inputid").val(btoa(d.id)).hide();
                    $("#formUbahKader #inputnik").val(d.nik);
                    $("#formUbahKader #inputnama_lengkap").val(d.nama_istri);
                    $("#formUbahKader #inputtanggal_lahir").val(d.tanggal_lahir);
                    $("#formUbahKader #inputalamat").val(d.alamat);
                    $("#formUbahKader #inputnomor_telepon").val(d.nomor_telepon);
                    $("#formUbahKader #inputrt").val(d.rt);
                    $("#formUbahKader #inputrw").val(d.rw);
                    $("#formUbahKader #selectrole").val(d.user.role);
                    $("#modalUbahKader").modal('toggle');
                }
            );
        }

        function hapusDataKader(id) {
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
                        url: "kader/delete/" + id,
                        data: {
                            id: id,
                            _token: $("meta[name=csrf-token]").attr('content')
                        },
                        success: function(response) {
                            if (response == 200) {
                                toastr.success('Berhasil Menghapus Data Kader.');
                                $("#table-kader").DataTable().ajax.reload(null, false);
                            }
                        },
                        error: (response) => {
                            if (response.status == 422) {
                                toastr.error('Gagal Menghapus Data Kader.');
                            } else {
                            toastr.error(response.responseJSON.message);
                        }
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
