<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Registration Page (v2)</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('vendor/AdminLTE-3.1.0') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet"
        href="{{ asset('vendor/AdminLTE-3.1.0') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('vendor/AdminLTE-3.1.0') }}/dist/css/adminlte.min.css">
</head>

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="card card-outline card-primary mt-2">
            <div class="card-header text-center">
                <a href="{{ asset('vendor/AdminLTE-3.1.0') }}/index2.html"
                    class="h1"><b>Posyandu</b>Aster</a>
            </div>
            <div class="card-body">
                {{-- <p class="login-box-msg">Daftar Akun baru</p> --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('register.create') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputnik">NIK</label>
                                <input type="text" id="inputnik" name="nik" class="form-control"
                                    placeholder="Nomor Induk Kependudukan" value="{{ old('nik') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputnama_ibu">Nama Ibu Balita</label>
                                <input type="text" id="inputnama_ibu" name="nama_ibu" class="form-control"
                                    placeholder="Nama Ibu" value="{{ old('nama_ibu') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputpekerjaan_ibu">Pekerjaan Ibu</label>
                                <input type="text" id="inputpekerjaan_ibu" name="pekerjaan_ibu" class="form-control"
                                    placeholder="Nama Ibu" value="{{ old('pekerjaan_ibu') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputnama_ayah">Nama Ayah Balita</label>
                                <input type="text" id="inputnama_ayah" name="nama_ayah" class="form-control"
                                    placeholder="Nama Ayah" value="{{ old('nama_ayah') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputpekerjaan_ayah">Pekerjaan Ayah</label>
                                <input type="text" id="inputpekerjaan_ayah" name="pekerjaan_ayah"
                                    class="form-control" value="{{ old('pekerjaan_ayah') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputalamat">Alamat</label>
                                <input type="text" id="inputalamat" name="alamat" class="form-control" value="{{ old('alamat') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputnomor_telepon">Nomor Telepon</label>
                                <input type="text" id="inputnomor_telepon" name="nomor_telepon" class="form-control" value="{{ old('nomor_telepon') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputusername">Username</label>
                                <input type="text" id="inputusername" name="username" class="form-control"
                                    placeholder="Username" value="{{ old('username') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputpassword">Password</label>
                                <input type="password" id="inputpassword" name="password" class="form-control"
                                    placeholder="Password">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputkonfirmasi_password">Konfirmasi Password</label>
                                <input type="password" id="inputkonfirmasi_password" name="password_confirmation"
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

    <!-- jQuery -->
    <script src="{{ asset('vendor/AdminLTE-3.1.0') }}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('vendor/AdminLTE-3.1.0') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('vendor/AdminLTE-3.1.0') }}/dist/js/adminlte.min.js"></script>
</body>

</html>
