{{-- {{ dd($_GET['id']) }} --}}
@extends('layouts.app', [$activePage])

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit {{ $activePage }}</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <a href="{{ route('penimbangan.index') }}" class="btn btn-info btn-block text-white mb-2"><i
                class="fa fa-angle-left"></i> Kembali</a>
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title mt-2 mb-2">Data {{ $activePage }}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    {{-- TABEL --}}
                    <table id="table-penimbangan" class="table table-bordered table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>BB</th>
                                <th>TB</th>
                                <th>Tanggal</th>
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

    <div class="modal fade" id="modalUbahPenimbangan">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h4 class="modal-title">Ubah Data {{ $activePage }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formUbahPenimbangan">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-muted">
                                    <p class="text-lg">Nama Balita
                                        <b class="d-block" id="nama_balita"></b>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="inputtanggal_input">Tanggal Input <span
                                    class="text-danger">*</span></label>
                            <input type="text" id="inputtanggal_input" name="tanggal_input" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="inputbb">Berat Badan Balita <span class="text-danger">*</span></label>
                            <input type="text" id="inputbb" name="bb" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="inputtb">Tinggi Badan <span class="text-danger">*</span></label>
                            <input type="text" id="inputtb" name="tb" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="inputketerangan">Keterangan</label>
                            <input type="text" id="inputketerangan" name="keterangan" class="form-control">
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
            $("#inputtanggal_input").datepicker({
                format: 'yyyy-mm-dd',
                autoclose: 'true'
            });
            load_data_penimbangan();

            $('#formUbahPenimbangan').submit(function(e) {
                e.preventDefault();
                removeError("UbahPenimbangan");

                let formData = new FormData(this);
                let id = $("#formUbahPenimbangan #inputid").val();
                let url = '{{ route("penimbangan.update", ":id") }}';
                url = url.replace(':id', id);

                $.ajax({
                    type: "POST",
                    url: url,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response == 200) {
                            $('#table-penimbangan').DataTable().ajax.reload(null, false);
                            $('#formUbahPenimbangan')[0].reset();
                            $('#modalUbahPenimbangan').modal('toggle');
                            toastr.success('Berhasil Mengubah Data Penimbangan.');
                        }
                    },
                    error: (response) => {
                        if (response.status == 422) {
                            toastr.error('Gagal Mengubah Data Penimbangan.');
                            $.each(response.responseJSON.errors, function(index, value) {
                                errorFrom("UbahPenimbangan", index, value);
                            });
                        } else {
                            toastr.error(response.responseJSON.message);
                        }
                    }
                });
            });
        });

        function load_data_penimbangan(tahun = "") {
            $("#table-penimbangan").DataTable({
                scrollX: true,
                scrollCollapse: true,
                ajax: {
                    url: '{{ route('penimbangan.edit', $penimbangan) }}',
                    data: {
                        tahun: tahun
                    }
                },
                columns: [{
                        data: 'balita.nama_lengkap',
                        name: 'balita.nama_lengkap',
                        width: '20%'
                    },
                    {
                        data: 'bb',
                        name: 'bb',
                        width: '25%'
                    },
                    {
                        data: 'tb',
                        name: 'tb',
                        width: '20%'
                    },
                    {
                        data: 'tanggal_input',
                        width: '20%'
                    },
                    {
                        data: 'aksi',
                        orderable: false,
                        width: '24%'
                    }
                ],
                order: [
                    [3, 'desc']
                ]
            });
        }

        // METHOD UNTUK MENGAMBIL DATA BERDASARKAN ID
        function ubahDataPenimbangan(id) {
            var url = '{{ route("penimbangan.getDataEdit", ":id") }}';
            url = url.replace(':id', id);
            $.get(url, function(data, textStatus, jqXHR) {
                $('#formUbahPenimbangan #nama_balita').before(
                    '<input type="text" id="inputid" name="id" class="form-control" value="' + data.id + '">');
                $('#formUbahPenimbangan #inputid').hide();
                $('#formUbahPenimbangan #nama_balita').text(data.balita.nama_lengkap);
                $('#formUbahPenimbangan #inputtanggal_input').val(data.tanggal_input);
                $('#formUbahPenimbangan #inputbb').val(data.bb);
                $('#formUbahPenimbangan #inputtb').val(data.tb);
                $('#formUbahPenimbangan #inputketerangan').val(data.keterangan);
                // $('#formUbahPenimbangan #penimbangan_nama_ayah').text(d.balita.ortu_balita.nama_suami);
                // $('#formUbahPenimbangan #penimbangan_nama_ibu').text(d.balita.ortu_balita.nama_istri);
                $('#modalUbahPenimbangan').modal('toggle');
            }).fail(function(){
                toastr.error('Gagal menampilkan data');
            });
        }

        // METHOD UNTUK MENGHAPUS DATA BERDASRKAN ID
        function hapusDataPenimbangan(id) {
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
                    let url = "{{ route("penimbangan.destroyOne", ':id') }}"
                    url = url.replace(':id', id);

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            id: id,
                            _token: $("meta[name=csrf-token]").attr('content')
                        },
                        success: function(response) {
                            if (response == 200) {
                                $('#table-penimbangan').DataTable().ajax.reload(null, false);
                                toastr.success('Berhasil Menghapus Data Penimbangan.');
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
