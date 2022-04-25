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
                    <table id="table-kader" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Posisi</th>
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
                                    <label for="inputnik">NIK</label>
                                    <input type="text" id="inputnik" name="nik" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnama_lengkap">Nama Lengkap</label>
                                    <input type="text" id="inputnama_lengkap" name="nama_lengkap" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputtanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" id="inputtanggal_lahir" name="tanggal_lahir" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputalamat">Alamat</label>
                                    <input type="text" id="inputalamat" name="alamat" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnomor_telepon">Nomor Telepon</label>
                                    <input type="text" id="inputnomor_telepon" name="nomor_telepon" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="selectrole">Role</label>
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
                                    <label for="inputnik">NIK</label>
                                    <input type="text" id="inputid" name="id" class="form-control">
                                    <input type="text" id="inputnik" name="nik" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnama_lengkap">Nama Lengkap</label>
                                    <input type="text" id="inputnama_lengkap" name="nama_lengkap" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputtanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" id="inputtanggal_lahir" name="tanggal_lahir" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputalamat">Alamat</label>
                                    <input type="text" id="inputalamat" name="alamat" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnomor_telepon">Nomor Telepon</label>
                                    <input type="text" id="inputnomor_telepon" name="nomor_telepon" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="selectrole">Role</label>
                                    <select class="custom-select rounded-0" id="selectrole" name="role">
                                        <option value="Ketua">Ketua</option>
                                        <option value="Kader">Kader</option>
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="col-md-4" id="switch_user">
                                <div class="form-group">
                                    <label for="selectrole">User Aktif</label>
                                </div>
                            </div> --}}
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
            $("#selectrole").select2({
                theme: 'bootstrap4',
                placeholder: 'Pilih Role / Posisi'
            });

            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            $('#table-kader').DataTable({
                scrollX: true,
                scrollCollapse: true,
                fixedColumns: {
                    left: 1
                },
                ajax: 'kader',
                columns: [{
                        data: 'nik',
                        name: 'nik',
                        width: '15%'
                    },
                    {
                        data: 'nama_lengkap',
                        name: 'nama_lengkap'
                    },
                    {
                        data: 'user.role',
                        name: 'user.role'
                    },
                    {
                        data: 'nomor_telepon',
                        name: 'nomor_telepon',
                        orderable: false
                    },
                    {
                        data: 'aksi',
                        width: '24%',
                        orderable: false
                    }
                ]
            });

            $("#formTambahKader").submit(function(e) {
                e.preventDefault();

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
                            Toast.fire({
                                icon: 'success',
                                title: 'Berhasil Menambah Data Kader Baru.'
                            });
                        }
                    },
                    error: (response) => {
                        if (response.responseJSON.errors) {
                            $.each(response.responseJSON.errors, function(index, value) {
                                if ($("#formTambahKader #input" + index).length) {
                                    $("#formTambahKader #input" + index).addClass(
                                        'is-invalid').after('<span id="input' +
                                        index +
                                        '-error" class="error invalid-feedback">' +
                                        value + '</span>');
                                } else {
                                    $("#formTambahKader #select" + index)
                                        .addClass('is-invalid');
                                    $("#formTambahKader .select2").after(
                                        '<span style="color: #dc3545;" class="text-sm">' +
                                        value + '</span>');
                                }
                            });
                        }
                    }
                });
            });

            $("#formUbahKader").submit(function(e) {
                e.preventDefault();

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
                            Toast.fire({
                                icon: 'success',
                                title: 'Berhasil Mengubah Data Kader.'
                            });
                        }
                    },
                    error: (response) => {
                        if (response.responseJSON.errors) {
                            $.each(response.responseJSON.errors, function(index, value) {
                                if ($("#formUbahKader #input" + index).length) {
                                    $("#formUbahKader #input" + index).addClass(
                                        'is-invalid').after('<span id="input' +
                                        index +
                                        '-error" class="error invalid-feedback">' +
                                        value + '</span>');
                                } else {
                                    $("#formUbahKader #select" + index)
                                        .addClass('is-invalid');
                                    $("#formUbahKader .select2").after(
                                        '<span style="color: #dc3545;" class="text-sm">' +
                                        value + '</span>');
                                }
                            });
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
                    $("#formUbahKader #inputnama_lengkap").val(d.nama_lengkap);
                    $("#formUbahKader #inputtanggal_lahir").val(d.tanggal_lahir);
                    $("#formUbahKader #inputalamat").val(d.alamat);
                    $("#formUbahKader #inputnomor_telepon").val(d.nomor_telepon);
                    $("#formUbahKader #selectrole").val(d.user.role);
                    $("#modalUbahKader").modal('toggle');
                }
            );
        }

        function hapusDataKader(id) {
            $.ajax({
                type: "POST",
                url: "kader/delete/" + id,
                data: {
                    id: id,
                    _token: $("meta[name=csrf-token]").attr('content')
                },
                success: function(response) {
                    if (response == 200) {
                        $("#table-kader").DataTable().ajax.reload(null, false);
                    }
                }
            });
        }
    </script>
@endpush
