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
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="table-ibu_balita" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Nama Ayah</th>
                                <th>Nama Ibu</th>
                                <th>Nomor Telepon</th>
                                <th>Status</th>
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

    <div class="modal fade" id="modalVerifikasiIbuBalita">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h4 class="modal-title">Ubah Data {{ $activePage }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formVerifikasiIbuBalita">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnik">NIK</label>
                                    <input type="text" id="inputid" name="id" hidden class="form-control">
                                    <input type="text" id="inputnik" disabled name="nik" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnama_ibu">Nama Ibu</label>
                                    <input type="text" id="inputnama_ibu" disabled name="nama_ibu" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnama_ayah">Nama Ayah</label>
                                    <input type="text" id="inputnama_ayah" disabled name="nama_ayah" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnomor_telepon">Nomor Telepon</label>
                                    <input type="text" id="inputnomor_telepon" disabled name="nomor_telepon" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputalamat">Alamat</label>
                                    <input type="text" id="inputalamat" disabled name="alamat" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="selectstatus">Verifikasi Akun</label>
                                    <select class="custom-select rounded-0" id="selectstatus" name="status">
                                        <option value="0">Belum Verifikasi</option>
                                        <option value="1">Terverifikasi</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row" id="nama_balita">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-info text-white">Verifikasi</button>
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
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            $("#table-ibu_balita").DataTable({
                pangging: true,
                autoWidth: true,
                responsive: true,
                ajax: 'ibu_balita',
                columns: [{
                        data: 'nama_ayah',
                        name: 'nama_ayah'
                    },
                    {
                        data: 'nama_ibu',
                        name: 'nama_ibu'
                    },
                    {
                        data: 'nomor_telepon',
                        name: 'nomor_telepon'
                    },
                    {
                        data: 'user.status',
                        name: 'user.status',
                        render: function(data){
                            return data == 1 ? 'Terverifikasi' : 'Belum Terverifikasi';
                        }
                    },
                    {
                        data: 'aksi',
                        orderable: false,
                        width: '11%'
                    }
                ]
            });

            $("#formVerifikasiIbuBalita").submit(function(e) {
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
                    url: "ibu_balita/" + id,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response == 200) {
                            $("#table-ibu_balita").DataTable().ajax.reload(null, false);
                            $("#modalVerifikasiIbuBalita").modal('toggle');
                            $("#formVerifikasiIbuBalita")[0].reset();
                            Toast.fire({
                                icon: 'success',
                                title: 'Berhasil Memverifikasi.'
                            });
                        }
                    },
                    error: function(response) {
                        if (response == "error") {
                            console.log(response.error);
                        }
                    }
                });
            });

            // jika modal tertutup maka hapus element
            $('#modalVerifikasiIbuBalita').on('hidden.bs.modal', function(e){
                $('div#inputnama_balita').each(function (index, element) {
                    // element == this
                    $(this).remove();
                });
                $('div#keterangan').each(function() {
                    $(this).remove();
                });
            });
        });

        function VerifikasiIbuBalita(id) {
            $.get("ibu_balita/" + id + "/edit", function(data, textStatus, jqXHR) {
                const d = JSON.parse(atob(data));
                var x = 1;
                if (Object.keys(d.balita).length !== 0) {
                    $.each(d.balita, function(indexInArray, valueOfElement) {
                        var template =
                            '<div class="col-md-4" id="inputnama_balita"><div class="form-group"><label for="inputnama_balita">Nama Balita '+x+++'</label><input type="text" disabled name="nama_balita[]" class="form-control" value="'+valueOfElement.nama_lengkap+'"></div></div>';
                        $('#nama_balita').append(template);
                    });
                } else {
                    $('#nama_balita').append('<div class="col-md-12" id="keterangan"><p class="text-center">Belum ada data balita</p></div>');
                }
                $('#inputid').val(d.id);
                $('#inputnik').val(d.nik);
                $('#inputnama_ibu').val(d.nama_ibu);
                $('#inputpekerjaan_ibu').val(d.pekerjaan_ibu);
                $('#inputnama_ayah').val(d.nama_ayah);
                $('#inputpekerjaan_ayah').val(d.pekerjaan_ayah);
                $('#inputalamat').val(d.alamat);
                $('#inputnomor_telepon').val(d.nomor_telepon);
                $('#selectstatus').val(d.user.status);
                $('#modalVerifikasiIbuBalita').modal('toggle');
            });
        }
    </script>
@endpush
