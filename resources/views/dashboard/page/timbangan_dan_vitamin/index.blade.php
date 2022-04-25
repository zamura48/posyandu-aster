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
                            data-target="#modalTambahPemberianVitamin">
                            Tambah Data {{ $activePage }}
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="table_timbang_dan_vitamin" class="table table-bordered table-hover">
                        <thead class="text-center">
                            <th class="align-middle" rowspan="2">Nama</th>
                            <th colspan="2">Vitamin</th>
                            <th class="align-middle" rowspan="2">BB</th>
                            <th class="align-middle" rowspan="2">TB</th>
                            <th class="align-middle" rowspan="2">Aksi Eksklusif</th>
                            <th class="align-middle" rowspan="2">IMD</th>
                            <th class="align-middle" rowspan="2">Aksi</th>
                            <tr>
                                <th>Merah</th>
                                <th>Biru</th>
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

    <div class="modal fade" id="modalTambahPemberianVitamin">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h4 class="modal-title">Tambah Data {{ $activePage }} Baru</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formTambahPemberianVitamin">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nama Balita</label>
                                    <select class="form-control" id="select_get_nama_balita_pemberian_vitamin"
                                        name="id_balita" style="width: 100%;" required>
                                        <option value=""></option>
                                        @foreach ($balitas as $balita)
                                            <option value="{{ encrypt($balita->id) }}">
                                                {{ $balita->nama_lengkap }}
                                            </option>
                                        @endforeach
                                    </select>
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
                                <span class="text-danger">*</span><small> Boleh dikosongi / tidak dipilih</small>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="selectrole">Vitamin A</label>
                                    <select class="custom-select rounded-0" id="selectvitamin_a" name="vitamin_a" required>
                                        <option value="">-</option>
                                        <option value="Biru">Biru</option>
                                        <option value="Merah">Merah</option>
                                    </select>
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
                                    <label for="selectaksi_eksklusif">Aksi Eksklusif <span
                                            class="text-danger">*</span></label>
                                    <select class="custom-select rounded-0" id="selectaksi_eksklusif" name="aksi_eksklusif">
                                        <option value="">-</option>
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak">Tidak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="selectinisiatif_menyusui_dini">Inisiatif Menyusui Dini(IMD) <span
                                            class="text-danger">*</span></label>
                                    <select class="custom-select rounded-0" id="selectinisiatif_menyusui_dini"
                                        name="inisiatif_menyusui_dini">
                                        <option value="">-</option>
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak">Tidak</option>
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

    <div class="modal fade" id="modalUbahPemberianVitamin">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h4 class="modal-title">Ubah Data {{ $activePage }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formUbahPemberianVitamin">
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
                            <div class="col-md-4">
                                <div class="text-muted">
                                    <p class="text-lg">Nama Ayah
                                        <b class="d-block" id="pemberian_vitamin_nama_ayah"></b>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-4">
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
                                <span class="text-danger">*</span><small> Boleh dikosongi / tidak dipilih</small>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="selectrole">Role</label>
                                    <select class="custom-select rounded-0" id="selectvitamin_a" name="vitamin_a" required>
                                        <option value="">-</option>
                                        <option value="Biru">Biru</option>
                                        <option value="Merah">Merah</option>
                                    </select>
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
                                    <input type="text" id="inputtb" name="tb" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="selectaksi_eksklusif">Aksi Eksklusif <span
                                            class="text-danger">*</span></label>
                                    <select class="custom-select rounded-0" id="selectaksi_eksklusif"
                                        name="aksi_eksklusif">
                                        <option value="">-</option>
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak">Tidak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="selectinisiatif_menyusui_dini">Inisiatif Menyusui Dini(IMD) <span
                                            class="text-danger">*</span></label>
                                    <select class="custom-select rounded-0" id="selectinisiatif_menyusui_dini"
                                        name="inisiatif_menyusui_dini">
                                        <option value="">-</option>
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak">Tidak</option>
                                    </select>
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

            $('#table_timbang_dan_vitamin').DataTable({
                scrollX: true,
                scrollCollapse: true,
                fixedColumns: {
                    left: 1
                },
                ajax: 'pemberian_vitamin',
                columns: [{
                        data: 'balita.nama_lengkap',
                        name: 'balita.nama_lengkap'
                    },
                    {
                        data: 'vitamin_a',
                        orderable: false,
                        render: function(data) {
                            if (data == "Merah") {
                                return data;
                            } else {
                                return "-";
                            }
                        }
                    },
                    {
                        data: 'vitamin_a',
                        orderable: false,
                        render: function(data) {
                            if (data == "Biru") {
                                return data;
                            } else {
                                return "-";
                            }
                        }
                    },
                    {
                        data: 'bb'
                    },
                    {
                        data: 'tb'
                    },
                    {
                        data: 'aksi_eksklusif',
                        render: function(data) {
                            if (data != null) {
                                return data;
                            } else {
                                return "-";
                            }
                        },
                        width: '10%'
                    },
                    {
                        data: 'inisiatif_menyusui_dini',
                        render: function(data) {
                            if (data != null) {
                                return data;
                            } else {
                                return "-";
                            }
                        },
                        width: '10%'
                    },
                    {
                        data: 'aksi',
                        orderable: false,
                        width: '17%'
                    }
                ],
                columnDefs: [{
                        targets: 1,
                        className: 'text-center'
                    },
                    {
                        targets: 2,
                        className: 'text-center'
                    },
                    {
                        targets: 5,
                        className: 'text-center'
                    },
                    {
                        targets: 6,
                        className: 'text-center'
                    },
                ]
            });

            $('#select_get_nama_balita_pemberian_vitamin').select2({
                theme: 'bootstrap4',
                placeholder: 'Pilih/Cari Nama Balita'
            });

            // search balita menggunakan id
            $('#select_get_nama_balita_pemberian_vitamin').on('select2:select', function(e) {
                const id = e.params.data.id;

                // jquery get data berdasarkan id dari balita
                $.get("get_nama_balita/" + id, function(data) {
                    const ortu = data;
                    $("#pemberian_vitamin_nama_ayah").text(data.nama_ayah);
                    $("#pemberian_vitamin_nama_ibu").text(data.nama_ibu);
                    $('#pemberian_vitamin_info_nama_ayah').show();
                    $('#pemberian_vitamin_info_nama_ibu').show();
                });
            });

            $('#formTambahPemberianVitamin').submit(function(e) {
                e.preventDefault();

                let formData = new FormData(this);

                $.ajax({
                    type: "POST",
                    url: "{{ route('pemberian_vitamin.store') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response === 200) {
                            $('#table_timbang_dan_vitamin').DataTable().ajax.reload(null,
                                false);
                            $('#formTambahPemberianVitamin')[0].reset();
                            $('#modalTambahPemberianVitamin').modal('toggle');
                            kosongkan()
                            Toast.fire({
                                icon: 'success',
                                title: 'Berhasil Menambah Data Kader Baru.'
                            });
                        }
                    },
                    error: (response) => {
                        if (response.responseJSON.errors) {
                            $.each(response.responseJSON.errors, function(index, value) {
                                $('#formTambahPemberianVitamin #input' + indexInArray)
                                    .addClass('is-invalid').after('<span id="input' +
                                        index +
                                        '-error" class="error invalid-feedback">' +
                                        value + '</span>');
                            });
                        } else {
                            $("#formTambahPemberianVitamin #select" + index)
                                .addClass('is-invalid');
                            $("#formTambahPemberianVitamin .select2").after(
                                '<span style="color: #dc3545;" class="text-sm">' +
                                value + '</span>');
                        }
                    }
                });
            });

            $('#formUbahPemberianVitamin').submit(function(e) {
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
                    url: "pemberian_vitamin/" + id,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response === 200) {
                            $('#table_timbang_dan_vitamin').DataTable().ajax.reload(null,
                                false);
                            $('#formUbahPemberianVitamin')[0].reset();
                            $('#modalUbahPemberianVitamin').modal('toggle');
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

        function kosongkan() {
            $('#select_get_nama_balita_pemberian_vitamin').select2({
                theme: 'bootstrap4',
                placeholder: 'Pilih Nama Balita'
            });
            $("#pemberian_vitamin_nama_ayah").text('');
            $("#pemberian_vitamin_nama_ibu").text('');
            $('#pemberian_vitamin_info_nama_ayah').hide();
            $('#pemberian_vitamin_info_nama_ibu').hide();
        }

        function ubahDataPemberianVitamin(id) {
            $.get("pemberian_vitamin/" + id + "/edit", function(data, textStatus, jqXHR) {
                const d = JSON.parse(atob(data));

                $('#formUbahPemberianVitamin #nama_balita').before(
                    '<input type="text" id="inputid" name="id" class="form-control" value="' + d.pemberian_vitamin.id + '">');
                $('#formUbahPemberianVitamin #inputid').hide();
                $('#formUbahPemberianVitamin #nama_balita').text(d.balita.nama_lengkap);
                $('#formUbahPemberianVitamin #pemberian_vitamin_nama_ayah').text(d.balita.ibu_balita.nama_ayah);
                $('#formUbahPemberianVitamin #pemberian_vitamin_nama_ibu').text(d.balita.ibu_balita.nama_ibu);
                $('#formUbahPemberianVitamin #selectvitamin_a').val(d.pemberian_vitamin.vitamin_a);
                $('#formUbahPemberianVitamin #inputbb').val(d.pemberian_vitamin.bb);
                $('#formUbahPemberianVitamin #inputtb').val(d.pemberian_vitamin.tb);
                $('#formUbahPemberianVitamin #selectaksi_eksklusif').val(d.pemberian_vitamin.aksi_eksklusif);
                $('#formUbahPemberianVitamin #selectinisiatif_menyusui_dini').val(d.pemberian_vitamin
                    .inisiatif_menyusui_dini);
                $('#modalUbahPemberianVitamin').modal('toggle');
            });
        }

        function hapusDataPemberianVitamin(id) {
            $.ajax({
                type: "POST",
                url: "pemberian_vitamin/delete/" + id,
                data: {
                    id: id,
                    _token: $("meta[name=csrf-token]").attr('content')
                },
                success: function(response) {
                    if (response == 200) {
                        $('#table_timbang_dan_vitamin').DataTable().ajax.reload(null, false);
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
