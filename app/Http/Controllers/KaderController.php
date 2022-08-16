<?php

namespace App\Http\Controllers;

use App\Models\Kader;
use App\Models\Ortu;
use App\Models\RiwayatIbuHamil;
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
        if ($request->ajax()) {
            $data = Ortu::join('users', 'ortus.user_id', '=', 'users.id')
            ->select('ortus.*')
            ->where('users.role', 'Kader')
            ->orWhere('users.role', 'Ketua')
            ->get()->load('user');

            return DataTables::of($data)
                ->addColumn('aksi', function ($model) {
                    $button = '<div class="btn-group"><a href="' . route('kader.show',$model->id) . '" type="button" class="btn btn-info btn-sm"><i class="fa fa-list"></i> Detail</a> <button type="button" class="btn btn-warning btn-sm" onclick="ubahDataKader(' . $model->id . ')"><i class="fa fa-edit"></i> Ubah</button> <button type="button" class="btn btn-danger btn-sm" onclick="hapusDataKader(' . $model->id . ')"><i class="fa fa-trash"></i> Hapus</button></div>';
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
            'nama_lengkap' => ['required', 'string'],
            'tanggal_lahir' => ['required', 'date'],
            'alamat' => ['required', 'string'],
            'nomor_telepon' => ['required', 'numeric'],
            'role' => ['required', 'string']
        ]);

        $get_first_name = str_word_count($request->nama_lengkap, 2);
        $username = strtolower($get_first_name[0]) . random_int(10, 100);

        $user = User::create([
            'username' => $username,
            'name' => $request->nama_lengkap,
            'role' => $request->role,
            'password' => Hash::make($request->nomor_telepon),
            'status' => '1'
        ]);

        Ortu::create([
            'nik' => $request->nik,
            'nama_istri' => $request->nama_lengkap,
            'pekerjaan_istri' => 'Kader',
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'rt' => $request->rt,
            'rw' => $request->rw,
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
        $data = Ortu::findOrFail($kader)->load('user');
        $ibu_hamils = RiwayatIbuHamil::where('kader_id', $data->id)->groupBy('ortu_id')->get()->load('ibu_hamil');

        $datas = [
            'activePage' => "Detail Kader - $data->nama_istri",
            'data' => $data,
            'ibu_hamils' => $ibu_hamils
        ];

        return view('dashboard.page.kader.show', $datas);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kader  $kader
     * @return \Illuminate\Http\Response
     */
    public function edit($kader)
    {
        $data = Ortu::findOrFail($kader)->load('user');

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
        $request->validate([
            'nik' => ['required', 'min:16', 'max:16'],
            'nama_lengkap' => ['required', 'string'],
            'tanggal_lahir' => ['required', 'date'],
            'alamat' => ['required', 'string'],
            'rw' => ['required', 'numeric'],
            'rt' => ['required', 'numeric'],
            'nomor_telepon' => ['required', 'numeric'],
            'role' => ['required', 'string']
        ]);

        $data = Ortu::findOrFail(base64_decode($kader));
        $data->nik = $request->nik;
        $data->nama_istri = $request->nama_lengkap;
        $data->tanggal_lahir = $request->tanggal_lahir;
        $data->alamat = $request->alamat;
        $data->rt = $request->rt;
        $data->rw = $request->rw;
        $data->nomor_telepon = $request->nomor_telepon;
        $data->user->role = $request->role;
        $data->user->name = $request->name;
        $data->user->save();
        $data->save();

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
        $kader = Ortu::findOrFail($kader)->load('user');
        $kader->user->delete();
        $kader->delete();

        return response()->json(200);
    }
}
