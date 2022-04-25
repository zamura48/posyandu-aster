<?php

namespace App\Http\Controllers;

use App\Models\IbuHamil;
use App\Models\RiwayatIbuHamil;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class IbuHamilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(IbuHamil::all()->load('riwayat_ibu_hamil'))
                ->addColumn('aksi', function ($model) {
                    $button = '<button type="button" class="btn btn-info btn-sm" onclick="detailDataIbuHamil(' . $model->id . ')"><i class="fa fa-list"></i> Detail</button> <button type="button" class="btn btn-warning btn-sm" onclick="ubahDataIbuHamil(' . $model->id . ')"><i class="fa fa-edit"></i> Ubah</button> <button type="button" class="btn btn-danger btn-sm" onclick="hapusDataIbuHamil(' . $model->id . ')"><i class="fa fa-trash"></i> Hapus</button>';
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->toJson();
        }

        return view('dashboard.page.ibu_hamil.index', ['activePage' => 'Ibu Hamil']);
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
            'nik' => ['required', 'min:16', 'max:16', 'unique:ibu_hamils'],
            'nama_istri' => ['required'],
            'tanggal_lahir' => ['required', 'date'],
            'alamat' => ['required'],
            'pekerjaan_istri' => ['required'],
            'nomor_telepon' => ['required', 'numeric'],
            'nama_suami' => ['required'],
            'pekerjaan_suami' => ['required'],
            'umur_kehamilan' => ['required', 'numeric'],
            'hasil_pemeriksaan' => ['required'],
        ]);

        $ibu_hamil = IbuHamil::create([
            'nik' => $request->nik,
            'nama_istri' => $request->nama_istri,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'pekerjaan_istri' => $request->pekerjaan_istri,
            'nomor_telepon' => $request->nomor_telepon,
            'nama_suami' => $request->nama_suami,
            'pekerjaan_suami' => $request->pekerjaan_suami
        ]);

        RiwayatIbuHamil::create([
            'umur_kehamilan' => $request->umur_kehamilan,
            'hasil_pemeriksaan' => $request->hasil_pemeriksaan,
            'kader_id' => auth()->user()->id,
            'ibu_hamil_id' => $ibu_hamil->id
        ]);

        return response()->json(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IbuHamil  $ibuHamil
     * @return \Illuminate\Http\Response
     */
    public function show(IbuHamil $ibuHamil)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IbuHamil  $ibuHamil
     * @return \Illuminate\Http\Response
     */
    public function edit($ibuHamil)
    {
        $data = IbuHamil::findOrFail($ibuHamil)->load('riwayat_ibu_hamil');

        return response()->json(base64_encode(json_encode($data)));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IbuHamil  $ibuHamil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $ibuHamil)
    {
        $request->validate([
            'nik' => ['required', 'min:16', 'max:16', 'unique:ibu_hamils'],
            'nama_istri' => ['required'],
            'tanggal_lahir' => ['required', 'date'],
            'alamat' => ['required'],
            'pekerjaan_istri' => ['required'],
            'nomor_telepon' => ['required', 'numeric'],
            'nama_suami' => ['required'],
            'pekerjaan_suami' => ['required'],
            'umur_kehamilan' => ['required', 'numeric'],
            'hasil_pemeriksaan' => ['required'],
        ]);

        $data = RiwayatIbuHamil::findOrFail($ibuHamil);
        $data->ibu_hamil->nik = $request->nik;
        $data->ibu_hamil->nama_istri = $request->nama_istri;
        $data->ibu_hamil->tanggal_lahir = $request->tanggal_lahir;
        $data->ibu_hamil->alamat = $request->alamat;
        $data->ibu_hamil->pekerjaan_istri = $request->pekerjaan_istri;
        $data->ibu_hamil->nomor_telepon = $request->nomor_telepon;
        $data->ibu_hamil->nama_suami = $request->nama_suami;
        $data->ibu_hamil->pekerjaan_suami = $request->pekerjaan_suami;
        $data->umur_kehamilan = $request->umur_kehamilan;
        $data->hasil_pemeriksaan = $request->hasil_pemeriksaan;
        $data->save();

        return response()->json(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IbuHamil  $ibuHamil
     * @return \Illuminate\Http\Response
     */
    public function destroy(IbuHamil $ibuHamil)
    {
        $ibuHamil->riwayat_ibu_hamil->delete();
        $ibuHamil->delete();

        return response()->json(200);
    }
}
