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
                            data-target="#modalTambahPenimbangan">
                            Tambah Data {{ $activePage }}
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="table_penimbangan" class="table table-bordered table-hover">
                        <thead>
                            <th>Nama</th>
                            <th>BB</th>
                            <th>TB</th>
                            <th>Bulan</th>
                            <th>Tahun</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
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

    <div class="modal fade" id="modalTambahPenimbangan">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h4 class="modal-title">Tambah Data {{ $activePage }} Baru</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formTambahPenimbangan">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nama Balita</label>
                                    <select class="form-control" id="select_get_nama_balita_penimbangan" name="balita_id"
                                        style="width: 100%;" required>
                                        <option value=""></option>
                                        @foreach ($balitas as $balita)
                                            <option value="{{ encrypt($balita->id) }}">
                                                {{ $balita->nama_lengkap }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4" style="display: none;" id="penimbangan_info_nama_ayah">
                                <div class="text-muted">
                                    <p class="text-lg">Nama Ayah
                                        <b class="d-block" id="penimbangan_nama_ayah"></b>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-4" style="display: none;" id="penimbangan_info_nama_ibu">
                                <div class="text-muted">
                                    <p class="text-lg">Nama Ibu
                                        <b class="d-block" id="penimbangan_nama_ibu"></b>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <span class="text-danger">*</span><small> Keterangan di isi apabila balita tersebut
                                    pindah</small>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="inputbulan">Bulan</label>
                                    <input type="text" id="inputbulan" name="bulan" class="form-control"
                                        value="{{ date('F') }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="inputtahun">Tahun</label>
                                    <input type="text" id="inputtahun" name="tahun" class="form-control"
                                        value="{{ date('Y') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputbb">Berat Badan Balita</label>
                                    <input type="text" id="inputbb" name="bb" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputttb">Tinggi Badan</label>
                                    <input type="text" id="inputttb" name="tb" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputketerangan">Keterangan</label>
                                    <input type="text" id="inputketerangan" name="keterangan" class="form-control">
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

    <div class="modal fade" id="modalUbahPenimbangan">
        <div class="modal-dialog modal-lg">
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
                            <div class="col-md-4">
                                <div class="text-muted">
                                    <p class="text-lg">Nama Balita
                                        <b class="d-block" id="nama_balita"></b>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-4" style="display: none;" id="pemberian_vitamin_info_nama_ayah">
                                <div class="text-muted">
                                    <p class="text-lg">Nama Ayah
                                        <b class="d-block" id="pemberian_vitamin_nama_ayah"></b>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-4" style="display: none;" id="pemberian_vitamin_info_nama_ibu">
                                <div class="text-muted">
                                    <p class="text-lg">Nama Ibu
                                        <b class="d-block" id="pemberian_vitamin_nama_ibu"></b>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <span class="text-danger">*</span><small> Keterangan di isi apabila balita tersebut
                                    pindah</small>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="inputbulan">Bulan</label>
                                    <input type="text" id="inputbulan" name="bulan" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="inputtahun">Tahun</label>
                                    <input type="text" id="inputtahun" name="tahun" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputbb">Berat Badan Balita</label>
                                    <input type="text" id="inputbb" name="bb" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputtb">Tinggi Badan</label>
                                    <input type="text" id="inputtb" name="tb" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputketerangan">Keterangan</label>
                                    <input type="text" id="inputketerangan" name="keterangan" class="form-control">
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
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            $('#table_penimbangan').DataTable({
                scrollX: true,
                fixedColumns: {
                    left: 1
                },
                ajax: 'penimbangan',
                columns: [{
                        data: 'balita.nama_lengkap',
                        name: 'balita.nama_lengkap',
                        width: '20%'
                    },
                    {
                        data: 'bb',
                        name: 'bb',
                        width: '5%'
                    },
                    {
                        data: 'tb',
                        name: 'tb',
                        width: '5%'
                    },
                    {
                        data: 'bulan',
                        name: 'bulan',
                        // render: function(data) {
                        //     if (data == 'ags') {
                        //         return "Agustus";
                        //     } else {
                        //         return "-";
                        //     }
                        // },
                        width: '10%'
                    },
                    {
                        data: 'tahun',
                        name: 'tahun',
                        width: '10%'
                    },
                    {
                        data: 'keterangan',
                        orderable: false,
                        width: '23%'
                    },
                    {
                        data: 'aksi',
                        orderable: false
                    }
                ]
            });

            $('#select_get_nama_balita_penimbangan').select2({
                theme: 'bootstrap4',
                placeholder: 'Pilih Nama Balita'
            });

            $('#select_get_nama_balita_penimbangan').on('select2:select', function(e) {
                e.preventDefault();
                const id = e.params.data.id;

                $.get("get_nama_balita/" + id, function(data, textStatus, jqXHR) {
                    const ortu = data;
                    $("#penimbangan_nama_ayah").text(data.nama_ayah);
                    $("#penimbangan_nama_ibu").text(data.nama_ibu);
                    $('#penimbangan_info_nama_ayah').show();
                    $('#penimbangan_info_nama_ibu').show();
                });
            });

            $('#formTambahPenimbangan').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);

                $.ajax({
                    type: "POST",
                    url: "penimbangan",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response == 200) {
                            $('#table_penimbangan').DataTable().ajax.reload(null, false);
                            $('#modalTambahPenimbangan').modal('toggle');
                            $('#formTambahPenimbangan')[0].reset();
                            kosongkan()
                            Toast.fire({
                                icon: 'success',
                                title: 'Berhasil Menambah Data Kader Baru.'
                            });
                        } else {
                            $.each(response.error, function(indexInArray, valueOfElement) {
                                $('#formTambahPenimbangan #input' + indexInArray)
                                    .addClass('is-invalid').after('<span id="input' +
                                        index +
                                        '-error" class="error invalid-feedback">' +
                                        value + '</span>');
                            });
                        }
                    }
                });
            });

            $('#formUbahPenimbangan').submit(function(e) {
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
                    url: "penimbangan/" + id,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response == 200) {
                            $('#table_penimbangan').DataTable().ajax.reload(null, false);
                            $('#formUbahPenimbangan')[0].reset();
                            $('#modalUbahPenimbangan').modal('toggle');
                            Toast.fire({
                                icon: 'success',
                                title: 'Berhasil Menambah Data Kader Baru.'
                            });
                        } else {
                            $.each(response.error, function(indexInArray, valueOfElement) {
                                $('#formTambahPenimbangan #input' + indexInArray)
                                    .addClass('is-invalid').after('<span id="input' +
                                        index +
                                        '-error" class="error invalid-feedback">' +
                                        value + '</span>');
                            });
                        }
                    }
                });
            })
        });

        function kosongkan() {
            $('#select_get_nama_balita_penimbangan').select2({
                theme: 'bootstrap4',
                placeholder: 'Pilih Nama Balita'
            });
            $("#penimbangan_nama_ayah").text('');
            $("#penimbangan_nama_ibu").text('');
            $('#penimbangan_info_nama_ayah').hide();
            $('#penimbangan_info_nama_ibu').hide();
        }

        function ubahDataPenimbangan(id) {
            $.get("penimbangan/" + id + "/edit", function(data, textStatus, jqXHR) {
                const d = JSON.parse(atob(data));
                $('#formUbahPenimbangan #nama_balita').before(
                    '<input type="text" id="inputid" name="id" class="form-control" value="' + d.id + '">');
                $('#formUbahPenimbangan #inputid').hide();
                $('#formUbahPenimbangan #nama_balita').text(d.balita.nama_lengkap);
                $('#formUbahPenimbangan #inputbulan').val(d.bulan);
                $('#formUbahPenimbangan #inputtahun').val(d.tahun);
                $('#formUbahPenimbangan #inputbb').val(d.bb);
                $('#formUbahPenimbangan #inputtb').val(d.tb);
                $('#formUbahPenimbangan #inputketerangan').val(d.keterangan);
                $('#modalUbahPenimbangan').modal('toggle');
            });
        }

        function hapusDataPenimbangan(id) {
            $.ajax({
                type: "POST",
                url: "penimbangan/delete/" + id,
                data: {
                    id: id,
                    _token: $("meta[name=csrf-token]").attr('content')
                },
                success: function(response) {
                    if (response == 200) {
                        $('#table_penimbangan').DataTable().ajax.reload(null, false);
                        Toast.fire({
                            icon: 'success',
                            title: 'Berhasil Menghapus Data Kader.'
                        });
                    }
                }
            });
        }
    </script>
@endpush
