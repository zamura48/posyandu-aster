<?php

namespace App\Http\Controllers;

use App\Models\Kader;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;
use Validator;

class KaderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd(auth()->user()->id);
        $data = Kader::all()->load('user');

        if ($request->ajax()) {
            return DataTables::of($data)
                ->addColumn('aksi', function ($model) {
                    $button = '<button type="button" class="btn btn-primary btn-sm" onclick="detailDataKader(' . $model->id . ')"><i class="fa fa-list"></i> Detail</button> <button type="button" class="btn btn-warning btn-sm" onclick="ubahDataKader(' . $model->id . ')"><i class="fa fa-edit"></i> Ubah</button> <button type="button" class="btn btn-danger btn-sm" onclick="hapusDataKader(' . $model->id . ')"><i class="fa fa-trash"></i> Hapus</button>';
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->toJson();
        }

        return view('dashboard.page.kader.index', ['activePage' => 'Kader']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nik' => ['required', 'unique:kaders', 'min:16', 'max:16'],
            'nama_lengkap' => ['required'],
            'tanggal_lahir' => ['required'],
            'alamat' => ['required'],
            'nomor_telepon' => ['required', 'numeric'],
            'role' => ['required']
        ]);

        $get_first_name = str_word_count($request->nama_lengkap, 2);
        $username = strtolower($get_first_name[0]) . random_int(10, 100);

        $user = User::create([
            'username' => $username,
            'role' => $request->role,
            'password' => Hash::make($request->nomor_telepon),
            'status' => '1'
        ]);

        Kader::create([
            'nik' => $request->nik,
            'nama_lengkap' => $request->nama_lengkap,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'nomor_telepon' => $request->nomor_telepon,
            'user_id' => $user->id
        ]);

        return response()->json(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kader  $kader
     * @return \Illuminate\Http\Response
     */
    public function show($kader)
    {
        $data = Kader::findOrFail($kader)->load('user');

        // return json
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kader  $kader
     * @return \Illuminate\Http\Response
     */
    public function edit($kader)
    {
        $data = Kader::findOrFail($kader)->load('user');

        return response()->json(base64_encode(json_encode($data)));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kader  $kader
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $kader)
    {
        $data = Kader::findOrFail(base64_decode($kader));
        $data->nama_lengkap = $request->nama_lengkap;
        $data->tanggal_lahir = $request->tanggal_lahir;
        $data->alamat = $request->alamat;
        $data->nomor_telepon = $request->nomor_telepon;
        $data->save();

        $user = User::findOrFail($data->user_id)->update(['role'=>$request->role]);

        return response()->json(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kader  $kader
     * @return \Illuminate\Http\Response
     */
    public function destroy($kader)
    {
        Kader::findOrFail($kader)->delete();

        return response()->json(200);
    }
}
