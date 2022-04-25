{{-- @php
    dd(auth()->user()->kader());
@endphp --}}
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
                            @isset($data->ibu_balita)
                                <form action="">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputnik">NIK</label>
                                                <input type="text" id="inputnik" name="nik" class="form-control"
                                                    value="{{ $data->ibu_balita->nik }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6"></div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputnama_ibu">Nama Ibu</label>
                                                <input type="text" id="inputnama_ibu" name="nama_ibu" class="form-control"
                                                    value="{{ $data->ibu_balita->nama_ibu }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputpekerjaan_ibu">Pekerjaan Ibu</label>
                                                <input type="text" id="inputpekerjaan_ibu" name="pekerjaan_ibu"
                                                    class="form-control" value="{{ $data->ibu_balita->pekerjaan_ibu }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputnama_ayah">Nama Ayah</label>
                                                <input type="text" id="inputnama_ayah" name="nama_ayah" class="form-control"
                                                    value="{{ $data->ibu_balita->nama_ayah }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputpekerjaan_ayah">Pekerjaan Ayah</label>
                                                <input type="text" id="inputpekerjaan_ayah" name="pekerjaan_ayah"
                                                    class="form-control" value="{{ $data->ibu_balita->pekerjaan_ayah }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputalamat">Alamat</label>
                                                <input type="text" id="inputalamat" name="alamat" class="form-control"
                                                    value="{{ $data->ibu_balita->alamat }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="inputnomor_telepon">Nomor Telepon</label>
                                                <input type="text" id="inputnomor_telepon" name="nomor_telepon"
                                                    class="form-control" value="{{ $data->ibu_balita->nomor_telepon }}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="submit"
                                                class="btn btn-warning text-white float-right mb-3">Perbarui</button>
                                        </div>
                                    </div>
                                </form>
                            @endisset
                            @isset($data->kader)
                                <form action="">
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
                                                    class="form-control" value="{{ $data->kader->nama_lengkap }}">
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
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="col-md-4">
                        <div class="card-body">
                            <h4>Ganti Password</h4>
                            <hr>
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
                            <form action="{{ auth()->user()->id }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="inputpassword">Password</label>
                                    <input type="password" id="inputpassword" name="password" class="form-control">
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
