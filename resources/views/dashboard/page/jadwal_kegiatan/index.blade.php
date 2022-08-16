@extends('layouts.app', [$activePage])

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $activePage }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">{{ $activePage }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title mt-2">Tambah {{ $activePage }}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form id="formJadwalKegiatan">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Kegiatan Posyandu <span class="text-danger">*</span></label>
                                    <select class="form-control" id="select_kegiatan" name="kegiatan" style="width: 100%;"
                                        required>
                                        <option value=""></option>
                                        <option value="Imunisasi/Penimbangan">Imunisasi/Penimbangan</option>
                                        <option value="Imunisasi/Penimbangan/Pemberian Vitamin">
                                            Imunisasi/Penimbangan/Pemberian Vitamin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Tanggal <span class="text-danger">*</span></label>
                                    <input type="text" disabled class="form-control" id="inputtanggal_kegiatan"
                                        name="tanggal_kegiatan" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Pesan <span class="text-danger">*</span></label>
                                    <textarea class="form-control" disabled rows="3" id="inputpesan" name="pesan"></textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Data Jadwal Kegiatan</h3>
                </div>
                <div class="card-body">
                    <table id="table_jadwal_kegiatan" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Tanggal Kegiatan</th>
                                <th>Kegiatan</th>
                                <th>Pesan</th>
                                <th>Aksi</th>
                                {{-- <th>Created_at</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

    <div class="modal fade" id="modalUbahJadwalKegiatan">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h4 class="modal-title">Ubah {{ $activePage }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formUbahJadwalKegiatan">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Kegiatan Posyandu <span class="text-danger">*</span></label>
                                    <select class="form-control" id="select_kegiatan" name="kegiatan" style="width: 100%;"
                                        required>
                                        <option value=""></option>
                                        <option value="Imunisasi/Penimbangan">Imunisasi/Penimbangan</option>
                                        <option value="Imunisasi/Penimbangan/Pemberian Vitamin">
                                            Imunisasi/Penimbangan/Pemberian Vitamin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Tanggal <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="inputtanggal_kegiatan"
                                        name="tanggal_kegiatan" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pesan <span class="text-danger">*</span></label>
                                    <textarea class="form-control" rows="3" id="inputpesan" name="pesan"></textarea>
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
            let old_date;
            let old_kegiatan;
            $("#select_kegiatan").select2({
                theme: 'bootstrap4',
                placeholder: 'Pilih Kegiatan',
                minimumResultsForSearch: -1
            });

            $("input#inputtanggal_kegiatan").datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            });

            $("#table_jadwal_kegiatan").DataTable({
                autoWidth: true,
                responsive: true,
                ajax: '{{ route('jadwal_kegiatan.index') }}',
                columns: [{
                        data: 'tanggal',
                        name: 'tanggal',
                        width: '20%'
                    },
                    {
                        data: 'nama_kegiatan',
                        name: 'nama_kegiatan'
                    },
                    {
                        data: 'pesan',
                        name: 'pesan'
                    },
                    {
                        data: 'aksi',
                        orderable: false,
                        width: '11%'
                    },
                    {
                        data: 'created_at',
                        visible: false
                    }
                ],
                order: [[4, 'desc']]
            });

            $("#formJadwalKegiatan #select_kegiatan").change(function(e) {
                e.preventDefault();
                $("#formJadwalKegiatan #inputtanggal_kegiatan").attr('disabled', false);
                $("#formJadwalKegiatan #inputpesan").attr('disabled', false);
            });

            $("#formJadwalKegiatan #inputtanggal_kegiatan").change(function(e) {
                e.preventDefault();
                let kegiatan = $("#select_kegiatan").val();
                let tanggal = $(this).val();
                $("#formJadwalKegiatan #inputpesan").val("Hai bun, saya dari posyandu aster ingin memberitahukan. Pada tanggal " + tanggal + " akan dilakukan kegiatan " +
                    kegiatan + " jangan lupa datang ya.");
            });

            $("#formUbahJadwalKegiatan #select_kegiatan").change(function(e) {
                e.preventDefault();
                replacePesan("#formUbahJadwalKegiatan", "kegiatan", $(this).val());
            });

            $("#formUbahJadwalKegiatan #inputtanggal_kegiatan").change(function(e) {
                e.preventDefault();
                replacePesan("#formUbahJadwalKegiatan", "tanggal_kegiatan", $(this).val());
            });

            $("#formJadwalKegiatan").submit(function(e) {
                e.preventDefault();
                removeError("JadwalKegiatan");
                let formData = new FormData(this);

                $.ajax({
                    type: "POST",
                    url: "{{ route('jadwal_kegiatan.store') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response == 200) {
                            $("#formJadwalKegiatan #select_kegiatan").val('').trigger('change');
                            $("#formJadwalKegiatan #inputtanggal_kegiatan").attr('disabled', 'true');
                            $("#formJadwalKegiatan #inputpesan").attr('disabled', 'true');
                            $('#formJadwalKegiatan')[0].reset();
                            $("#table_jadwal_kegiatan").DataTable().ajax.reload(null, false);
                            toastr.success('Berhasil Mengirimkan Informasi Jadwal');
                        }
                    },
                    error: (response) => {
                        if (response.status == 422) {
                            toastr.error('Gagal Mengirimkan Informasi Jadwal');
                            $.each(response.responseJSON.errors, function(index, value) {
                                errorFrom("JadwalKegiatan", index, value);
                            });
                        } else {
                            toastr.error(response.responseJSON.message);
                        }
                    }
                });
            });

            // EVENT UNTUK MENGUBAH DATA YANG ADA BERDASARKAN ID BALITA
            $('#formUbahJadwalKegiatan').submit(function(e) {
                e.preventDefault();
                removeError("UbahJadwalKegiatan");
                let formData = new FormData(this);
                let id = "";

                for (var key of formData.entries()) {
                    if (key[0] == "id") {
                        id = key[1];
                    }
                }

                $.ajax({
                    type: "POST",
                    url: "jadwal_kegiatan/" + id,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response === 200) {
                            $('#table_jadwal_kegiatan').DataTable().ajax.reload(null, false);
                            $('#formUbahJadwalKegiatan')[0].reset();
                            $("#formUbahJadwalKegiatan").val('').trigger('change');
                            $('#modalUbahJadwalKegiatan').modal('toggle');
                            toastr.success(
                                'Berhasil Mengubah Jadwal Kegiatan dan mengirim ulang informasi.'
                            );
                        }
                    },
                    error: (response) => {
                        if (response.status == 422) {
                            toastr.error('Gagal Mengubah Jadwal Kegiatan.');
                            $.each(response.responseJSON.errors, function(index, value) {
                                errorFrom("UbahJadwalKegiatan", index, value);
                            });
                        } else {
                            toastr.error(response.responseJSON.message);
                        }
                    }
                });
            });
        });

        function ubahDataJadwalKegiatan(id) {
            $.get("jadwal_kegiatan/" + id + "/edit", function(data) {
                $('#formUbahJadwalKegiatan #inputpesan').before(
                    '<input type="text" id="inputid" name="id" class="form-control" value="' + data.id + '">');
                $('#formUbahJadwalKegiatan #inputid').hide();
                old_date = data.tanggal;
                old_kegiatan = data.nama_kegiatan;
                $("#formUbahJadwalKegiatan #select_kegiatan").val(data.nama_kegiatan).trigger('change');
                $("#formUbahJadwalKegiatan #inputtanggal_kegiatan").val(data.tanggal);
                $("#formUbahJadwalKegiatan #inputpesan").val(data.pesan);
                $("#modalUbahJadwalKegiatan").modal('toggle');
            });
        }

        function hapusDataJadwalKegiatan(id) {
            Swal.fire({
                title: 'Apakah kamu yakin, menghapus data ini?',
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
                        url: "jadwal_kegiatan/delete/" + id,
                        data: {
                            id: id,
                            _token: $("meta[name=csrf-token]").attr('content')
                        },
                        success: function(response) {
                            if (response == 200) {
                                $('#table_jadwal_kegiatan').DataTable().ajax.reload(null, false);
                                toastr.success('Berhasil Menghapus Jadwal Kegiatan.');
                            }
                        },
                        error: (response) => {
                            toastr.error(response.responseJSON.message)
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

        function replacePesan(form, id, value) {
            let pesan = $(form + " #inputpesan").val();

            if (id == "kegiatan") {
                const new_kegiatan = value;

                if (new_kegiatan != old_kegiatan) {
                    let new_pesan = pesan.replace(old_kegiatan, new_kegiatan);
                    $(form + " #inputpesan").val(new_pesan);
                    old_kegiatan = new_kegiatan;
                }
            } else if (id == "tanggal_kegiatan") {
                const new_date = value;
                if (new_date != old_date) {
                    let new_pesan = pesan.replace(old_date, new_date);
                    $(form + " #inputpesan").val(new_pesan);
                    old_date = new_date;
                }
            }
        }
    </script>
@endpush
