@extends('layouts.app', [$activePage])

<?php
$hari_ini = date('d-m-yy');
?>

{{-- {{ dd($balitas) }} --}}
{{-- @foreach ($balitas as $item)
    {{ $item['id'] }}
    {{ $item['nama_lengkap'] }}
@endforeach --}}
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
                        <li class="breadcrumb-item"><a href="{{ route('imunisasi.index') }}">Imunisasi</a></li>
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
            <form id="formTambahImunisasi">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-outline card-primary shadow-sm">
                            <div class="card-header bg-default">
                                <h3 class="card-title mt-2">Data Balita</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-success block" data-toggle="modal"
                                        data-target="#modalTambahBalita">
                                        Tambah Data Balita
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <i class="nav-icon fa fa-exclamation text-warning"></i>
                                        <span> Jika nama balita tidak ada, tambahkan data balita dengan klik tombol
                                            <b>"Tambah Data Balita"</b></span>
                                        <hr>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Nama Balita</label>
                                            <select class="form-control" id="selectid_balita" name="id_balita"
                                                style="width: 100%;">
                                                <option value=""></option>

                                                @foreach ($balitas as $item)
                                                    <option value="{{ encrypt($item['id']) }}">
                                                        {{ $item['nama_lengkap'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12" style="display: none;" id="imunisasi_info_ortu">
                                        <div class="text-muted">
                                            <p class="text-lg">Nama Ayah
                                                <b class="d-block" id="imunisasi_nama_ayah"></b>
                                            </p>
                                            <p class="text-lg">Nama Ibu
                                                <b class="d-block" id="imunisasi_nama_ibu"></b>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-6">
                        <div class="card card-outline card-primary shadow-sm">
                            <div class="card-header bg-default">
                                <h3 class="card-title mt-2">{{ $activePage }}</h3>

                                <div class="card-tools">
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- checkbox -->
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    {{-- <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <input type="checkbox" id="hb0">
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control datepicker" name="imun[hb0]" autocomplete="off">
                                                    </div> --}}
                                                    <!-- /input-group -->
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" type="checkbox" id="hb0"
                                                            name="imun[]" value="hb0">
                                                        <label for="hb0" class="custom-control-label">HB0</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" type="checkbox" id="bcg"
                                                            name="imun[]" value="bcg">
                                                        <label for="bcg" class="custom-control-label">BCG</label>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="col-md-6">
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" type="checkbox" id="p1"
                                                            name="imun[]" value="p1">
                                                        <label for="p1" class="custom-control-label">P1</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" type="checkbox" id="p2"
                                                            name="imun[]" value="p2">
                                                        <label for="p2" class="custom-control-label">P2</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" type="checkbox" id="p3"
                                                            name="imun[]" value="p3">
                                                        <label for="p3" class="custom-control-label">P3</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" type="checkbox" id="p4"
                                                            name="imun[]" value="p4">
                                                        <label for="p4" class="custom-control-label">P4</label>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="col-md-6">
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" type="checkbox" id="dpt1"
                                                            name="imun[]" value="dpt1">
                                                        <label for="dpt1" class="custom-control-label">DPT1</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" type="checkbox" id="dpt2"
                                                            name="imun[]" value="dpt2">
                                                        <label for="dpt2" class="custom-control-label">DPT2</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" type="checkbox" id="dpt3"
                                                            name="imun[]" value="dpt3">
                                                        <label for="dpt3" class="custom-control-label">DPT3</label>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="col-md-6"></div>
                                                <div class="col-md-6">
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" type="checkbox" id="pcv1"
                                                            name="imun[]" value="pcv1">
                                                        <label for="pcv1" class="custom-control-label">PCV1</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" type="checkbox" id="pcv2"
                                                            name="imun[]" value="pcv2">
                                                        <label for="pcv2" class="custom-control-label">PCV2</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" type="checkbox" id="pcv3"
                                                            name="imun[]" value="pcv3">
                                                        <label for="pcv3" class="custom-control-label">PCV3</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                                <hr>
                                                <div class="col-md-6">
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" type="checkbox" id="ipv"
                                                            name="imun[]" value="ipv">
                                                        <label for="ipv" class="custom-control-label">IPV</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" type="checkbox" id="campak"
                                                            name="imun[]" value="campak">
                                                        <label for="campak" class="custom-control-label">Campak</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success text-white float-right mb-3 shadow-sm">Simpan</button>
                    </div>
                </div>
            </form>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

    <div class="modal fade" id="modalTambahBalita">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h4 class="modal-title">Tambah Data Balita Baru</h4>
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
                                    <label for="inputnik">NIK Balita</label>
                                    <input type="text" id="inputnik" name="nik" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnama_lengkap">Nama Lengkap</label>
                                    <input type="text" id="inputnama_lengkap" name="nama_lengkap" class="form-control">
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
                                    <label for="selectjeni_kelamin">Jenis Kelamin</label>
                                    <select class="custom-select rounded-0" id="selectjenis_kelamin" name="jenis_kelamin">
                                        <option value=""></option>
                                        <option value="Laki-Laki">Laki-Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h4>Orang Tua / Wali</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnama_ayah">Nama Ayah</label>
                                    <input type="text" id="inputnama_ayah" name="nama_ayah" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnama_ibu">Nama Ibu</label>
                                    <input type="text" id="inputnama_ibu" name="nama_ibu" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnomor_telepon">Nomor Telepon</label>
                                    <input type="text" id="inputnomor_telepon" name="nomor_telepon" class="form-control">
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
    <script type="text/javascript">
        $(function() {
            $(".datepicker").datepicker();

            $('#selectid_balita').select2({
                theme: 'bootstrap4',
                placeholder: 'Pilih/Cari Nama Balita'
            });

            $('#selectjenis_kelamin').select2({
                theme: 'bootstrap4',
                placeholder: 'Pilih Jenis Kelamin'
            });

            // search nama balita dan set data ke dalam input
            $('#selectid_balita').on('select2:select', function(e) {
                const id = e.params.data.id;

                // jquery get data berdasarkan id dari balita
                $.get("get_nama_ortu/" + id, function(data) {
                    const imunisasi = data.imunisasi;

                    if (imunisasi != null) {
                        // perulangan dari array variabel imunisasi
                        $.each(imunisasi, function(indexInArray, valueOfElement) {

                            // kondisi jika bukan index array
                            if (indexInArray != 'id' && indexInArray != 'created_at' &&
                                indexInArray != 'updated_at' && indexInArray != 'balita_id'
                            ) {
                                // kondisi jika value tidak null
                                if (valueOfElement != null) {
                                    document.getElementById(indexInArray).checked = true;
                                } else {
                                    document.getElementById(indexInArray).checked = false;
                                }
                            }
                        });
                    } else {
                        clearCeckBox();
                    }
                    $("#imunisasi_nama_ayah").text(data.nama_ayah);
                    $("#imunisasi_nama_ibu").text(data.nama_ibu);
                    $('#imunisasi_info_ortu').show();
                });
            });

            $('#formTambahImunisasi').submit(function(e) {
                e.preventDefault()

                var formData = new FormData(this);

                $.ajax({
                    type: "POST",
                    url: "{{ route('imunisasi.store') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response == 200) {
                            $('#formTambahImunisasi')[0].reset();
                            $('#selectid_balita').select2({
                                theme: 'bootstrap4',
                                placeholder: 'Pilih/Cari Nama Balita'
                            });
                            $("#imunisasi_nama_ayah").text();
                            $("#imunisasi_nama_ibu").text();
                            $('#imunisasi_info_ortu').hide();
                            toastr.success('Berhasil Menambah/Update Data Imunisasi.');
                        }
                    },
                    error: (response) => {
                        if (response.responseJSON.errors) {
                            toastr.error('Gagal Menambah/Update Data Imunisasi.');
                            $.each(response.responseJSON.errors, function(index, value) {
                                $("#formTambahImunisasi #select" + index)
                                    .addClass('is-invalid');
                                $("#formTambahImunisasi .select2").after(
                                    '<span style="color: #dc3545;" class="text-sm">nama balita wajib di isi</span>'
                                );
                            });
                        }
                    }
                });
            });

            $('#formTambahBalita').submit(function(e) {
                e.preventDefault();
                const formData = new FormData(this);

                $.ajax({
                    type: "post",
                    url: "{{ route('balita.store') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // console.log(response);
                        if (response.status == 200) {
                            $("#formTambahBalita")[0].reset();
                            $("#modalTambahBalita").modal('toggle');
                            let option = new Option(response.nama_balita, response.id, true,
                                true);
                            $("#selectid_balita").append(option);
                            toastr.success('Berhasil Menambah Data Balita.');
                        }
                    },
                    error: function(response) {
                        if (response.responseJSON.errors) {
                            toastr.error('Gagal Menambah Data Balita.');
                            $.each(response.responseJSON.errors, function(index, value) {
                                if ($("#formTambahBalita #input" + index).length) {
                                    $("#formTambahBalita #input" + index)
                                        .addClass(
                                            'is-invalid').after(
                                            '<span id="input' +
                                            index +
                                            '-error" class="error invalid-feedback">' +
                                            value + '</span>');
                                } else {
                                    $("#formTambahBalita #select" + index)
                                        .addClass('is-invalid');
                                    $("#formTambahBalita .select2").after(
                                        '<span style="color: #dc3545;" class="text-sm">' +
                                        value + '</span>');
                                }
                            });
                        }
                    }
                });
            });
        });

        function clearCeckBox() {
            document.getElementById('hb0').checked = false;
            document.getElementById('bcg').checked = false;
            document.getElementById('p1').checked = false;
            document.getElementById('p2').checked = false;
            document.getElementById('p3').checked = false;
            document.getElementById('p4').checked = false;
            document.getElementById('dpt1').checked = false;
            document.getElementById('dpt2').checked = false;
            document.getElementById('dpt3').checked = false;
            document.getElementById('pcv1').checked = false;
            document.getElementById('pcv2').checked = false;
            document.getElementById('pcv3').checked = false;
            document.getElementById('ipv').checked = false;
            document.getElementById('campak').checked = false;
        }
    </script>
@endpush
