@extends('layouts.app', [$activePage])

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Kelola Data Pemeriksaan {{ $activePage }} - {{ $ibu_hamil->nama_istri }}</h1>
                </div><!-- /.col -->
                {{-- <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('ibu_hamil.index') }}">Kelola Data
                                {{ $activePage }}</a></li>
                        <li class="breadcrumb-item active">Kelola Data Riwayat Pemeriksaan {{ $activePage }}</li>
                    </ol>
                </div><!-- /.col --> --}}
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title mt-2 mb-2">Riwayat Pemeriksaan {{ $activePage }} - {{ $ibu_hamil->nama_istri }}
                    </h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-success btn-block" data-toggle="modal"
                            data-target="#modalTambahRiwayatIbuHamil">
                            Tambah Data Pemeriksaan {{ $activePage }}
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    {{-- Aksi Tambahan --}}
                    {{-- <div class="row ml-1">
                    <span><b> Filter Berdasarkan Tanggal Pemeriksaan</b></span>
                </div> --}}
                    {{-- <div class="row mb-3">
                    <div class="col-md-4 mt-2">
                        <div class="input-group input-daterange">
                            <input type="text" name="dari_tannggal" id="dari_tannggal" class="form-control"
                                placeholder="Dari Tanggal" autocomplete="off">
                            <input type="text" name="sampai_tanggal" id="sampai_tanggal" class="form-control"
                                placeholder="Sampai Tanggal" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-3 mt-2">
                        <button class="btn btn-primary" id="filter" name="filter">Filter</button>
                        <button class="btn btn-default" id="reset" name="reset">Reset</button>
                        <a href="javascript:void(0)" id="export_excel" class="btn btn-info">Export Excel</a>
                    </div>
                </div> --}}
                    {{-- TABEL --}}
                    <table id="table_edit_ibuhamil" class="table table-bordered table-hover text-nowrap">
                        <thead class="text-center">
                            <tr>
                                <th>Umur Kehamilan</th>
                                <th>Tablet Tambah Darah</th>
                                <th>Hasil Pemeriksaan</th>
                                <th>Keterangan</th>
                                <th>Tanggal Pemeriksaan</th>
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

    <div class="modal fade" id="modalTambahRiwayatIbuHamil">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h4 class="modal-title">Tambah Data Pemeriksaan {{ $activePage }} - {{ $ibu_hamil->nama_istri }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formTambahRiwayatIbuHamil">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <span class="text-danger">*</span><small> Wajib Diisi</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group" id="dialog">
                                    <label for="inputnama_istri">Nama Ibu Hamil <span
                                            class="text-danger">*</span></label>
                                    <input type="text" disabled id="inputnama_istri" name="nama_istri" class="form-control" value="{{ $ibu_hamil->nama_istri }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnik">NIK <span class="text-danger">*</span></label>
                                    <input type="text" readonly id="inputnik" name="nik" class="form-control"
                                    value="{{ $ibu_hamil->nik }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputtanggal_lahir">Tanggal Lahir <span
                                            class="text-danger">*</span></label>
                                    <input type="text" disabled id="inputtanggal_lahir" name="tanggal_lahir" class="form-control" autocomplete="off" value="{{ $ibu_hamil->tanggal_lahir }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputalamat">Alamat <span class="text-danger">*</span></label>
                                    <input type="text" disabled id="inputalamat" name="alamat" class="form-control"
                                    value="{{ $ibu_hamil->alamat }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnomor_telepon">Nomor Telepon <span
                                            class="text-danger">*</span></label>
                                    <input type="text" disabled id="inputnomor_telepon" name="nomor_telepon" class="form-control"
                                    value="{{ $ibu_hamil->nomor_telepon }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputpekerjaan_istri">Pekerjaan Istri <span
                                            class="text-danger">*</span></label>
                                    <input type="text" disabled id="inputpekerjaan_istri" name="pekerjaan_istri"
                                        class="form-control" value="{{ $ibu_hamil->pekerjaan_istri }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnama_suami">Nama Suami <span class="text-danger">*</span></label>
                                    <input type="text" disabled id="inputnama_suami" name="nama_suami" class="form-control" value="{{ $ibu_hamil->nama_suami }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputpekerjaan_suami">Pekerjaan Suami <span
                                            class="text-danger">*</span></label>
                                    <input type="text" disabled id="inputpekerjaan_suami" name="pekerjaan_suami"
                                        class="form-control" value="{{ $ibu_hamil->pekerjaan_suami }}">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="inputumur_kehamilan">Umur Kehamilan <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="inputumur_kehamilan" name="umur_kehamilan"
                                        class="form-control" placeholder="Contoh: 1">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="inputtambah_darah">Tablet Tambah Darah <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control" id="select_tambah_darah" name="tambah_darah"
                                        style="width: 100%;" required>
                                        <option value=""></option>
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak">Tidak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="inputhasil_pemeriksaan">Hasil Pemeriksaan</label>
                                    <input type="text" id="inputhasil_pemeriksaan" name="hasil_pemeriksaan"
                                        class="form-control" placeholder="Contoh: Kandungan Sehat">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="inputketerangan">Keterangan</label>
                                    <input type="text" id="inputketerangan" name="keterangan" class="form-control" placeholder="Contoh: Sudah Melahirkan">
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

    <div class="modal fade" id="modalUbahRiwayatIbuHamil">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h4 class="modal-title">Ubah Data {{ $activePage }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formUbahRiwayatIbuHamil">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <span class="text-danger">*</span><small> Wajib Diisi</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnama_istri">Nama Ibu Hamil <span class="text-danger">*</span></label>
                                    <input type="text" id="inputnama_istri" name="nama_istri" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnik">NIK <span class="text-danger">*</span></label>
                                    <input type="text" id="inputnik" name="nik" class="form-control"
                                        placeholder="ex. 1234567890123456">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputtanggal_lahir">Tanggal Lahir <span class="text-danger">*</span></label>
                                    <input type="text" id="inputtanggal_lahir" name="tanggal_lahir" class="form-control"
                                        autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputalamat">Alamat <span class="text-danger">*</span></label>
                                    <input type="text" id="inputalamat" name="alamat" class="form-control"
                                        placeholder="ex. jln. veteran">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnomor_telepon">Nomor Telepon <span class="text-danger">*</span></label>
                                    <input type="text" id="inputnomor_telepon" name="nomor_telepon" class="form-control"
                                        placeholder="ex. 088217643823">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputpekerjaan_istri">Pekerjaan Istri <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="inputpekerjaan_istri" name="pekerjaan_istri"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnama_suami">Nama Suami <span class="text-danger">*</span></label>
                                    <input type="text" id="inputnama_suami" name="nama_suami" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputpekerjaan_suami">Pekerjaan Suami <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="inputpekerjaan_suami" name="pekerjaan_suami"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="inputumur_kehamilan">Umur Kehamilan <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="inputumur_kehamilan" name="umur_kehamilan"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="inputtambah_darah">Tablet Tambah Darah <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control" id="select_tambah_darah" name="tambah_darah"
                                        style="width: 100%;" required>
                                        <option value=""></option>
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak">Tidak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="inputhasil_pemeriksaan">Hasil Pemeriksaan </label>
                                    <input type="text" id="inputhasil_pemeriksaan" name="hasil_pemeriksaan"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="inputketerangan">Keterangan</label>
                                    <input type="text" id="inputketerangan" name="keterangan" class="form-control">
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
            $('#select_tambah_darah').select2({
                theme: 'bootstrap4',
                placeholder: 'Pilih',
                minimumResultsForSearch: -1
            });

            $("#table_edit_ibuhamil").DataTable({
                scrollX: true,
                scrollCollapse: true,
                ajax: {
                    url: '{{ route('ibu_hamil.edit', $ibu_hamil->id) }}',
                },
                columns: [{
                        data: 'umur_kehamilan',
                        name: 'umur_kehamilan',
                        width: '13%'
                    },
                    {
                        data: 'pemberian_tablet_tambah_darah',
                        name: 'pemberian_tablet_tambah_darah',
                        width: '25%'
                    },
                    {
                        data: 'hasil_pemeriksaan',
                        name: 'hasil_pemeriksaan',
                        width: '20%',
                        orderable: false,
                        render: function(data){
                            return data == null ? '-' : data;
                        }
                    },
                    {
                        data: 'keterangan',
                        orderable: false,
                        render: function(data){
                            return data == null ? '-' : data;
                        }
                    },
                    {
                        data: 'tanggal_pemeriksaan'
                    },
                    {
                        data: 'aksi',
                        orderable: false
                    }
                ]
            });

            $('#formTambahRiwayatIbuHamil').submit(function(e) {
                e.preventDefault();
                removeError("TambahRiwayatIbuHamil");
                let formData = new FormData(this);
                let nik = $("#inputnik").val();

                $.ajax({
                    type: "POST",
                    url: "{{ route('ibu_hamil.store.riwayat_pemeriksaan') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response === 200) {
                            $('#table_edit_ibuhamil').DataTable().ajax.reload(null, false);
                            $('#formTambahRiwayatIbuHamil')[0].reset();
                            $('#modalTambahRiwayatIbuHamil').modal('toggle');
                            toastr.success('Berhasil Menambah Data Pemeriksaan.');
                            kosongkan();
                        }
                    },
                    error: (response) => {
                        if (response.status == 422) {
                            toastr.error('Gagal Menambah Data Ibu Hamil.');
                            $.each(response.responseJSON.errors, function(index, value) {
                                errorFrom("TambahRiwayatIbuHamil", index, value);
                            });
                        } else {
                            toastr.error(response.responseJSON.message);
                        }
                    }
                });
            });

            $('#formUbahRiwayatIbuHamil').submit(function(e) {
                e.preventDefault();
                removeError("UbahRiwayatIbuHamil");

                let formData = new FormData(this);
                let id = "";

                for (var key of formData.entries()) {
                    if (key[0] == "id") {
                        id = key[1];
                    }
                }

                let url = "{{ route("ibu_hamil.update", ':id') }}";
                url = url.replace(':id', id);

                $.ajax({
                    type: "POST",
                    url: url,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response === 200) {
                            $('#table_edit_ibuhamil').DataTable().ajax.reload(null, false);
                            $('#formUbahRiwayatIbuHamil')[0].reset();
                            $('#modalUbahRiwayatIbuHamil').modal('toggle');
                            toastr.success('Berhasil Mengubah Data Pemeriksaan.');
                        }
                    },
                    error: (response) => {
                        if (response.status == 422) {
                            toastr.error('Gagal Mengubah Data Ibu Hamil.');
                            $.each(response.responseJSON.errors, function(index, value) {
                                errorFrom("UbahRiwayatIbuHamil", index, value)
                            });
                        } else {
                            toastr.error(response.responseJSON.message);
                        }
                    }
                });
            });

        });

        function ubahDataRiwayatIbuHamil(id) {
            let url = "{{ route('ibu_hamil.getRiwayatIbuHamil', ':id') }}";
            url = url.replace(':id', id);
            console.log('tes');

            $.get(url, function(data, textStatus, jqXHR) {
                const d = JSON.parse(atob(data));
                $('#formUbahRiwayatIbuHamil #inputnik').before(
                    '<input type="text" id="inputid" name="id" class="form-control" value="' + d
                    .id + '">');
                $('#formUbahRiwayatIbuHamil #inputid').hide();
                $('#formUbahRiwayatIbuHamil #inputnik').val(d.ibu_hamil.nik);
                $('#formUbahRiwayatIbuHamil #inputnama_istri').val(d.ibu_hamil.nama_istri);
                $('#formUbahRiwayatIbuHamil #inputtanggal_lahir').val(d.ibu_hamil.tanggal_lahir);
                $('#formUbahRiwayatIbuHamil #inputalamat').val(d.ibu_hamil.alamat);
                $('#formUbahRiwayatIbuHamil #inputnomor_telepon').val(d.ibu_hamil.nomor_telepon);
                $('#formUbahRiwayatIbuHamil #inputpekerjaan_istri').val(d.ibu_hamil.pekerjaan_istri);
                $('#formUbahRiwayatIbuHamil #inputnama_suami').val(d.ibu_hamil.nama_suami);
                $('#formUbahRiwayatIbuHamil #inputpekerjaan_suami').val(d.ibu_hamil.pekerjaan_suami);
                $('#formUbahRiwayatIbuHamil #inputumur_kehamilan').val(d.umur_kehamilan);
                $('#formUbahRiwayatIbuHamil #select_tambah_darah').val(d.pemberian_tablet_tambah_darah);
                $('#formUbahRiwayatIbuHamil #inputhasil_pemeriksaan').val(d.hasil_pemeriksaan);
                $('#formUbahRiwayatIbuHamil #inputketerangan').val(d.keterangan);
                $('#modalUbahRiwayatIbuHamil').modal('toggle');
            });
        }

        function hapusDataRiwayatIbuHamil(id) {
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
                    let url = "{{ route("ibu_hamil.destroy.destroyRiwayatIbuHamil", ':id') }}";
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
                                toastr.success("Berhasil Menghapus Data Ibu Hamil.")
                                $('#table_edit_ibuhamil').DataTable().ajax.reload(null, false);
                            }
                        },
                        error: function(response) {
                            if (response.status == 422) {
                                toastr.error('Gagal Menghapus Data Data Ibu Hamil..');
                            } else {
                                toastr.error(response.responseJSON.message);
                            }
                        }
                    });
                }
            });
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
