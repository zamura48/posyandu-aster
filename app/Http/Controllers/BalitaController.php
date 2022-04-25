<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use App\Models\IbuBalita;
use App\Models\Imunisasi;
use App\Models\Penimbangan;
use App\Models\TimbangdanVitamin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Validator;

class BalitaController extends Controller
{
    public $data;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(Balita::all()->load('ibuBalita'))
                ->addColumn('umur', function ($model) {
                    $hitung_umur = Carbon::parse($model->tanggal_lahir)->diff(Carbon::now());
                    return $hitung_umur->format('%y Tahun') == "0 Tahun" ? $hitung_umur->format('%m Bulan') : $hitung_umur->format('%y Tahun');
                })
                ->addColumn('aksi', function ($model) {
                    $button = '<a href="balita/' . encrypt($model->id) . '" type="button" class="btn btn-info btn-sm"><i class="fa fa-list"></i> Detail</a> <button type="button" class="btn btn-warning btn-sm" onclick="ubahDataBalita(' . $model->id . ')"><i class="fa fa-edit"></i> Ubah</button> <button type="button" class="btn btn-danger btn-sm" onclick="hapusDataBalita(' . $model->id . ')"><i class="fa fa-trash"></i> Hapus</button>';
                    return $button;
                })
                ->rawColumns(['umur', 'aksi'])
                ->with(['test' => 200])
                ->toJson();
        }

        return view('dashboard.page.balita.index', ['activePage' => 'Balita']);
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
            'nik' => ['required', 'min:16', 'max:16', 'unique:balitas'],
            'nama_lengkap' => ['required'],
            'tanggal_lahir' => ['required'],
            'jenis_kelamin' => ['required'],
            'nama_ayah' => ['required'],
            'nama_ibu' => ['required'],
            'nomor_telepon' => ['required', 'numeric'],
        ]);

        $ortu = IbuBalita::where('nama_ayah', $request->nama_ayah)
            ->where('nama_ibu', $request->nama_ibu)
            ->first();

        if (is_null($ortu)) {
            $ibu_balita_id = IbuBalita::create([
                'nama_ayah' => $request->nama_ayah,
                'nama_ibu' => $request->nama_ibu,
                'nomor_telepon' => $request->nomor_telepon,
                'user_id' => 0
            ]);
        } else {
            $ibu_balita_id = IbuBalita::where('nama_ayah', $request->nama_ayah)
                ->where('nama_ibu', $request->nama_ibu)
                ->value('id');
        }

        $balita = Balita::create([
            'nik' => $request->nik,
            'nama_lengkap' => $request->nama_lengkap,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'bbl' => $request->bbl,
            'pb' => $request->pb,
            'ibu_balita_id' => $ibu_balita_id
        ]);

        $hitung_umur = Carbon::parse($request->tanggal_lahir)->diff(Carbon::now());

        if ($hitung_umur->format('%y Tahun') == "0 Tahun" || $hitung_umur->format('%y Tahun') == "1 Tahun") {
            Imunisasi::create([
                'balita_id' => $balita->id
            ]);
        }

        return response()->json(['status' => 200, 'id' => encrypt($balita->id), 'nama_balita' => $request->nama_lengkap]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Balita  $balita
     * @return \Illuminate\Http\Response
     */
    public function show($balita)
    {
        $data = Balita::findOrFail(decrypt($balita))->load('ibuBalita', 'imunisasi');
        $imunisasi = Imunisasi::where('balita_id', decrypt($balita))->get();
        $penimbangan = Penimbangan::where('balita_id', decrypt($balita))->get();
        $timbangan_dan_vitamin = TimbangdanVitamin::where('balita_id', decrypt($balita))->get();

        $datas = [
            'data' => $data,
            'activePage' => 'Detail Balita - ' . $data->nama_lengkap,
            'imunisasis' => $imunisasi,
            'penimbangans' => $penimbangan,
            'timbangan_dan_vitamins' => $timbangan_dan_vitamin
        ];

        return view('dashboard.page.balita.show', $datas);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Balita  $balita
     * @return \Illuminate\Http\Response
     */
    public function edit($balita)
    {
        $this->data = Balita::findOrFail($balita)->load('ibubalita');

        return response()->json($this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Balita  $balita
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Balita $balita)
    {
        $request->validate([
            'nik' => ['required', 'min:16', 'max:16', 'unique:balitas'],
            'nama_lengkap' => ['required'],
            'tanggal_lahir' => ['required'],
            'jenis_kelamin' => ['required'],
            'nama_ayah' => ['required'],
            'nama_ibu' => ['required'],
            'nomor_telepon' => ['required', 'numeric'],
        ]);

        $balita->nik = $request->nik;
        $balita->nama_lengkap = $request->nama_lengkap;
        $balita->tanggal_lahir = $request->tanggal_lahir;
        $balita->jenis_kelamin = $request->jenis_kelamin;
        $balita->bbl = $request->bbl;
        $balita->pb = $request->pb;
        $balita->ibubalita->nama_ayah = $request->nama_ayah;
        $balita->ibubalita->nama_ibu = $request->nama_ibu;
        $balita->ibubalita->nomor_telepon = $request->nomor_telepon;
        $balita->save();

        return response()->json(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Balita  $balita
     * @return \Illuminate\Http\Response
     */
    public function destroy(Balita $balita)
    {
        $balita->delete();

        return response()->json(200);
    }

    public function getBalita(Request $request)
    {
        if ($request->ajax()) {
            $ibu_balita = IbuBalita::where('user_id', auth()->user()->id)->first();
            $balita = Balita::where('ibu_balita_id', $ibu_balita->id)->get();
            return $balita->toJson();
        }

        return view('dashboard.page.ortu.index', ['activePage' => 'Balita']);
    }
}
