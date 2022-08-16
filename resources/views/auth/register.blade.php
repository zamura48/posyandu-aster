@extends('layouts.app', [($activePage = 'Registrasi')])

@section('registrasi')
    <div class="container-fluid">

        <div class="row row-cols-md-2 justify-content-center">
            <div class="card card-outline card-primary mt-2">
                <div class="card-header text-center">
                    <a href="{{ route('login') }}" class="h1"><b>Posyandu</b>Aster</a>
                </div>
                <div class="card-body">
                    <form id="formRegistrasi">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnik">NIK <span class="text-danger">*</span></label>
                                    <input type="text" id="inputnik" name="nik" class="form-control"
                                        placeholder="Contoh: 357xxxxxxxxxxxxx">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnama_ibu">Nama Ibu <span class="text-danger">*</span></label>
                                    <input type="text" id="inputnama_ibu" name="nama_ibu" class="form-control"
                                        placeholder="Contoh: Siti">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputpekerjaan_ibu">Pekerjaan Ibu <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="inputpekerjaan_ibu" name="pekerjaan_ibu" class="form-control"
                                        placeholder="Contoh: PNS">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnomor_telepon">Nomor Telepon <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="inputnomor_telepon" name="nomor_telepon" class="form-control" placeholder="Contoh: 085xxxxxxxxx">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputnama_ayah">Nama Ayah <span class="text-danger">*</span></label>
                                    <input type="text" id="inputnama_ayah" name="nama_ayah" class="form-control"
                                        placeholder="Contoh: Abdul">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputpekerjaan_ayah">Pekerjaan Ayah <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="inputpekerjaan_ayah" name="pekerjaan_ayah"
                                        class="form-control" placeholder="Contoh: Guru">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="inputrt">RT <span class="text-danger">*</span></label>
                                    <input type="text" id="inputrt" name="rt" class="form-control" placeholder="Contoh: 3">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="inputrw">RW <span class="text-danger">*</span></label>
                                    <input type="text" id="inputrw" name="rw" class="form-control" placeholder="Contoh: 9">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="inputalamat">Alamat <span class="text-danger">*</span></label>
                                    <input type="text" id="inputalamat" name="alamat" class="form-control" placeholder="Contoh: Jln. KH. / Gg. Puskesmas">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputusername">Username <span class="text-danger">*</span></label>
                                    <input type="text" id="inputusername" name="username" class="form-control"
                                        placeholder="Username">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputpassword">Password <span class="text-danger">*</span></label>
                                    <input type="password" id="inputpassword" name="password" class="form-control"
                                        placeholder="Password">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputpassword_confirmation">Konfirmasi Password <span
                                            class="text-danger">*</span></label>
                                    <input type="password" id="inputpassword_confirmation" name="password_confirmation"
                                        class="form-control" placeholder="Ulangi Password">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </form>

                    <br><small>Jika sudah punya akun <a href="{{ route('login') }}" class="text-center">klik
                            disini!</a></small>
                </div>
                <!-- /.form-box -->
            </div><!-- /.card -->
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(function() {
            $("#formRegistrasi").submit(function(e) {
                e.preventDefault();
                removeError("Registrasi");
                let formData = new FormData(this);

                $.ajax({
                    type: "POST",
                    url: "register",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response == 200) {
                            window.location.href = "login";
                            toastr.success('Berhasil Melakukan Registrasi.');
                        }
                    },
                    error: (response) => {
                        toastr.error('Gagal Melakukan Registrasi.');
                        $.each(response.responseJSON.errors, function(index, value) {
                            errorFrom("Registrasi", index, value);
                        });
                    }
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
        })
    </script>
@endpush
