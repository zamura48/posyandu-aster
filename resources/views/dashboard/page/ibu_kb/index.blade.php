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
                        <button type="button" class="btn btn-success" data-toggle="modal"
                            data-target="#modalTambahIbuKB">
                            Tambah Data {{ $activePage }}
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="table_ibu_kb" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>NIK</th>
                                <th>Nama Ibu KB</th>
                                <th>Riwayat KB</th>
                                <th>Suntik Awal</th>
                                <th>Suntik Akhir</th>
                                <th>Hasil Pemeriksaan</th>
                                <th>Tanggal Pemeriksaan</th>
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

    <div class="modal fade" id="modalTambahIbuKB">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h4 class="modal-title">Tambah Data {{ $activePage }} Baru</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formTambahIbuKB">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnik">NIK</label>
                                    <input type="text" id="inputnik" name="nik" class="form-control"
                                        placeholder="ex. 1234567890123456">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnama_istri">Nama Ibu KB</label>
                                    <input type="text" id="inputnama_istri" name="nama_istri" class="form-control">
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
                                    <input type="text" id="inputalamat" name="alamat" class="form-control"
                                        placeholder="ex. jln. veteran">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnomor_telepon">Nomor Telepon</label>
                                    <input type="text" id="inputnomor_telepon" name="nomor_telepon" class="form-control"
                                        placeholder="ex. 088217643823">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputpekerjaan_istri">Pekerjaan Istri</label>
                                    <input type="text" id="inputpekerjaan_istri" name="pekerjaan_istri"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnama_suami">Nama Suami</label>
                                    <input type="text" id="inputnama_suami" name="nama_suami" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputpekerjaan_suami">Pekerjaan Suami</label>
                                    <input type="text" id="inputpekerjaan_suami" name="pekerjaan_suami"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputjumlah_anak">Jumlah Anak</label>
                                    <input type="text" id="inputjumlah_anak" name="jumlah_anak"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            {{-- <div class="col-md-12 mb-3">
                                <span class="text-danger">*</span><small> Keterangan di isi apabila balita tersebut
                                    pindah</small>
                            </div> --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputriwayat_kb">Riwayat KB</label>
                                    <input type="text" id="inputriwayat_kb" name="riwayat_kb"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputsuntik_awal">Suntik Awal</label>
                                    <input type="text" id="inputsuntik_awal" name="suntik_awal"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputsuntik_akhir">Suntik Akhir</label>
                                    <input type="text" id="inputsuntik_akhir" name="suntik_akhir"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputhasil_pemeriksaan">Hasil Pemeriksaan</label>
                                    <input type="text" id="inputhasil_pemeriksaan" name="hasil_pemeriksaan"
                                        class="form-control">
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

    <div class="modal fade" id="modalUbahIbuKB">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h4 class="modal-title">Ubah Data {{ $activePage }} Baru</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formUbahIbuKB">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnik">NIK</label>
                                    <input type="text" id="inputnik" name="nik" class="form-control"
                                        placeholder="ex. 1234567890123456">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnama_istri">Nama Ibu KB</label>
                                    <input type="text" id="inputnama_istri" name="nama_istri" class="form-control">
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
                                    <input type="text" id="inputalamat" name="alamat" class="form-control"
                                        placeholder="ex. jln. veteran">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnomor_telepon">Nomor Telepon</label>
                                    <input type="text" id="inputnomor_telepon" name="nomor_telepon" class="form-control"
                                        placeholder="ex. 088217643823">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputpekerjaan_istri">Pekerjaan Istri</label>
                                    <input type="text" id="inputpekerjaan_istri" name="pekerjaan_istri"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnama_suami">Nama Suami</label>
                                    <input type="text" id="inputnama_suami" name="nama_suami" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputpekerjaan_suami">Pekerjaan Suami</label>
                                    <input type="text" id="inputpekerjaan_suami" name="pekerjaan_suami"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputjumlah_anak">Jumlah Anak</label>
                                    <input type="text" id="inputjumlah_anak" name="jumlah_anak"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            {{-- <div class="col-md-12 mb-3">
                                <span class="text-danger">*</span><small> Keterangan di isi apabila balita tersebut
                                    pindah</small>
                            </div> --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputriwayat_kb">Riwayat KB</label>
                                    <input type="text" id="inputriwayat_kb" name="riwayat_kb"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputsuntik_awal">Suntik Awal</label>
                                    <input type="text" id="inputsuntik_awal" name="suntik_awal"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputsuntik_akhir">Suntik Akhir</label>
                                    <input type="text" id="inputsuntik_akhir" name="suntik_akhir"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputhasil_pemeriksaan">Hasil Pemeriksaan</label>
                                    <input type="text" id="inputhasil_pemeriksaan" name="hasil_pemeriksaan"
                                        class="form-control">
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
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('#formTambahIbuKB #nama_istri').autocomplete({
                source: function(request, response) {
                    $.ajax({
                        type: "post",
                        url: "get_ibu_kb",
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
                    $('#nama_istri').val(ui.item.label);
                    return false;
                }
            });
        });
    </script>
    <script>
        $(function() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            $("#table_ibu_kb").DataTable({
                scrollX: true,
                fixedColumns: {
                    left: 1
                },
                ajax: 'ibu_kb',
                columns: [{
                        data: 'nik',
                        name: 'nik'
                    },
                    {
                        data: 'nama_istri',
                        name: 'nama_istri'
                    },
                    {
                        data: 'riwayat_ibu_kb.riwayat_kb',
                    },
                    {
                        data: 'riwayat_ibu_kb.suntik_awal'
                    },
                    {
                        data: 'riwayat_ibu_kb.suntik_akhir'
                    },
                    {
                        data: 'riwayat_ibu_kb.hasil_pemeriksaan'
                    },
                    {
                        data: 'riwayat_ibu_kb.created_at',
                        render: function(data) {
                            let date = new Date(data);
                            return date.getDate() + "-" + date.getMonth() + "-" + date
                        .getFullYear();
                        }
                    },
                    {
                        data: 'nomor_telepon',
                        name: 'nomor_telepon'
                    },
                    {
                        data: 'aksi',
                        orderable: false,
                    }
                ]
            });

            $('#formTambahIbuKB').submit(function(e) {
                e.preventDefault();

                let formData = new FormData(this);

                $.ajax({
                    type: "POST",
                    url: "ibu_kb",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response === 200) {
                            $('#table_ibu_kb').DataTable().ajax.reload(null,
                                false);
                            $('#formTambahIbuKB')[0].reset();
                            $('#modalTambahIbuKB').modal('toggle');
                            kosongkan()
                            Toast.fire({
                                icon: 'success',
                                title: 'Berhasil Menambah Data Kader Baru.'
                            });
                        } else {
                            $.each(response.error, function(indexInArray, valueOfElement) {
                                $('#formTambahIbuKB #input' + indexInArray)
                                    .addClass('is-invalid').after('<span id="input' +
                                        index +
                                        '-error" class="error invalid-feedback">' +
                                        value + '</span>');
                            });
                        }
                    }
                });
            });

            $('#formUbahIbuKB').submit(function(e) {
                e.preventDefault();

                let formData = new FormData(this);
                let id = "";

                for (var key of formData.entries()) {
                    if (key[0] == "id") {
                        id = key[1];
                    }
                }

                $.ajax({
                    type: "POST",
                    url: "ibu_kb/" + id,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response === 200) {
                            $('#table_ibu_kb').DataTable().ajax.reload(null,
                                false);
                            $('#formUbahIbuKB')[0].reset();
                            $('#modalUbahIbuKB').modal('toggle');
                            Toast.fire({
                                icon: 'success',
                                title: 'Berhasil Mengubah Data Kader Baru.'
                            });
                        } else {
                            $.each(response.error, function(indexInArray, valueOfElement) {
                                alert(indexInArray + ": " + valueOfElement);
                            });
                        }
                    }
                });
            });
        });

        function ubahDataIbuKB(id) {
            $.get("ibu_kb/" + id + "/edit", function(data, textStatus, jqXHR) {
                const d = JSON.parse(atob(data));
                // console.log(d);
                $('#formUbahIbuKB #inputnik').before(
                    '<input type="text" id="inputid" name="id" class="form-control" value="' + d
                    .riwayat_ibu_kb.id + '">');
                $('#formUbahIbuKB #inputid').hide();
                $('#formUbahIbuKB #inputnik').val(d.nik);
                $('#formUbahIbuKB #inputnama_istri').val(d.nama_istri);
                $('#formUbahIbuKB #inputtanggal_lahir').val(d.tanggal_lahir);
                $('#formUbahIbuKB #inputalamat').val(d.alamat);
                $('#formUbahIbuKB #inputnomor_telepon').val(d.nomor_telepon);
                $('#formUbahIbuKB #inputpekerjaan_istri').val(d.pekerjaan_istri);
                $('#formUbahIbuKB #inputnama_suami').val(d.nama_suami);
                $('#formUbahIbuKB #inputpekerjaan_suami').val(d.pekerjaan_suami);
                $('#formUbahIbuKB #inputjumlah_anak').val(d.jumlah_anak);
                // riwayat kb
                $('#formUbahIbuKB #inputriwayat_kb').val(d.riwayat_ibu_kb.riwayat_kb);
                $('#formUbahIbuKB #inputsuntik_awal').val(d.riwayat_ibu_kb.suntik_awal);
                $('#formUbahIbuKB #inputsuntik_akhir').val(d.riwayat_ibu_kb.suntik_akhir);
                $('#formUbahIbuKB #inputhasil_pemeriksaan').val(d.riwayat_ibu_kb.hasil_pemeriksaan);
                $('#modalUbahIbuKB').modal('toggle');
            });
        }

        function hapusDataIbuKB(id) {
            $.ajax({
                type: "POST",
                url: "ibu_kb/delete/" + id,
                data: {
                    id: id,
                    _token: $("meta[name=csrf-token]").attr('content')
                },
                success: function(response) {
                    if (response == 200) {
                        $('#table_ibu_kb').DataTable().ajax.reload(null, false);
                    }
                }
            });
        }
    </script>
@endpush
