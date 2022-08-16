@extends('layouts.app', [$activePage])

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $activePage }}</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <form id="formTambahPenimbangandanVitamin">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-md-9">
                        <div class="card card-outline card-primary shadow-sm">
                            <div class="card-header bg-default">
                                <h3 class="card-title mt-2">Data Balita</h3>

                                {{-- <div class="card-tools">
                                    <button type="button" class="btn btn-success block" data-toggle="modal"
                                        data-target="#modalTambahBalita">
                                        Tambah Data Balita
                                    </button>
                                </div> --}}
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="callout callout-warning">
                                            <li><span> Jika nama balita tidak ada, tambahkan data balita dengan klik tombol
                                                    <b>"Tambah Data Balita"</b></span></li>
                                            <li><span>Vitamin A diberikan 2 kali dalam 1 tahun, setiap bulan Januari dan
                                                    Agustus</span></li>
                                            <li><span>Vitamin A - <span style="color: red;">Merah</span> = diberikan untuk
                                                    balita kurang dari 2 tahun</span></li>
                                            <li><span>Vitamin A - <span style="color: blue;">Biru</span> = diberikan untuk
                                                    balita lebih dari 2 tahun</span></li>
                                        </div>
                                        {{-- <i class="nav-icon fa fa-exclamation text-warning"></i> --}}
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group" id="nama_balita">
                                            <label>Nama Balita</label>
                                            <select class="form-control" id="selectnama_balita" name="nama_balita"
                                                style="width: 100%;">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3 mx-auto" style="display: none;" id="imunisasi_info_ayah">
                                        <div class="text-muted">
                                            <p class="text-lg">Nama Ayah
                                                <b class="d-block" id="imunisasi_nama_ayah"></b>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3 mx-auto" style="display: none;" id="imunisasi_info_ibu">
                                        <div class="text-muted">
                                            <p class="text-lg">Nama Ibu
                                                <b class="d-block" id="imunisasi_nama_ibu"></b>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                {{-- /.row --}}
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="selectrole">Vitamin A</label>
                                            <select class="custom-select rounded-0" id="selectvitamin_a" name="vitamin_a">
                                                <option value="">-</option>
                                                <option value="Biru">Biru</option>
                                                <option value="Merah">Merah</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="inputbb">Berat Badan (kg) <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" id="inputbb" name="bb" class="form-control" placeholder="Contoh: 15">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="inputtb">Tinggi Badan (cm) <span class="text-danger">*</span></label>
                                            <input type="text" id="inputtb" name="tb" class="form-control" placeholder="Contoh: 30">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="inputtanggal">Tanggal <span class="text-danger">*</span></label>
                                            <input type="text" id="inputanggal" name="tanggal" class="form-control datepicker" autocomplete="off" value="{{ date('Y-m-d') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="selectaksi_eksklusif">Aksi Eksklusif </label>
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
                                            <label for="selectinisiatif_menyusui_dini">Inisiatif Menyusui Dini (IMD)
                                            </label>
                                            <select class="custom-select rounded-0" id="selectinisiatif_menyusui_dini"
                                                name="inisiatif_menyusui_dini">
                                                <option value="">-</option>
                                                <option value="Ya">Ya</option>
                                                <option value="Tidak">Tidak</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                {{-- /.row --}}
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit"
                                    class="btn btn-success text-white float-right mb-3 shadow-sm">Simpan</button>
                            </div>
                        </div>
                        <!-- /.card -->
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
                    <h4 class="modal-title">Tambah Data {{ $activePage }} Baru</h4>
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
                                    <label for="inputnik">NIK Balita <span class="text-danger">*</span></label>
                                    <input type="text" id="inputnik" name="nik" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnama_lengkap">Nama Lengkap <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="inputnama_lengkap" name="nama_lengkap" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputtanggal_lahir">Tanggal Lahir <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="inputtanggal_lahir" name="tanggal_lahir" class="form-control datepicker" autocomplete="off">
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
                                    <select class="custom-select rounded-0" id="selectproses_lahiran" name="proses_lahiran">
                                        <option value=""></option>
                                        <option value="Normal">Normal</option>
                                        <option value="SC">SC</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="inputbbl">BBL</label>
                                    <input type="text" id="inputbbl" name="bbl" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="inputpb">PB</label>
                                    <input type="text" id="inputpb" name="pb" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputtempat_lahir">Tempat Lahir (RS)</label>
                                    <input type="text" id="inputtempat_lahir" name="tempat_lahir" class="form-control">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h4>Orang Tua / Wali</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnik_istri">NIK Ibu <span class="text-danger">*</span></label>
                                    <input type="text" id="inputnik_istri" name="nik_istri" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnama_ibu">Nama Ibu <span class="text-danger">*</span></label>
                                    <input type="text" id="inputnama_ibu" name="nama_ibu" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group" id="dialog">
                                    <label for="inputnama_ayah">Nama Ayah <span class="text-danger">*</span></label>
                                    <input type="text" id="inputnama_ayah" name="nama_ayah" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnomor_telepon">Nomor Telepon <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="inputnomor_telepon" name="nomor_telepon" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="inputrt">RT <span class="text-danger">*</span></label>
                                    <input type="text" id="inputrt" name="rt" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="inputrw">RW <span class="text-danger">*</span></label>
                                    <input type="text" id="inputrw" name="rw" class="form-control">
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
            $("input.datepicker").datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            });

            $('#selectnama_balita').select2({
                theme: 'bootstrap4',
                placeholder: 'Pilih/Cari Nama Balita',
                ajax: {
                    url: '{{ route('getNamaBalitaPenimbangan') }}',
                    type: 'POST',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            _token: $("meta[name=csrf-token]").attr('content'),
                            search: params.term
                        };
                    },
                    processResults: function(response) {
                        return {
                            results: $.map(response, function(obj) {
                                return {
                                    id: obj.id,
                                    text: obj.text
                                };
                            })
                        };
                    },
                    cache: true
                }
            });

            $('#selectjenis_kelamin').select2({
                theme: 'bootstrap4',
                placeholder: 'Pilih Jenis Kelamin',
                minimumResultsForSearch: -1
            });

            $('#selectproses_lahiran').select2({
                theme: 'bootstrap4',
                placeholder: 'Pilih Proses Lahiran',
                minimumResultsForSearch: -1
            });

            $("#selectvitamin_a").select2({
                theme: 'bootstrap4',
                placeholder: 'Pilih Vitamin',
                minimumResultsForSearch: -1
            });

            $("#selectaksi_eksklusif").select2({
                theme: 'bootstrap4',
                placeholder: 'Pilih Aksi Eksklusif',
                minimumResultsForSearch: -1
            });

            $("#selectinisiatif_menyusui_dini").select2({
                theme: 'bootstrap4',
                placeholder: 'Pilih IMD',
                minimumResultsForSearch: -1
            });

            // search nama balita dan set data ke dalam input
            $('#selectnama_balita').on('select2:select', function(e) {
                const id = e.params.data.id;

                // jquery get data berdasarkan id dari balita
                $.get("get_nama_ortu/" + id, function(data) {
                    $("#imunisasi_nama_ayah").text(data.nama_suami);
                    $("#imunisasi_nama_ibu").text(data.nama_istri);
                    $('#imunisasi_info_ayah').show();
                    $('#imunisasi_info_ibu').show();
                    $("#inputtb").val('');
                    $("#inputbb").val('');
                    $("#inputtanggal").val('');
                });
            });

            $('#formTambahPenimbangandanVitamin').submit(function(e) {
                e.preventDefault()
                removeError('TambahPenimbangandanVitamin');

                var formData = new FormData(this);

                $.ajax({
                    type: "POST",
                    url: "{{ route('pemberian_vitamin.store') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response == 200) {
                            $('#formTambahPenimbangandanVitamin')[0].reset();
                            $('#selectnama_balita').val('').trigger('change');
                            $('#selectvitamin_a').val('').trigger('change');
                            $('#selectaksi_eksklusif').val('').trigger('change');
                            $('#selectinisiatif_menyusui_dini').val('').trigger('change');
                            $("#imunisasi_nama_ayah").text();
                            $("#imunisasi_nama_ibu").text();
                            $('#imunisasi_info_ayah').hide();
                            $('#imunisasi_info_ibu').hide();
                            toastr.success('Berhasil Menambah Data Penimbangan atau Vitamin.');
                        }
                    },
                    error: (response) => {
                        if (response.status == 422) {
                            toastr.error('Gagal Menambah Data Penimbangan dan Vitamin.');
                            $.each(response.responseJSON.errors, function(index, value) {
                                errorFrom("TambahPenimbangandanVitamin", index, value);
                            });
                        } else {
                            toastr.error(response.responseJSON.message);
                        }
                    }
                });
            });

            $("#formTambahBalita #inputnama_ibu").autocomplete({
                appendTo: "#dialog",
                source: function(request, response) {
                    $.ajax({
                        type: "post",
                        url: "nama_ibu",
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
                    $('#formTambahBalita #inputnik_istri').val(ui.item.nik);
                    $('#formTambahBalita #inputnama_ibu').val(ui.item.label);
                    $('#formTambahBalita #inputnama_ayah').val(ui.item.nama_ayah);
                    $('#formTambahBalita #inputnomor_telepon').val(ui.item.nomor_telepon);
                    $('#formTambahBalita #inputrt').val(ui.item.rt);
                    $('#formTambahBalita #inputrw').val(ui.item.rw);
                    return false;
                }
            })

            $("#modalTambahBalita").on('hidden.bs.modal', function(e) {
                removeError("TambahBalita");
            });

            $("#formTambahBalita").submit(function(e) {
                e.preventDefault();
                removeError("TambahBalita");
                var formData = new FormData(this);

                $.ajax({
                    type: "POST",
                    url: "{{ route("balita.store") }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status == 200) {
                            $("#table-balita").DataTable().ajax.reload(null, false);
                            $("#modalTambahBalita").modal('toggle');
                            $("#formTambahBalita")[0].reset();
                            toastr.success('Berhasil Menambah Data Balita.');
                        }
                    },
                    error: function(response) {
                        if (response.status == 422) {
                            toastr.error('Gagal Menambah Data Balita.');
                            $.each(response.responseJSON.errors, function(index, value) {
                                errorFrom("TambahBalita", index, value);
                            });
                        } else {
                            toastr.error(response.responseJSON.message);
                        }

                    }
                });
            });
        });

        // METHOD UNTUK MENAMPILKAN ERROR SESUAI DENGAN INPUTNYA
        function errorFrom(aksi, index, value) {
            if ($("#form" + aksi + " #input" + index).length) {
                $("#form" + aksi + " #input" + index).addClass('is-invalid')
                    .after('<span id="input' + index + '-error" class="error invalid-feedback">' + value + '</span>');
            } else {
                $("#form" + aksi + " #select" + index)
                    .addClass('is-invalid');
                $("#form" + aksi + " #" + index + " .select2").after(
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
