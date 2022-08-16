@extends('layouts.app', [$activePage])

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Profile</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="card card-outline card-warning">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card-body">
                            <input type="hidden" id="inputid" name="id" class="form-control"
                                value="{{ base64_encode(auth()->user()->id) }}">
                            @can('ibu_balita')
                                @isset($data->ortu)
                                    <form id="formPerbaruiOrtu">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="inputnik">NIK</label>
                                                    <input type="text" id="inputnik" name="nik" class="form-control"
                                                        value="{{ $data->ortu->nik }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6"></div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="inputnama_ibu">Nama Ibu</label>
                                                    <input type="text" id="inputnama_ibu" name="nama_ibu" class="form-control"
                                                        value="{{ $data->ortu->nama_istri }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="inputpekerjaan_ibu">Pekerjaan Ibu</label>
                                                    <input type="text" id="inputpekerjaan_ibu" name="pekerjaan_ibu"
                                                        class="form-control" value="{{ $data->ortu->pekerjaan_istri }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="inputnama_ayah">Nama Ayah</label>
                                                    <input type="text" id="inputnama_ayah" name="nama_ayah" class="form-control"
                                                        value="{{ $data->ortu->nama_suami }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="inputpekerjaan_ayah">Pekerjaan Ayah</label>
                                                    <input type="text" id="inputpekerjaan_ayah" name="pekerjaan_ayah"
                                                        class="form-control" value="{{ $data->ortu->pekerjaan_suami }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="inputalamat">Alamat</label>
                                                    <input type="text" id="inputalamat" name="alamat" class="form-control"
                                                        value="{{ $data->ortu->alamat }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="inputnomor_telepon">Nomor Telepon</label>
                                                    <input type="text" id="inputnomor_telepon" name="nomor_telepon"
                                                        class="form-control" value="{{ $data->ortu->nomor_telepon }}">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit"
                                                    class="btn btn-warning text-white float-right mb-3">Perbarui</button>
                                            </div>
                                        </div>
                                    </form>
                                @endisset
                            @endcan
                            @can('is_KaderAndKetua')
                                @isset($data->kader)
                                    <form id="formPerbaruiKader">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="inputnik">NIK</label>
                                                    <input type="text" id="inputnik" name="nik" class="form-control"
                                                        value="{{ $data->kader->nik }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="inputnama_lengkap">Nama</label>
                                                    <input type="text" id="inputnama_lengkap" name="nama_lengkap"
                                                        class="form-control" value="{{ $data->kader->nama_istri }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="inputtanggal_lahir">Tanggal Lahir</label>
                                                    <input type="date" id="inputtanggal_lahir" name="tanggal_lahir"
                                                        class="form-control" value="{{ $data->kader->tanggal_lahir }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="inputalamat">Alamat</label>
                                                    <input type="text" id="inputalamat" name="alamat" class="form-control"
                                                        value="{{ $data->kader->alamat }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="inputnomor_telepon">Nomor Telepon</label>
                                                    <input type="text" id="inputnomor_telepon" name="nomor_telepon"
                                                        class="form-control" value="{{ $data->kader->nomor_telepon }}">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit"
                                                    class="btn btn-warning text-white float-right mb-3">Perbarui</button>
                                            </div>
                                        </div>
                                    </form>
                                @endisset
                            @endcan
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="col-md-4">
                        <div class="card-body">
                            <h4>Ganti Password</h4>
                            <hr>
                            <form id="formGantiPassword">
                                @csrf
                                <div class="form-group">
                                    <label for="inputpassword">Password</label>
                                    <input type="password" id="inputpassword" name="password" class="form-control"
                                        placeholder="Masukkan Password">
                                </div>
                                <div class="form-group">
                                    <label for="inputpassword_confirmation">Konfirmasi Password</label>
                                    <input type="password" id="inputpassword_confirmation" name="password_confirmation"
                                        class="form-control" placeholder="Ulangi Password">
                                </div>
                                <button type="submit" class="btn btn-warning text-white float-right mb-3">Ganti
                                    Password</button>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection

@push('js')
    <script>
        $(function() {
            $("#formGantiPassword").submit(function(e) {
                e.preventDefault();
                removeError("GantiPassword");
                var formData = new FormData(this);
                let this_id = $("#inputid").val();

                $.ajax({
                    type: "POST",
                    url: "ganti_password/" + this_id,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response == 200) {
                            $("#inputpassword").val('');
                            $("#inputpassword_confirmation").val('');
                            toastr.success('Berhasil Mengubah Password.');
                        }
                    },
                    error: (response) => {
                        toastr.error('Gagal Mengubah Password.');
                        $.each(response.responseJSON.errors, function(index, value) {
                            errorFrom("GantiPassword", index, value);
                        });
                    }
                });
            });

            $("#formPerbaruiKader").submit(function(e) {
                e.preventDefault();
                removeError("PerbaruiKader");
                let formData = new FormData(this);
                const id = $("#inputid").val();

                $.ajax({
                    type: "POST",
                    url: "update/" + id,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response == 200) {
                            toastr.success("Berhasil Memperbarui Profile");
                        }
                    },
                    error: (response) => {
                        toastr.error("Gagal Memperbarui Profile");
                        $.each(response.responseJSON.errors, function(index, value) {
                            errorFrom("PerbaruiKader", index, value);
                        });
                    }
                });
            });
        });

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
