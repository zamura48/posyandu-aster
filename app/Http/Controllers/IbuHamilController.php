<?php

namespace App\Http\Controllers;

use App\Exports\IbuHamilExport;
use App\Models\IbuHamil;
use App\Models\Ortu;
use App\Models\RiwayatIbuHamil;
use App\Models\RiwayatIbuKB;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
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
            if (empty($request->dari_tanggal) && empty($request->sampai_tanggal)) {
                $datas = RiwayatIbuHamil::latest()->groupBy('ortu_id')->get()->load('ibu_hamil', 'kader');
            } else {
                $datas = RiwayatIbuHamil::latest()->whereBetween('tanggal_pemeriksaan', ["$request->dari_tanggal", "$request->sampai_tanggal"])
                    ->groupBy('ortu_id')
                    ->get()
                    ->load('ibu_hamil', 'kader');
            }

            return DataTables::of($datas)
                ->addColumn('aksi', function ($model) {
                    $button = '<div class="btn-group"><a href="' . route('ibu_hamil.show', $model->ortu_id) . '" class="btn btn-info btn-sm"><i class="fa fa-list"></i> Detail</a> <a href="' . route('ibu_hamil.edit', $model->ortu_id) . '" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Ubah</a> <button type="button" class="btn btn-danger btn-sm" onclick="hapusDataIbuHamil(' . $model->ortu_id . ')"><i class="fa fa-trash"></i> Hapus</button></div>';

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
            'nik' => ['required', 'min:16', 'max:16'],
            'nama_istri' => ['required', 'string'],
            'tanggal_lahir' => ['required', 'date'],
            'alamat' => ['required', 'string'],
            'pekerjaan_istri' => ['required', 'string'],
            'nomor_telepon' => ['required', 'numeric'],
            'nama_suami' => ['required', 'string'],
            'pekerjaan_suami' => ['required', 'string'],
            'umur_kehamilan' => ['required', 'numeric'],
            'tambah_darah' => ['required', 'string']
        ]);

        $ibu_hamil = Ortu::where('nik', $request->nik)->first();

        if (empty($ibu_hamil)) {
            $request->validate(['nik' => ['unique:ortus']]);
            $ortu_id = Ortu::create([
                'nik' => $request->nik,
                'nama_istri' => $request->nama_istri,
                'nama_suami' => $request->nama_suami,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat' => $request->alamat,
                'pekerjaan_istri' => $request->pekerjaan_istri,
                'nomor_telepon' => $request->nomor_telepon,
                'pekerjaan_suami' => $request->pekerjaan_suami,
                'status' => "Ibu Hamil"
            ]);
        } else {
            if ($ibu_hamil->status == 'Ibu Hamil') {
                return response()->json(['message' => 'Ibu tersebut sudah terdaftar menjadi Ibu Hamil'], 500);
            }
            $ortu_id = Ortu::where('nik', $request->nik)->first();
            $ortu_id->pekerjaan_istri = $request->pekerjaan_istri;
            $ortu_id->nama_suami = $request->nama_suami;
            $ortu_id->pekerjaan_suami = $request->pekerjaan_suami;
            $ortu_id->rt = $request->rt;
            $ortu_id->rw = $request->rw;
            $ortu_id->alamat = $request->alamat;
            $ortu_id->status = "Ibu Hamil";
            $ortu_id->save();
        }

        RiwayatIbuHamil::create([
            'umur_kehamilan' => $request->umur_kehamilan,
            'hasil_pemeriksaan' => $request->hasil_pemeriksaan,
            'pemberian_tablet_tambah_darah' => $request->tambah_darah,
            'kader_id' => auth()->user()->id,
            'ortu_id' => $ortu_id->id,
            'tanggal_pemeriksaan' => Carbon::today()
        ]);

        return response()->json(200);
    }

    public function storeRiwayatIbuHamil(Request $request)
    {
        $request->validate([
            'nik' => ['required', 'min:16', 'max:16'],
            'umur_kehamilan' => ['required', 'numeric'],
            'tambah_darah' => ['required', 'string']
        ]);

        $ortu = Ortu::where('nik', $request->nik)->first()->load('riwayat_ibu_hamil');

        foreach ($ortu->riwayat_ibu_hamil as $riwayat_ibu_hamil) {
            $date = new DateTime($riwayat_ibu_hamil->tanggal_pemeriksaan);
            $yearNow = date('Y');
            if ($date->format('Y') === $yearNow && $riwayat_ibu_hamil->umur_kehamilan == $request->umur_kehamilan) {
                return response()->json(['message' => "Umur kehamilan $request->umur_kehamilan sudah ada"], 500);
            }
        }

        if ($request->umur_kehamilan >= 8 || $request->keterangan == 'Sudah Melahirkan') {
            $ortu->status = 'Ibu Memiliki Anak';
            $ortu->save();
        }

        RiwayatIbuHamil::create([
            'umur_kehamilan' => $request->umur_kehamilan,
            'hasil_pemeriksaan' => $request->hasil_pemeriksaan,
            'pemberian_tablet_tambah_darah' => $request->tambah_darah,
            'kader_id' => auth()->user()->id,
            'ortu_id' => $ortu->id,
            'tanggal_pemeriksaan' => Carbon::today()
        ]);

        return response()->json(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IbuHamil  $ibuHamil
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $ibuHamil)
    {
        $ibu_hamil = Ortu::findOrFail($ibuHamil)->load('riwayat_ibu_hamil');

        if ($request->ajax()) {
            $riwayat_ibu_hamils = RiwayatIbuHamil::where('ortu_id', $ibu_hamil->id)
                ->orderBy('umur_kehamilan', 'asc')
                ->get()
                ->load('kader');
            return DataTables::of($riwayat_ibu_hamils)->toJson();
        }

        $datas = [
            'activePage' => "Ibu Hamil",
            'ibu_hamil' => $ibu_hamil
        ];

        return view('dashboard.page.ibu_hamil.show', $datas);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IbuHamil  $ibuHamil
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $ibuHamil)
    {
        $ibu_hamil = Ortu::findOrFail($ibuHamil);
        if ($request->ajax()) {
            $riwayat_ibu_hamils = RiwayatIbuHamil::where('ortu_id', $ibuHamil)
                ->orderBy('umur_kehamilan', 'asc')
                ->orderBy('created_at', 'asc')->get();
            return DataTables::of($riwayat_ibu_hamils)
                ->addColumn('aksi', function ($model) {
                    $button = '<div class="btn-group"> <button type="button" class="btn btn-warning btn-sm" onclick="ubahDataRiwayatIbuHamil(' . $model->id . ')"><i class="fa fa-edit"></i> Ubah</button> <button type="button" class="btn btn-danger btn-sm" onclick="hapusDataRiwayatIbuHamil(' . $model->id . ')"><i class="fa fa-trash"></i> Hapus</button></div>';
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->toJson();
        }
        $activePage = 'Ibu Hamil';

        return view('dashboard.page.ibu_hamil.edit', compact('activePage', 'ibu_hamil'));
    }

    public function getRiwayatIbuHamil($id)
    {
        $data = RiwayatIbuHamil::findOrFail($id)->load('ibu_hamil');

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
            'nik' => ['required', 'min:16', 'max:16'],
            'nama_istri' => ['required'],
            'tanggal_lahir' => ['required', 'date'],
            'alamat' => ['required'],
            'pekerjaan_istri' => ['required'],
            'nomor_telepon' => ['required', 'numeric'],
            'nama_suami' => ['required'],
            'pekerjaan_suami' => ['required'],
            'umur_kehamilan' => ['required', 'numeric'],
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
        $data->pemberian_tablet_tambah_darah = $request->tambah_darah;
        $data->keterangan = $request->keterangan;
        $data->ibu_hamil->save();
        $data->save();

        return response()->json(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IbuHamil  $ibuHamil
     * @return \Illuminate\Http\Response
     */
    public function destroy($ibuHamil)
    {
        RiwayatIbuHamil::where('ortu_id', $ibuHamil)->delete();
        $ibu_hamil = Ortu::findOrFail($ibuHamil);
        if (empty($ibu_hamil)) {
            $ibu_hamil->status = null;
            $ibu_hamil->save();
        }

        return response()->json(200);
    }

    public function destroyRiwayatIbuHamil($id)
    {
        $data = RiwayatIbuHamil::findOrFail($id);
        $ortu_id = $data->ortu_id;
        $data->delete();
        $ibu_hamil = Ortu::findOrFail($ortu_id)->load('riwayat_ibu_hamil');
        if (empty($ibu_hamil)) {
            $ibu_hamil->status = null;
            $ibu_hamil->save();
        }

        return response()->json(200);
    }

    public function export($dari_tanggal, $sampai_tanggal)
    {
        $year = date('Y');
        return Excel::download(new IbuHamilExport($dari_tanggal, $sampai_tanggal), "Ibu Hamil {$year}.xlsx");
    }
}
