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
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalTambahBalita">
                            Tambah Data {{ $activePage }}
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="table-balita" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Umur</th>
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

    <div class="modal fade" id="modalTambahBalita">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h4 class="modal-title">Tambah Data {{ $activePage }} Baru</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formTambahBalita">
                    @csrf
                    <div class="modal-body">
                        <h4>Balita</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnik">NIK Balita</label>
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
                                    <label for="selectjenis_kelamin">Jenis Kelamin</label>
                                    <select class="custom-select rounded-0" id="selectjenis_kelamin" name="jenis_kelamin">
                                        <option value=""></option>
                                        <option value="Laki-Laki">Laki-Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h4>Orang Tua / Wali</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group" id="dialog">
                                    <label for="inputnama_ayah">Nama Ayah</label>
                                    <input type="text" id="inputnama_ayah" name="nama_ayah" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnama_ibu">Nama Ibu</label>
                                    <input type="text" id="inputnama_ibu" name="nama_ibu" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnomor_telepon">Nomor Telepon</label>
                                    <input type="text" id="inputnomor_telepon" name="nomor_telepon" class="form-control">
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

    <div class="modal fade" id="modalUbahBalita">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h4 class="modal-title">Ubah Data {{ $activePage }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formUbahBalita">
                    @csrf
                    <div class="modal-body">
                        <h4>Balita</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnik">NIK Balita</label>
                                    <input type="text" id="inputid" hidden name="id" class="form-control">
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
                                    <label for="selectjenis_kelamin">Jenis Kelamin</label>
                                    <select class="custom-select rounded-0" id="selectjenis_kelamin" name="jenis_kelamin">
                                        <option value=""></option>
                                        <option value="Laki-Laki">Laki-Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h4>Orang Tua / Wali</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnama_ayah">Nama Ayah</label>
                                    <input type="text" id="inputnama_ayah" name="nama_ayah" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnama_ibu">Nama Ibu</label>
                                    <input type="text" id="inputnama_ibu" name="nama_ibu" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnomor_telepon">Nomor Telepon</label>
                                    <input type="text" id="inputnomor_telepon" name="nomor_telepon" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-warning">Perbarui</button>
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
            $('#selectjenis_kelamin').select2({
                theme: 'bootstrap4',
                placeholder: 'Pilih Jenis Kelamin'
            });

            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            $("#table-balita").DataTable({
                scrollX: true,
                scrollCollapse: true,
                fixedColumns: {
                    left: 1
                },
                ajax: 'balita',
                columns: [{
                        data: 'nik',
                        name: 'nik',
                        width: '13%'
                    },
                    {
                        data: 'nama_lengkap',
                        name: 'nama_lengkap'
                    },
                    {
                        data: 'jenis_kelamin',
                        name: 'jenis_kelamin',
                        width: '14%'
                    },
                    {
                        data: 'umur'
                        // data: 'tanggal_lahir',
                        // render: function(data, type, row) {
                        //     // var ageInMilliseconds = new Date() - new Date(data);
                        //     // var age = Math.floor(ageInMilliseconds / 100 / 60 / 60 / 24 / 365);

                        //     var currentDate = new Date().getFullYear();
                        //     var birthDay = new Date(data).getFullYear();
                        //     var age = currentDate - birthDay
                        //     if (age < 1) {
                        //         return 'Kurang dari 1 Tahun';
                        //     } else {
                        //         return age + ' Tahun';
                        //     }
                        // }
                    },
                    {
                        data: 'aksi',
                        orderable: false,
                        width: '24%'
                    }
                ]
            });

            $("#formTambahBalita #inputnama_ayah").autocomplete({
                appendTo: "#dialog",
                source: function(request, response) {
                    $.ajax({
                        type: "post",
                        url: "nama_ayah",
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
                    $('#formTambahBalita #inputnama_ayah').val(ui.item.label);
                    $('#formTambahBalita #inputnama_ibu').val(ui.item.nama_ibu);
                    $('#formTambahBalita #inputnomor_telepon').val(ui.item.nomor_telepon);
                    return false;
                }
            });

            $("#formTambahBalita").submit(function(e) {
                e.preventDefault();

                var formData = new FormData(this);

                $.ajax({
                    type: "POST",
                    url: "balita",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status == 200) {
                            $("#table-balita").DataTable().ajax.reload(null, false);
                            $("#modalTambahBalita").modal('toggle');
                            $("#formTambahBalita")[0].reset();
                            Toast.fire({
                                icon: 'success',
                                title: 'Berhasil Menambah Data Kader Baru.'
                            });
                        }
                    },
                    error: function(response) {
                        if (response.responseJSON.errors) {
                            $.each(response.responseJSON.errors, function(index, value) {
                                if ($("#formTambahBalita #input" + index).length) {
                                    $("#formTambahBalita #input" + index)
                                        .addClass(
                                            'is-invalid').after(
                                            '<span id="input' +
                                            index +
                                            '-error" class="error invalid-feedback">' +
                                            value + '</span>');
                                } else {
                                    $("#formTambahBalita #select" + index)
                                        .addClass('is-invalid');
                                    $("#formTambahBalita .select2").after(
                                        '<span style="color: #dc3545;" class="text-sm">' +
                                        value + '</span>');
                                }
                            });
                        }
                    }
                });
            });

            $("#formUbahBalita").submit(function(e) {
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
                    url: "balita/" + id,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response == 200) {
                            $("#table-balita").DataTable().ajax.reload(null, false);
                            $("#modalUbahBalita").modal('toggle');
                            $("#formUbahBalita")[0].reset();
                            Toast.fire({
                                icon: 'success',
                                title: 'Berhasil Mengubah Data Kader.'
                            });
                        }
                    },
                    error: function(response) {
                        $.each(response.responseJSON.errors, function(index, value) {
                            if ($("#formUbahBalita #input" + index).length) {
                                $("#formUbahBalita #input" + index)
                                    .addClass(
                                        'is-invalid').after(
                                        '<span id="input' +
                                        index +
                                        '-error" class="error invalid-feedback">' +
                                        value + '</span>');
                            } else {
                                $("#formUbahBalita #select" + index)
                                    .addClass('is-invalid');
                                $("#formUbahBalita .select2").after(
                                    '<span style="color: #dc3545;" class="text-sm">' +
                                    value + '</span>');
                            }
                        });
                    }
                });
            });
        });

        function detailDataBalita(id) {
            window.location.href = "balita/" + id;
        }

        function ubahDataBalita(id) {
            $.get("balita/" + id + "/edit", function(data) {
                $("#formUbahBalita #inputid").val(data.id);
                $("#formUbahBalita #inputnik").val(data.nik);
                $("#formUbahBalita #inputnama_lengkap").val(data.nama_lengkap);
                $("#formUbahBalita #inputtanggal_lahir").val(data.tanggal_lahir);
                $("#formUbahBalita #selectjenis_kelamin").val(data.jenis_kelamin);
                $("#formUbahBalita #inputnama_ayah").val(data.ibubalita.nama_ayah);
                $("#formUbahBalita #inputnama_ibu").val(data.ibubalita.nama_ibu);
                $("#formUbahBalita #inputnomor_telepon").val(data.ibubalita.nomor_telepon);
                $("#modalUbahBalita").modal('toggle');
            })
        };

        function hapusDataBalita(id) {
            $.ajax({
                type: "POST",
                url: "balita/delete/" + id,
                data: {
                    id: id,
                    _token: $("meta[name=csrf-token]").attr('content')
                },
                success: function(response) {
                    if (response == 200) {
                        $("#table-balita").DataTable().ajax.reload(null, false);
                    }
                }
            });
        }
    </script>
@endpush
