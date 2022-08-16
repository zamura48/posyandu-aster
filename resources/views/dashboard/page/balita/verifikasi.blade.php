@extends('layouts.app', [$activePage])

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Kelola {{ $activePage }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Kelola {{ $activePage }}</li>
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
                    <table id="table-verifikasi_balita" class="table table-bordered table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Akun</th>
                                <th>Nama Balita</th>
                                <th>Keterangan</th>
                                <th>Tanggal</th>
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

    <div class="modal fade" id="modalVerifikasiBalita">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h4 class="modal-title">{{ $activePage }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formVerifikasiBalita">
                    @csrf
                    <div class="modal-body">
                        <div class="row" id="title-ortu">
                            <div class="col-md-12">
                                <h3>Data Balita yang akan di perbarui</h3>
                            </div>
                        </div>
                        <div class="row" id="old-data-balita">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnik">NIK Balita <span class="text-danger">*</span></label>
                                    <input type="text" disabled id="inputnik" name="nik" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnama_lengkap">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" disabled id="inputnama_lengkap" name="nama_lengkap"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputtanggal_lahir">Tanggal Lahir <span class="text-danger">*</span></label>
                                    <input type="text" disabled id="inputtanggal_lahir" name="tanggal_lahir"
                                        class="form-control datepicker" autocomplete="off">
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
                                    <select class="custom-select rounded-0" disabled id="selectproses_lahiran"
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
                                    <input type="text" disabled id="inputbbl" name="bbl" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="inputpb">PB</label>
                                    <input type="text" disabled id="inputpb" name="pb" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputtempat_lahir">Tempat Lahir (RS)</label>
                                    <input type="text" disabled id="inputtempat_lahiran" name="tempat_lahir"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Data Balita yang sudah di perbarui</h3>
                            </div>
                        </div>
                        <hr>
                        <div class="row" id="new-data-balita">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnik">NIK Balita <span class="text-danger">*</span></label>
                                    <input type="hidden" id="inputid" name="id" class="form-control">
                                    <input type="text" disabled id="inputnik" name="nik" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnama_lengkap">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" disabled id="inputnama_lengkap" name="nama_lengkap"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputtanggal_lahir">Tanggal Lahir <span
                                            class="text-danger">*</span></label>
                                    <input type="text" disabled id="inputtanggal_lahir" name="tanggal_lahir"
                                        class="form-control datepicker" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group" id="jenis_kelamin">
                                    <label for="selectjenis_kelamin">Jenis Kelamin <span
                                            class="text-danger">*</span></label>
                                    <select class="custom-select rounded-0" id="selectjenis_kelamin"
                                        name="jenis_kelamin">
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
                                    <select class="custom-select rounded-0" disabled id="selectproses_lahiran"
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
                                    <input type="text" disabled id="inputbbl" name="bbl" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="inputpb">PB</label>
                                    <input type="text" disabled id="inputpb" name="pb" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputtempat_lahir">Tempat Lahir (RS)</label>
                                    <input type="text" disabled id="inputtempat_lahiran" name="tempat_lahiran"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputketerangan">Keterangan</label>
                                    <textarea name="keterangan" class="form-control" disabled id="inputketerangan" cols="30" rows="2"></textarea>
                                    {{-- <input type="text"  id="inputketerangan" name="keterangan"
                                        class="form-control"> --}}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="selectstatus">Verifikasi</label>
                                    <select class="custom-select rounded-0" id="selectstatus" name="status">
                                        <option value="">Pilih</option>
                                        <option value="Verifikasi">Verifikasi</option>
                                        <option value="Tolak Verifikasi">Tolak Verifikasi</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>
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
            $("#table-verifikasi_balita").DataTable({
                pangging: true,
                autoWidth: true,
                responsive: true,
                ajax: '{{ route('verifikasi_update_balita') }}',
                columns: [{
                        data: 'user.name',
                        name: 'user.name'
                    },
                    {
                        data: 'nama_lengkap',
                        name: 'nama_lengkap'
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan'
                    },
                    {
                        data: 'created_at',
                        render: function(data) {
                            let date = new Date(data);
                            let month = date.getMonth() + 1;
                            return date.getFullYear() + "-" + month + "-" + date.getDay();
                        }
                    },
                    {
                        data: 'status',
                        name: 'status',
                        render: function(data) {
                            return data == 1 ? 'Belum Terverifikasi' : '';
                        }
                    },
                    {
                        data: 'aksi',
                        orderable: false,
                        width: '11%'
                    }
                ],
                order: [[3, 'desc']]
            });

            $("#formVerifikasiBalita").submit(function(e) {
                e.preventDefault();

                var formData = new FormData(this);
                var id = "";

                for (var key of formData.entries()) {
                    if (key[0] == "id") {
                        id = key[1];
                    }
                }
                let url = '{{ route('verifikasi_update_balita.update', ':id') }}';
                url = url.replace(':id', id);

                $.ajax({
                    type: "POST",
                    url: url,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response == 200) {
                            $("#table-verifikasi_balita").DataTable().ajax.reload(null, false);
                            $("#modalVerifikasiBalita").modal('toggle');
                            $("#formVerifikasiBalita")[0].reset();
                            $("#selectjenis_kelamin").val('').trigger('change');
                            $("#selectproses_lahiran").val('').trigger('change');
                            toastr.success('Berhasil Memverifikasi Perubahan Balita.');
                        }
                    },
                    error: function(response) {
                        if (response.status == 422) {
                            toastr.error('Gagal Memverifikasi Perubahan Balita.');
                        } else {
                            toastr.error(response.responseJSON.message);
                        }
                    }
                });
            });
        });

        function VerifikasiUpdateBalita(id) {
            $(selector).on('change', function () {

            });
            let url = '{{ route('verifikasi_update_balita.edit', ':id') }}';
            url = url.replace(':id', id);
            $.get(url, function(data, textStatus, jqXHR) {
                $("#old-data-balita #inputnik").val(data.balita.nik);
                $("#old-data-balita #inputnama_lengkap").val(data.balita.nama_lengkap);
                $("#old-data-balita #inputtanggal_lahir").val(data.balita.tanggal_lahir);
                $("#old-data-balita #selectjenis_kelamin").val(data.balita.jenis_kelamin).trigger('change');
                $("#old-data-balita #selectproses_lahiran").val(data.balita.proses_lahiran).trigger('change');
                $("#old-data-balita #inputbbl").val(data.balita.bbl);
                $("#old-data-balita #inputpb").val(data.balita.pb);
                $("#old-data-balita #inputtempat_lahiran").val(data.balita.tempat_lahiran);

                $("#new-data-balita #inputid").val(data.pra_update.id);
                $("#new-data-balita #inputnik").val(data.pra_update.nik);
                $("#new-data-balita #inputnama_lengkap").val(data.pra_update.nama_lengkap);
                $("#new-data-balita #inputtanggal_lahir").val(data.pra_update.tanggal_lahir);
                $("#new-data-balita #selectjenis_kelamin").val(data.pra_update.jenis_kelamin).trigger('change');
                $("#new-data-balita #selectproses_lahiran").val(data.pra_update.proses_lahiran).trigger('change');
                $("#new-data-balita #inputbbl").val(data.pra_update.bbl);
                $("#new-data-balita #inputpb").val(data.pra_update.pb);
                $("#new-data-balita #inputtempat_lahiran").val(data.pra_update.tempat_lahiran);
                $("#new-data-balita #inputketerangan").val(data.pra_update.keterangan);
                $("#modalVerifikasiBalita").modal('toggle');
            });
        }
    </script>
@endpush
