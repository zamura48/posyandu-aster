@extends('layouts.app', [$activePage])

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Kelola Data Verifikasi Registrasi {{ $activePage }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Kelola Data Verifikasi Registrasi {{ $activePage }}</li>
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
                    <h3 class="card-title mt-2">Data Registrasi {{ $activePage }}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="table-ibu_balita" class="table table-bordered table-hover text-nowrap">
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
                    <h4 class="modal-title">Verifikasi Data Registrasi {{ $activePage }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formVerifikasiIbuBalita">
                    @csrf
                    <div class="modal-body">
                        <div class="row" id="title-ortu">
                            <div class="col-md-12">
                                <h3>Data Ibu Balita yang sudah ada</h3>
                            </div>
                        </div>
                        <div class="row" id="ortu">
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
                                    <input type="text" id="inputnama_ayah" disabled name="nama_ayah"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnomor_telepon">Nomor Telepon</label>
                                    <input type="text" id="inputnomor_telepon" disabled name="nomor_telepon"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputalamat">Alamat</label>
                                    <input type="text" id="inputalamat" disabled name="alamat" class="form-control">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Data Register Ibu Balita</h3>
                            </div>
                        </div>
                        <hr>
                        <div class="row" id="pra_register">
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
                                    <input type="text" id="inputnama_ayah" disabled name="nama_ayah"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnomor_telepon">Nomor Telepon</label>
                                    <input type="text" id="inputnomor_telepon" disabled name="nomor_telepon"
                                        class="form-control">
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
            $("#table-ibu_balita").DataTable({
                pangging: true,
                autoWidth: true,
                responsive: true,
                ajax: 'ibu_balita',
                columns: [{
                        data: 'nama_suami',
                        name: 'nama_suami'
                    },
                    {
                        data: 'nama_istri',
                        name: 'nama_istri'
                    },
                    {
                        data: 'nomor_telepon',
                        name: 'nomor_telepon'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        render: function(data) {
                            return data == null ? 'Terverifikasi' : 'Belum Terverifikasi';
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
                            toastr.success('Berhasil Memverifikasi.');
                        }
                    },
                    error: function(response) {
                        toastr.error('Gagal Memverifikasi.');
                    }
                });
            });

            // jika modal tertutup maka hapus element
            $('#modalVerifikasiIbuBalita').on('hidden.bs.modal', function(e) {
                $('div#inputnama_balita').each(function(index, element) {
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

                const ortu = data.ortu;
                const pra_registers = data.pra_registers;
                // looping data pra_register
                $('#pra_register #inputid').val(pra_registers.id);
                $('#pra_register #inputnik').val(pra_registers.nik);
                $('#pra_register #inputnama_ibu').val(pra_registers.nama_istri);
                $('#pra_register #inputpekerjaan_ibu').val(pra_registers.pekerjaan_istri);
                $('#pra_register #inputnama_ayah').val(pra_registers.nama_suami);
                $('#pra_register #inputpekerjaan_ayah').val(pra_registers.pekerjaan_suami);
                $('#pra_register #inputalamat').val(pra_registers.alamat);
                $('#pra_register #inputnomor_telepon').val(pra_registers.nomor_telepon);

                // looping data ortu
                if (Object.keys(ortu).length !== 0) {
                    $("#title-ortu").attr('hidden', false);
                    $("#ortu").attr('hidden', false);
                    $("#title-ortu").after('<hr>');
                    $.each(ortu, function(index, val) {
                        var x = 1;
                        if (Object.keys(val.balita).length !== 0) {
                            $.each(ortu.balita, function(indexInArray, valueOfElement) {
                                var template =
                                    '<div class="col-md-4" id="inputnama_balita"><div class="form-group"><label for="inputnama_balita">Nama Balita ' +
                                    x++ +
                                    '</label><input type="text" disabled name="nama_balita[]" class="form-control" value="' +
                                    valueOfElement.nama_lengkap + '"></div></div>';
                                $('#nama_balita').append(template);
                            });
                        } else {
                            $('#nama_balita').append(
                                '<div class="col-md-12" id="keterangan"><p class="text-center">Belum ada data balita</p></div>'
                            );
                        }
                        $('#ortu #inputid').val(val.id);
                        $('#ortu #inputnik').val(val.nik);
                        $('#ortu #inputnama_ibu').val(val.nama_istri);
                        $('#ortu #inputpekerjaan_ibu').val(val.pekerjaan_istri);
                        $('#ortu #inputnama_ayah').val(val.nama_suami);
                        $('#ortu #inputpekerjaan_ayah').val(val.pekerjaan_suami);
                        $('#ortu #inputalamat').val(val.alamat);
                        $('#ortu #inputnomor_telepon').val(val.nomor_telepon);
                        // $('#selectstatus').val(ortu.user.status);
                    });
                } else {
                    $("#title-ortu").attr('hidden', true);
                    $("#ortu").attr('hidden', true);
                }
                $('#modalVerifikasiIbuBalita').modal('toggle');
            });
        }
    </script>
@endpush
