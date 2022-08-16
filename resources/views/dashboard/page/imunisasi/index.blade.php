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
                        <button type="button" class="btn btn-success block" data-toggle="modal"
                            data-target="#modalTambahImunisasi">
                            Tambah Data {{ $activePage }}
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-1 mt-2">
                            <input type="text" name="tahun" id="tahun" class="form-control" placeholder="Tahun"
                                autocomplete="off">
                        </div>
                        <div class="col-md-4 mt-2">
                            <button class="btn btn-primary" id="filter" name="filter">Filter</button>
                            <button class="btn btn-default" id="reset" name="reset">Reset</button>
                            @can('kader')
                                <a href="export/imunisasi/{{ date('Y') }}" class="btn btn-info mr-1" id="export"
                                    name="export">Export Excel</a>
                            @endcan
                        </div>
                    </div>
                    <table id="table_imunisasi" class="table table-bordered table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>HB0</th>
                                <th>BCG</th>
                                <th>P1</th>
                                <th>DPT1</th>
                                <th>P2</th>
                                <th>PCV1</th>
                                <th>DPT2</th>
                                <th>P3</th>
                                <th>PCV2</th>
                                <th>DPT3</th>
                                <th>P4</th>
                                <th>PCV3</th>
                                <th>IPV</th>
                                <th>CAMPAK</th>
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

    {{-- <div class="modal fade" id="modalTambahImunisasi">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h4 class="modal-title">Tambah Data Imunisasi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formTambahImunisasi">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nama Balita</label>
                                    <select class="form-control" id="selectnama_balita" name="nama_balita" style="width: 100%;">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4" id="col_nama_ayah">
                                <div class="text-muted">
                                    <p class="text-lg">Nama Ayah
                                        <b class="d-block" id="nama_ayah"></b>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-4" id="col_nama_ibu">
                                <div class="text-muted">
                                    <p class="text-lg">Nama Ibu
                                        <b class="d-block" id="nama_ibu"></b>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <span>
                                    Pastikan untuk mencentang kolom jika ingin menambah data, apabila tidak di centang data
                                    tidak akan tersimpan <br>
                                    Isikan tanggal vaksin imunisasi pada input sesuai dengan nama vaksin
                                </span>
                            </div>
                            <div class="col-md-12">
                                <!-- checkbox -->
                                <div class="form-group">
                                    <div class="row">
                                        @foreach ($jenis_vaksin as $jv)
                                            <div class="col-md-2 mb-2">
                                                <label for="">{{ strtoupper($jv->jenis_vaksin) }}</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <input type="checkbox" id="checkbox_{{ $jv->jenis_vaksin }}"
                                                                name="checkbox[{{ $jv->jenis_vaksin }}]">
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control datepicker input-disabled"
                                                        id="{{ $jv->jenis_vaksin }}"
                                                        name="vaksi[{{ $jv->jenis_vaksin }}]" autocomplete="off"
                                                        placeholder="Tanggal">
                                                </div>
                                                <!-- /input-group -->
                                            </div>
                                        @endforeach
                                    </div>
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
    </div> --}}
    <!-- /.modal tambah -->

    <div class="modal fade" id="modalTambahImunisasi">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h4 class="modal-title">Tambah Data Imunisasi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formTambahImunisasi">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nama Balita</label>
                                    <select class="form-control" id="selectnama_balita" name="nama_balita" style="width: 100%;">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 text-center" id="col_nama_ayah">
                                <div class="text-muted">
                                    <p class="text-lg">Nama Ayah
                                        <b class="d-block" id="nama_ayah"></b>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6 text-center" id="col_nama_ibu">
                                <div class="text-muted">
                                    <p class="text-lg">Nama Ibu
                                        <b class="d-block" id="nama_ibu"></b>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <!-- checkbox -->
                                <div class="form-group">
                                    <label>Jenis Vaksin</label>
                                    <select class="form-control" id="selectjenis_vaksin" name="jenis_vaksin" style="width: 100%;">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input type="text" class="form-control" readonly name="tanggal_input" autocomplete="off" value="{{ date('Y-m-d') }}">
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

    <div class="modal fade" id="modalUbahImunisasi">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h4 class="modal-title">Ubah Data Imunisasi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formUbahImunisasi">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="text-muted">
                                    <p class="text-lg">Nama Balita
                                        <b class="d-block" id="nama_balita"></b>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="text-muted">
                                    <p class="text-lg">Nama Ayah
                                        <b class="d-block" id="nama_ayah"></b>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="text-muted">
                                    <p class="text-lg">Nama Ibu
                                        <b class="d-block" id="nama_ibu"></b>
                                    </p>
                                </div>
                            </div>
                            <input type="hidden" id="inputbalita_id" name="balita_id" class="form-control">
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <span>
                                    Pastikan untuk mencentang kolom jika ingin mengisi data, apabila tidak di centang data
                                    tidak akan tersimpan <br>
                                    Isikan tanggal vaksin imunisasi pada input sesuai dengan nama vaksin
                                </span>
                            </div>
                            <div class="col-md-12">
                                <!-- checkbox -->
                                <div class="form-group">
                                    <div class="row">
                                        @foreach ($jenis_vaksin as $jv)
                                            <div class="col-md-2 mb-2">
                                                <label for="">{{ strtoupper($jv->jenis_vaksin) }}</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <input type="checkbox"
                                                                id="checkbox_{{ $jv->jenis_vaksin }}"
                                                                name="checkbox[{{ $jv->jenis_vaksin }}]">
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control datepicker input-disabled"
                                                        id="{{ $jv->jenis_vaksin }}"
                                                        name="vaksi[{{ $jv->jenis_vaksin }}]" autocomplete="off">
                                                </div>
                                                <!-- /input-group -->
                                            </div>
                                        @endforeach
                                    </div>
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
    <!-- /.modal ubah -->
