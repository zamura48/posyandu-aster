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
                                    <label for="inputnik">NIK Balita <span class="text-danger">*</span></label>
                                    <input type="text" id="inputnik" name="nik" class="form-control" placeholder="Contoh: 357xxxxxxxxxxxxx">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnama_lengkap">Nama Lengkap <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="inputnama_lengkap" name="nama_lengkap" class="form-control" placeholder="Contoh: Taufik Nasrullah">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputtanggal_lahir">Tanggal Lahir <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="inputtanggal_lahir" name="tanggal_lahir" class="form-control datepicker" autocomplete="off" placeholder="Contoh: 2020-02-14">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group" id="jenis_kelamin">
                                    <label for="selectjenis_kelamin">Jenis Kelamin <span
                                            class="text-danger">*</span></label>
                                    <select class="custom-select rounded-0" id="selectjenis_kelamin" name="jenis_kelamin">
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
                                    <select class="custom-select rounded-0" id="selectproses_lahiran" name="proses_lahiran">
                                        <option value=""></option>
                                        <option value="Normal">Normal</option>
                                        <option value="SC">SC</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="inputbbl">BBL (gram)</label>
                                    <input type="text" id="inputbbl" name="bbl" class="form-control" placeholder="Contoh: 2500">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="inputpb">PB (cm)</label>
                                    <input type="text" id="inputpb" name="pb" class="form-control" placeholder="Contoh: 45">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputtempat_lahir">Tempat Lahir (RS)</label>
                                    <input type="text" id="inputtempat_lahir" name="tempat_lahir" class="form-control" placeholder="Contoh: RS. Gambiran">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h4>Orang Tua / Wali</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnik_istri">NIK Ibu <span class="text-danger">*</span></label>
                                    <input type="text" id="inputnik_istri" name="nik_istri" class="form-control" placeholder="Contoh: 357xxxxxxxxxxxxx">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnama_ibu">Nama Ibu <span class="text-danger">*</span></label>
                                    <input type="text" id="inputnama_ibu" name="nama_ibu" class="form-control" placeholder="Contoh: Siti">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group" id="dialog">
                                    <label for="inputnama_ayah">Nama Ayah <span class="text-danger">*</span></label>
                                    <input type="text" id="inputnama_ayah" name="nama_ayah" class="form-control" placeholder="Contoh: Budi">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnomor_telepon">Nomor Telepon <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="inputnomor_telepon" name="nomor_telepon" class="form-control" placeholder="Contoh: 088217643823">
                                </div>
                            </div>
                            @php
                                $rtrw = auth()->user()->getRtRw();
                            @endphp
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="inputrt">RT <span class="text-danger">*</span></label>
                                    <input type="text" id="inputrt" name="rt" class="form-control" placeholder="Contoh: 3" value="{{ $rtrw['rt'] }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="inputrw">RW <span class="text-danger">*</span></label>
                                    <input type="text" id="inputrw" name="rw" class="form-control" placeholder="Contoh: 9" value="{{ $rtrw['rw'] }}">
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
                                    <label for="inputnik">NIK Balita <span class="text-danger">*</span></label>
                                    <input type="text" id="inputid" hidden name="id" class="form-control">
                                    <input type="text" id="inputnik" name="nik" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnama_lengkap">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" id="inputnama_lengkap" name="nama_lengkap" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputtanggal_lahir">Tanggal Lahir <span class="text-danger">*</span></label>
                                    <input type="text" id="inputtanggal_lahir" name="tanggal_lahir" class="form-control datepicker" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="selectjenis_kelamin">Jenis Kelamin <span class="text-danger">*</span></label>
                                    <select class="custom-select rounded-0" id="selectjenis_kelamin" name="jenis_kelamin">
                                        <option value=""></option>
                                        <option value="Laki-Laki">Laki-Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="selectproses_lahiran">Proses Lahiran <span class="text-danger">*</span></label>
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
                                    <input type="text" id="inputtempat_lahir" name="tempat_lahir" class="form-control">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h4>Orang Tua / Wali</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnama_ayah">Nama Ayah <span class="text-danger">*</span></label>
                                    <input type="text" id="inputnama_ayah" name="nama_ayah" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnama_ibu">Nama Ibu <span class="text-danger">*</span></label>
                                    <input type="text" id="inputnama_ibu" name="nama_ibu" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnomor_telepon">Nomor Telepon <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="inputnomor_telepon" name="nomor_telepon" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="inputrt">RT <span class="text-danger">*</span></label>
                                    <input type="text" id="inputrt" name="rt" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="inputrw">RW <span class="text-danger">*</span></label>
                                    <input type="text" id="inputrw" name="rw" class="form-control">
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
            // SELECT2 TAMBAH
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

            $(".datepicker").datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
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
                    },
                    {
                        data: 'aksi',
                        orderable: false,
                        width: '24%'
                    }
                ]
            });

            $("#formTambahBalita #inputnama_ibu").autocomplete({
                appendTo: "#dialog",
                source: function(request, response) {
                    $.ajax({
                        type: "post",
                        url: "nama_ibu",
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
                    $('#formTambahBalita #inputnik_istri').val(ui.item.nik);
                    $('#formTambahBalita #inputnama_ibu').val(ui.item.label);
                    $('#formTambahBalita #inputnama_ayah').val(ui.item.nama_ayah);
                    $('#formTambahBalita #inputnomor_telepon').val(ui.item.nomor_telepon);
                    $('#formTambahBalita #inputrt').val(ui.item.rt);
                    $('#formTambahBalita #inputrw').val(ui.item.rw);
                    return false;
                }
            });

            $("#modalTambahBalita").on('hidden.bs.modal', function(e) {
                removeError("TambahBalita");
            });

            $("#formTambahBalita").submit(function(e) {
                e.preventDefault();
                removeError("TambahBalita");
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
                            $("#formTambahBalita #selectjenis_kelamin").val('').trigger('change');
                            $("#formTambahBalita #selectproses_lahiran").val('').trigger('change');
                            $("#modalTambahBalita").modal('toggle');
                            $("#formTambahBalita")[0].reset();
                            toastr.success('Berhasil Menambah Data Balita.');
                        }
                    },
                    error: function(response) {
                        if (response.status == 422) {
                            toastr.error('Gagal Menambah Data Balita.');
                            $.each(response.responseJSON.errors, function(index, value) {
                                errorFrom("TambahBalita", index, value);
                            });
                        } else {
                            toastr.error(response.responseJSON.message);
                        }

                    }
                });
            });

            $("#formUbahBalita").submit(function(e) {
                e.preventDefault();
                removeError("UbahBalita");
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
                            $("#formTambahBalita #selectjenis_kelamin").val('').trigger('change');
                            $("#formTambahBalita #selectproses_lahiran").val('').trigger('change');
                            $("#formUbahBalita")[0].reset();
                            removeError("UbahBalita");
                            toastr.success('Berhasil Mengubah Data Balita.');
                        }
                    },
                    error: function(response) {
                        if (response.status == 422) {
                            toastr.error('Gagal Mengubah Data Balita.');
                            $.each(response.responseJSON.errors, function(index, value) {
                                errorFrom("UbahBalita", index, value);
                            });
                        } else {
                            toastr.error(response.responseJSON.message);
                        }
                    }
                });
            });
        });

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
                $("#form" + aksi + " span.error").remove();
                $("#form" + aksi + " select.is-invalid").removeClass('is-invalid');
                $("#form" + aksi + " span.text-sm").remove();
            }
        }

        function ubahDataBalita(id) {
            $.get("balita/" + id + "/edit", function(data) {
                $("#formUbahBalita #inputid").val(data.id);
                $("#formUbahBalita #inputnik").val(data.nik);
                $("#formUbahBalita #inputnama_lengkap").val(data.nama_lengkap);
                $("#formUbahBalita #inputtanggal_lahir").val(data.tanggal_lahir);
                $("#formUbahBalita #selectjenis_kelamin").val(data.jenis_kelamin).trigger('change');
                $("#formUbahBalita #selectproses_lahiran").val(data.proses_lahiran).trigger('change');
                $("#formUbahBalita #inputbbl").val(data.bbl);
                $("#formUbahBalita #inputpb").val(data.pb);
                $("#formUbahBalita #inputtempat_lahiran").val(data.tempat_lahiran);
                $("#formUbahBalita #inputnama_ayah").val(data.ortu_balita.nama_suami);
                $("#formUbahBalita #inputnama_ibu").val(data.ortu_balita.nama_istri);
                $("#formUbahBalita #inputnomor_telepon").val(data.ortu_balita.nomor_telepon);
                $("#formUbahBalita #inputrt").val(data.ortu_balita.rt);
                $("#formUbahBalita #inputrw").val(data.ortu_balita.rw);
                $("#modalUbahBalita").modal('toggle');
            })
        };

        function hapusDataBalita(id) {
            Swal.fire({
                title: 'Apakah kamu yakin menghapus data ini?',
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
                        url: "balita/delete/" + id,
                        data: {
                            id: id,
                            _token: $("meta[name=csrf-token]").attr('content')
                        },
                        success: function(response) {
                            if (response == 200) {
                                $("#table-balita").DataTable().ajax.reload(null, false);
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
    </script>
@endpush
