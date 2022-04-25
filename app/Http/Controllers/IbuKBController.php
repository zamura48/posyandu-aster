<?php

namespace App\Http\Controllers;

use App\Models\IbuKB;
use App\Models\RiwayatIbuKB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class IbuKBController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(IbuKB::all()->load('riwayat_ibu_kb'))
                ->addColumn('aksi', function ($model) {
                    return '<button type="button" class="btn btn-info btn-sm" onclick="detailDataIbuKB(' . $model->id . ')"><i class="fa fa-list"></i> Detail</button> <button type="button" class="btn btn-warning btn-sm" onclick="ubahDataIbuKB(' . $model->id . ')"><i class="fa fa-edit"></i> Ubah</button> <button type="button" class="btn btn-danger btn-sm" onclick="hapusDataIbuKB(' . $model->id . ')"><i class="fa fa-trash"></i> Hapus</button>';
                })
                ->rawColumns(['aksi'])
                ->toJson();
        }

        return view('dashboard.page.ibu_kb.index', ['activePage' => 'Ibu KB']);
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
            'nik' => ['required', 'min:16', 'max:16', 'unique:ibu_kb_s'],
            'nama_istri' => ['required'],
            'tanggal_lahir' => ['required', 'date'],
            'alamat' => ['required'],
            'pekerjaan_istri' => ['required'],
            'nomor_telepon' => ['required', 'numeric'],
            'nama_suami' => ['required'],
            'pekerjaan_suami' => ['required'],
            'riwayat_kb' => ['required', 'numeric'],
            'suntik_awal' => ['required', 'date'],
            'suntik_akhir' => ['required', 'date'],
            'hasil_pemeriksaan' => ['required'],
        ]);

        $ibu_kb = IbuKB::create([
            'nik' => $request->nik,
            'nama_istri' => $request->nama_istri,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'pekerjaan_istri' => $request->pekerjaan_istri,
            'nomor_telepon' => $request->nomor_telepon,
            'nama_suami' => $request->nama_suami,
            'pekerjaan_suami' => $request->pekerjaan_suami,
            'jumlah_anak' => $request->jumlah_anak
        ]);

        RiwayatIbuKB::create([
            'riwayat_kb' => $request->riwayat_kb,
            'suntik_awal' => $request->suntik_awal,
            'suntik_akhir' => $request->suntik_akhir,
            'hasil_pemeriksaan' => $request->hasil_pemeriksaan,
            'kader_id' => auth()->user()->id,
            'ibu_k_b_id' => $ibu_kb->id
        ]);

        return response()->json(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IbuKB  $ibuKB
     * @return \Illuminate\Http\Response
     */
    public function show(IbuKB $ibuKB)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IbuKB  $ibuKB
     * @return \Illuminate\Http\Response
     */
    public function edit($ibuKB)
    {
        $data = IbuHamil::findOrFail($ibuKB)->load('riwayat_ibu_hamil');

        return response()->json(base64_encode(json_encode($data)));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IbuKB  $ibuKB
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IbuKB $ibuKB)
    {
        $request->validate([
            'nik' => ['required', 'min:16', 'max:16', 'unique:ibu_kb_s'],
            'nama_istri' => ['required'],
            'tanggal_lahir' => ['required', 'date'],
            'alamat' => ['required'],
            'pekerjaan_istri' => ['required'],
            'nomor_telepon' => ['required', 'numeric'],
            'nama_suami' => ['required'],
            'pekerjaan_suami' => ['required'],
            'riwayat_kb' => ['required', 'numeric'],
            'suntik_awal' => ['required', 'date'],
            'suntik_akhir' => ['required', 'date'],
            'hasil_pemeriksaan' => ['required'],
        ]);

        $data = RiwayatIbuKB::findOrFail($ibuKB);
        $data->ibu_kb->nik = $request->nik;
        $data->ibu_kb->nama_istri = $request->nama_istri;
        $data->ibu_kb->tanggal_lahir = $request->tanggal_lahir;
        $data->ibu_kb->alamat = $request->alamat;
        $data->ibu_kb->pekerjaan_istri = $request->pekerjaan_istri;
        $data->ibu_kb->nomor_telepon = $request->nomor_telepon;
        $data->ibu_kb->nama_suami = $request->nama_suami;
        $data->ibu_kb->pekerjaan_suami = $request->pekerjaan_suami;
        $data->ibu_kb->jumlah_anak = $request->jumlah_anak;
        $data->riwayat_kb = $request->riwayat_kb;
        $data->suntik_awal = $request->suntik_awal;
        $data->suntik_akhir = $request->suntik_akhir;
        $data->hasil_pemeriksaan = $request->hasil_pemeriksaan;
        $data->save();

        return response()->json(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IbuKB  $ibuKB
     * @return \Illuminate\Http\Response
     */
    public function destroy(RiwayatIbuKB $ibuKB)
    {
        $ibuKB->delete();

        return response()->json(200);
    }
}
