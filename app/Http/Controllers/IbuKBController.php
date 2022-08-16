<?php

namespace App\Http\Controllers;

use App\Models\IbuKB;
use App\Models\Ortu;
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
            $datas = RiwayatIbuKB::all()->load('ibu_kb');
            return DataTables::of($datas)
                ->addColumn('aksi', function ($model) {
                    return '<div class="btn-group"><a href="' . route('ibu_kb.show', $model->ibu_kb->id)  . '" class="btn btn-info btn-sm" onclick="detailDataIbuKB(' . $model->id . ')"><i class="fa fa-list"></i> Detail</a> <button type="button" class="btn btn-warning btn-sm" onclick="ubahDataIbuKB(' . $model->id . ')"><i class="fa fa-edit"></i> Ubah</button> <button type="button" class="btn btn-danger btn-sm" onclick="hapusDataIbuKB(' . $model->id . ')"><i class="fa fa-trash"></i> Hapus</button></div>';
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
            'nik' => ['required', 'min:16', 'max:16'],
            'nama_istri' => ['required', 'string'],
            'tanggal_lahir' => ['required', 'date'],
            'alamat' => ['required', 'string'],
            'pekerjaan_istri' => ['required', 'string'],
            'nomor_telepon' => ['required', 'numeric'],
            'nama_suami' => ['required', 'string'],
            'pekerjaan_suami' => ['required', 'string'],
            'riwayat_kb' => ['required', 'numeric'],
            'suntik_awal' => ['required', 'date'],
            // 'suntik_akhir' => ['required', 'date'],
            'hasil_pemeriksaan' => ['required', 'string'],
        ]);

        $ortu = Ortu::where('nama_suami', $request->nama_suami)
            ->where('nama_istri', $request->nama_istri)
            ->orWhere('nik', $request->nik)
            ->first();

        if (empty($ortu)) {
            $request->validate(['nik' => ['unique:ortus']]);
            $ortu_id = Ortu::create([
                'nik' => $request->nik,
                'nama_istri' => $request->nama_istri,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat' => $request->alamat,
                'pekerjaan_istri' => $request->pekerjaan_istri,
                'nomor_telepon' => $request->nomor_telepon,
                'nama_suami' => $request->nama_suami,
                'pekerjaan_suami' => $request->pekerjaan_suami,
                'jumlah_anak' => $request->jumlah_anak,
                'status' => "Ibu KB"
            ]);
        } elseif (is_null($ortu->nik)) {
            $ortu_id = Ortu::findOrFail($ortu->id)->update([
                'nik' => $request->nik,
                // 'nama_istri' => $request->nama_istri,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat' => $request->alamat,
                'pekerjaan_istri' => $request->pekerjaan_istri,
                'nomor_telepon' => $request->nomor_telepon,
                // 'nama_suami' => $request->nama_suami,
                'pekerjaan_suami' => $request->pekerjaan_suami,
                'jumlah_anak' => $request->jumlah_anak,
                'status' => "Ibu KB"
            ]);
        } else {
            Ortu::where('nik', $request->nik)->update(['status' => "Ibu KB"]);
            $ortu_id = Ortu::where('nik', $request->nik)->first();
        }

        RiwayatIbuKB::create([
            'riwayat_kb' => $request->riwayat_kb,
            'suntik_awal' => $request->suntik_awal,
            'suntik_akhir' => $request->suntik_akhir,
            'hasil_pemeriksaan' => $request->hasil_pemeriksaan,
            'kader_id' => auth()->user()->id,
            'ortu_id' => $ortu_id->id
        ]);

        return response()->json(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IbuKB  $ibuKB
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $ibuKB)
    {
        $ibu_kb = Ortu::findOrFail($ibuKB)->load('riwayat_ibu_kb');

        if ($request->ajax()) {
            $riwayat_ibu_kb = RiwayatIbuKB::where('ortu_id', $ibuKB)
                ->orderBy('suntik_awal', 'asc')
                ->get()
                ->load('kader');
            return DataTables::of($riwayat_ibu_kb)->toJson();
        }

        $datas = [
            'activePage' => "Ibu KB",
            'ibu_kb' => $ibu_kb
        ];

        return view('dashboard.page.ibu_kb.show', $datas);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IbuKB  $ibuKB
     * @return \Illuminate\Http\Response
     */
    public function edit($ibuKB)
    {
        $datas = RiwayatIbuKB::findOrFail($ibuKB)->load('ibu_kb');

        return response()->json(base64_encode(json_encode($datas)));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IbuKB  $ibuKB
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $ibuKB)
    {
        $request->validate([
            'nik' => ['required', 'min:16', 'max:16'],
            'nama_istri' => ['required', 'string'],
            'tanggal_lahir' => ['required', 'date'],
            'alamat' => ['required', 'string'],
            'pekerjaan_istri' => ['required', 'string'],
            'nomor_telepon' => ['required', 'numeric'],
            'nama_suami' => ['required', 'string'],
            'pekerjaan_suami' => ['required', 'string'],
            'riwayat_kb' => ['required', 'numeric'],
            'suntik_awal' => ['required', 'date'],
            // 'suntik_akhir' => ['date'],
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
        if (!is_null($request->suntik_akhir)) {
            $data->ibu_kb->status = null;
        }
        $data->ibu_kb->save();
        $data->save();

        return response()->json(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IbuKB  $ibuKB
     * @return \Illuminate\Http\Response
     */
    public function destroy($ibuKB)
    {
        RiwayatIbuKB::findOrFail($ibuKB)->delete();

        return response()->json(200);
    }

    public function export($dari_tanggal, $sampai_tanggal)
    {
        return redirect()->back();
    }
}