@endsection

@push('js')
    <script>
        $(function() {
            // MEMANGGIL METHOD DAN MELOAD DATATABLE
            load_data_imunisasi();
            $("#selectjenis_vaksin").select2({
                theme: 'bootstrap4',
                placeholder: 'Pilih/Cari Jenis Vaksin',
            });

            $('#selectnama_balita').select2({
                theme: 'bootstrap4',
                placeholder: 'Pilih/Cari Nama Balita',
                ajax: {
                    url: '{{ route('getNamaBalita') }}',
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
                        // return {response};
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

            // search nama balita dan set data ke dalam input
            $('#selectnama_balita').on('select2:select', function(e) {
                const id = e.params.data.id;
                $("#selectjenis_vaksin").val('').trigger('change');

                // jquery get data berdasarkan id dari balita
                $.get("get_nama_ortu/" + id, function(data) {
                    const imunisasi = data.imunisasi;
                    $("#formTambahImunisasi #nama_ayah").text(data.nama_istri);
                    $("#formTambahImunisasi #nama_ibu").text(data.nama_suami);
                    $('#col_nama_ayah').show();
                    $('#col_nama_ibu').show();
                });

                $('#selectjenis_vaksin').select2({
                    theme: 'bootstrap4',
                    placeholder: 'Pilih/Cari Jenis Vaksin',
                    ajax: {
                        url: '{{ route('getJenisVaksin') }}',
                        type: 'POST',
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return {
                                _token: $("meta[name=csrf-token]").attr('content'),
                                id: id,
                                search: params.term
                            };
                        },
                        processResults: function(response) {
                            // return {response};
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
            });

            $('#formTambahImunisasi').submit(function(e) {
                e.preventDefault()
                removeError('TambahImunisasi');

                var formData = new FormData(this);

                $.ajax({
                    type: "POST",
                    url: "{{ route('imunisasi.store') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response == 200) {
                            $("#table_imunisasi").DataTable().ajax.reload(null, false);
                            $('#formTambahImunisasi')[0].reset();
                            $('#selectnama_balita').val('').trigger('change');
                            $('#selectjenis_vaksin').val('').trigger('change');
                            $('#modalTambahImunisasi').modal('toggle');
                            $("#formTambahImunisasi #nama_ayah").text();
                            $("#formTambahImunisasi #nama_ibu").text();
                            $('#col_nama_ayah').hide();
                            $('#col_nama_ibu').hide();
                            toastr.success('Berhasil Menambah Data Imunisasi.');
                        }
                    },
                    error: (response) => {
                        if (response.status == 422) {
                            toastr.error('Gagal Menambah Data Imunisasi');
                            $.each(response.responseJSON.errors, function(index, value) {
                                errorFrom("TambahImunisasi", index, value);
                            });
                        } else {
                            toastr.error(response.responseJSON.message);
                        }
                    }
                });
            });

            // MENGGUNAKAN PLUGIN DATEPICKER
            $("#tahun").datepicker({
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years",
                autoclose: true //to close picker once year is selected
            });

            $(".datepicker").datepicker({
                format: "yyyy-mm-dd",
                autoclose: true
            });

            $("#filter").click(function(e) {
                e.preventDefault();

                let tahun = $("#tahun").val();
                if (tahun != '') {
                    $('#table_imunisasi').DataTable().destroy();
                    load_data_imunisasi(tahun);
                    $("#export").prop("href", "export/imunisasi/" + tahun);
                } else {
                    toastr.error('Tahun Wajib disi.');
                }
            });

            $("#reset").click(function(e) {
                e.preventDefault();
                const d = new Date();

                $("#table_imunisasi").DataTable().destroy();
                load_data_imunisasi();
                $("#export").prop("href", "export/imunisasi/" + d.getFullYear());
            });

            $("#formUbahImunisasi").submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                let id = $("#formUbahImunisasi #inputbalita_id").val();

                $.ajax({
                    type: "POST",
                    url: "imunisasi/" + id,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response == 200) {
                            $("#table_imunisasi").DataTable().ajax.reload(null, false);
                            $("#modalUbahImunisasi").modal('toggle');
                            toastr.success("Berhasil Memperbarui Data Imunisasi");
                        }
                    },
                    error: (response) => {
                        if (response.status == 422) {
                            toastr.error('Gagal Memperbarui Data Imunisasi');
                            $.each(response.responseJSON.errors, function(index, value) {
                                errorFrom("UbahImunisasi", index, value);
                            });
                        } else {
                            toastr.error(response.responseJSON.message);
                        }
                    }
                });
            });


        });

        // METHOD UNTUK MENGAMBIL DATA DAN MENGISIKAN DATA KEDALAM DATATABLE
        function load_data_imunisasi(tahun = '') {
            $('#table_imunisasi').DataTable({
                scrollX: true,
                scrollCollapse: true,
                fixedColumns: {
                    left: 1
                },
                processing: true,
                serverside: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('imunisasi.index') }}',
                    data: {
                        tahun: tahun
                    }
                },
                columns: [{
                        data: 'balita.nama_lengkap',
                        name: 'balita.nama_lengkap',
                        width: '15%'
                    },
                    {
                        data: 'hb0',
                        orderable: false,
                        width: '20%',
                        render: function(data) {
                            return data.replace(/,/g, '');
                        }
                    },
                    {
                        data: 'bcg',
                        orderable: false,
                        width: '20%',
                        render: function(data) {
                            return data.replace(/,/g, '');
                        }
                    },
                    {
                        data: 'p1',
                        orderable: false,
                        width: '20%',
                        render: function(data) {
                            return data.replace(/,/g, '');
                        }
                    },
                    {
                        data: 'dpt1',
                        orderable: false,
                        width: '20%',
                        render: function(data) {
                            return data.replace(/,/g, '');
                        }
                    },
                    {
                        data: 'p2',
                        orderable: false,
                        width: '20%',
                        render: function(data) {
                            return data.replace(/,/g, '');
                        }
                    },
                    {
                        data: 'pcv1',
                        orderable: false,
                        width: '20%',
                        render: function(data) {
                            return data.replace(/,/g, '');
                        }
                    },
                    {
                        data: 'dpt2',
                        orderable: false,
                        width: '20%',
                        render: function(data) {
                            return data.replace(/,/g, '');
                        }
                    },
                    {
                        data: 'p3',
                        orderable: false,
                        width: '20%',
                        render: function(data) {
                            return data.replace(/,/g, '');
                        }
                    },
                    {
                        data: 'pcv2',
                        orderable: false,
                        width: '20%',
                        render: function(data) {
                            return data.replace(/,/g, '');
                        }
                    },
                    {
                        data: 'dpt3',
                        orderable: false,
                        width: '20%',
                        render: function(data) {
                            return data.replace(/,/g, '');
                        }
                    },
                    {
                        data: 'p4',
                        orderable: false,
                        width: '20%',
                        render: function(data) {
                            return data.replace(/,/g, '');
                        }
                    },
                    {
                        data: 'pcv3',
                        orderable: false,
                        width: '20%',
                        render: function(data) {
                            return data.replace(/,/g, '');
                        }
                    },
                    {
                        data: 'ipv',
                        orderable: false,
                        width: '20%',
                        render: function(data) {
                            return data.replace(/,/g, '');
                        }
                    },
                    {
                        data: 'campak',
                        orderable: false,
                        width: '20%',
                        render: function(data) {
                            return data.replace(/,/g, '');
                        }
                    },
                    {
                        data: 'aksi',
                        orderable: false,
                        width: '20%',
                        // visible: "{{ auth()->user()->role }}" === "Kader" ? true : false
                    }
                ]
            });
        }

        // function checkbox(id, form) {
        //     $("#" + form + " #checkbox_" + id).click(function() {
        //         if ($(this).prop("checked") == true) {
        //             $("#" + form + " #" + id).attr('disabled', false);
        //         } else {

        //             $("#" + form + " #" + id).attr('disabled', true);
        //         }
        //     });
        // }

        // METHOD UNTUK MENGAMBIL DATA IMUNISASI BERDASARKAN ID
        function ubahDataImunisasi(id) {
            $.get("imunisasi/" + id + "/edit", function(data, textStatus, jqXHR) {

                $.each(data.imunisasi, function(indexInArray, valueOfElement) {
                    let obj = {
                        "hb0": valueOfElement.hb0.replace(/,/g, ''),
                        "bcg": valueOfElement.bcg.replace(/,/g, ''),
                        "p1": valueOfElement.p1.replace(/,/g, ''),
                        "dpt1": valueOfElement.dpt1.replace(/,/g, ''),
                        "p2": valueOfElement.p2.replace(/,/g, ''),
                        "pcv1": valueOfElement.pcv1.replace(/,/g, ''),
                        "dpt2": valueOfElement.dpt2.replace(/,/g, ''),
                        "p3": valueOfElement.p3.replace(/,/g, ''),
                        "pcv2": valueOfElement.pcv2.replace(/,/g, ''),
                        "dpt3": valueOfElement.dpt3.replace(/,/g, ''),
                        "p4": valueOfElement.p4.replace(/,/g, ''),
                        "pcv3": valueOfElement.pcv3.replace(/,/g, ''),
                        "ipv": valueOfElement.ipv.replace(/,/g, ''),
                        "campak": valueOfElement.campak.replace(/,/g, ''),
                    };
                    checkbox(obj);

                    $("#formUbahImunisasi #inputbalita_id").val(valueOfElement.balita_id);
                    $("#formUbahImunisasi #nama_balita").text(valueOfElement.balita.nama_lengkap);
                    $("#formUbahImunisasi #nama_ayah").text(valueOfElement.balita.ortu_balita.nama_suami);
                    $("#formUbahImunisasi #nama_ibu").text(valueOfElement.balita.ortu_balita.nama_istri);
                    $("#modalUbahImunisasi").modal('toggle');
                });
            });
        }

        function checkbox(obj) {
            $.each(obj, function(indexInArray, valueOfElement) {
                if ($("#formUbahImunisasi #checkbox_" + indexInArray).length && valueOfElement != "") {
                    $("#formUbahImunisasi #checkbox_" + indexInArray).prop('checked', true);
                    $("#formUbahImunisasi #" + indexInArray).val(valueOfElement);
                    $("#formUbahImunisasi #checkbox_" + indexInArray).attr('disabled', true);
                    $("#formUbahImunisasi #" + indexInArray).attr('disabled', true);
                } else {
                    $("#formUbahImunisasi #checkbox_" + indexInArray).prop('checked', false);
                    $("#formUbahImunisasi #" + indexInArray).val('');
                    $("#formUbahImunisasi #checkbox_" + indexInArray).attr('disabled', false);
                    $("#formUbahImunisasi #" + indexInArray).attr('disabled', false);
                }
            });
        }

        // METHOD UNTUK MENGHAPUS DATA BERDASRKAN ID
        function hapusDataImunisasi(id) {
            Swal.fire({
                title: 'Apakah kamu yakin, menghapus data Imunisasi ?',
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
                    $.ajax({
                        type: "POST",
                        url: 'imunisasi/delete/' + id,
                        data: {
                            id: id,
                            _token: $("meta[name=csrf-token]").attr('content')
                        },
                        success: function(response) {
                            if (response == 200) {
                                $("#table_imunisasi").DataTable().ajax.reload(null, false);
                                toastr.success('Berhasil Menghapus Data Imunsasi.');
                            }
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
