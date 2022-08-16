<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use App\Models\IbuBalita;
use App\Models\Imunisasi;
use App\Models\JadwalKegiatan;
use App\Models\Ortu;
use App\Models\PenerimaJadwal;
use App\Models\Penimbangan;
use App\Models\PenimbanganDanVitamin;
use App\Models\PraUpdateBalita;
use App\Models\TimbangdanVitamin;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Validator;

class BalitaController extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = new User();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $rtrw = $this->model->getRtRw();
            $balita = Balita::with('ortu_balita')
                ->join('ortus', 'ortus.id', 'balitas.ortu_id')
                ->select('balitas.*')
                ->where('ortus.rt', $rtrw['rt'])
                ->where('ortus.rw', $rtrw['rw'])
                ->get();

            return DataTables::of($balita)
                ->addColumn('umur', function ($model) {
                    $hitung_umur = Carbon::parse($model->tanggal_lahir)->diff(Carbon::now());
                    return $hitung_umur->format('%y Tahun') == "0 Tahun" ? $hitung_umur->format('%m Bulan') : $hitung_umur->format('%y Tahun');
                })
                ->addColumn('aksi', function ($model) {
                    $button = '<div class="btn-group"><a href="balita/' . base64_encode($model->id) . '" type="button" class="btn btn-info btn-sm"><i class="fa fa-list"></i> Detail</a> <button type="button" class="btn btn-warning btn-sm" onclick="ubahDataBalita(' . $model->id . ')"><i class="fa fa-edit"></i> Ubah</button> <button type="button" class="btn btn-danger btn-sm" onclick="hapusDataBalita(' . $model->id . ')"><i class="fa fa-trash"></i> Hapus</button></div>';
                    return $button;
                })
                ->rawColumns(['umur', 'aksi'])
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
            'nama_lengkap' => ['required', 'string'],
            'tanggal_lahir' => ['required', 'date'],
            'jenis_kelamin' => ['required', 'string'],
            'proses_lahiran' => ['required', 'string'],
            'nama_ayah' => ['required', 'string'],
            'nama_ibu' => ['required', 'string'],
            'nomor_telepon' => ['required', 'numeric'],
            'rt' => ['required', 'numeric'],
            'rw' => ['required', 'numeric'],
        ]);

        $ortu = Ortu::where('nama_suami', $request->nama_ayah)
            ->where('nama_istri', $request->nama_ibu)
            ->where('nik', $request->nik_istri)
            ->first();

        if (is_null($ortu)) {
            $request->validate(['nik_istri' => ['required', 'min:16', 'max:16', 'unique:ortus,nik']]);
            $ortu_id = Ortu::create([
                'nik' => $request->nik_istri,
                'nama_suami' => $request->nama_ayah,
                'nama_istri' => $request->nama_ibu,
                'nomor_telepon' => $request->nomor_telepon,
                'rt' => $request->rt,
                'rw' => $request->rw
            ]);
        } else {
            $ortu_id = Ortu::updateOrCreate(
                ['nik' => $request->nik_istri, 'nama_suami' => $request->nama_ayah, 'nama_istri' => $request->nama_ibu],
                [
                    'nomor_telepon' => $request->nomor_telepon,
                    'rt' => $request->rt,
                    'rw' => $request->rw,
                ]
            );
        }

        $balita = Balita::create([
            'nik' => $request->nik,
            'nama_lengkap' => $request->nama_lengkap,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'bbl' => $request->bbl,
            'pb' => $request->pb,
            'tempat_lahiran' => $request->tempat_lahiran,
            'proses_lahiran' => $request->proses_lahiran,
            'ortu_id' => $ortu_id->id
        ]);



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
        $imunisasi = new Imunisasi();
        $penimbangan = new PenimbanganDanVitamin();
        $data = Balita::findOrFail(base64_decode($balita))->load('ortu_balita', 'imunisasi');
        $imunisasi = $imunisasi->getDataImunisasi()->where('balita_id', base64_decode($balita))->get();
        $penimbangan = $penimbangan->getDataPenimbangan()->where('balita_id', base64_decode($balita))->get();
        $timbangan_dan_vitamin = PenimbanganDanVitamin::where('balita_id', base64_decode($balita))
            ->where('vitamin_a', '!=', null)->get();

        $datas = [
            'data' => $data,
            'activePage' => 'Balita',
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
        $data = Balita::findOrFail($balita)->load('ortu_balita');

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Balita  $balita
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $balita)
    {
        $request->validate([
            'nik' => ['required', 'min:16', 'max:16'],
            'nama_lengkap' => ['required', 'string'],
            'tanggal_lahir' => ['required', 'date'],
            'jenis_kelamin' => ['required', 'string'],
            'proses_lahiran' => ['required', 'string'],
        ]);

        if (auth()->user()->role === 'Ibu Balita') {
            $request->validate(['keterangan' => ['required', 'string']]);
            $data = PraUpdateBalita::create([
                'nik' => $request->nik,
                'nama_lengkap' => $request->nama_lengkap,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'bbl' => $request->bbl,
                'pb' => $request->pb,
                'tempat_lahiran' => $request->tempat_lahiran,
                'proses_lahiran' => $request->proses_lahiran,
                'keterangan' => $request->keterangan,
                'user_id' => auth()->user()->id
            ]);
        }

        if (auth()->user()->role === 'Ketua' || auth()->user()->role === 'Kader') {
            $request->validate([
                'nama_ayah' => ['required', 'string'],
                'nama_ibu' => ['required', 'string'],
                'nomor_telepon' => ['required', 'numeric'],
                'rt' => ['required', 'numeric'],
                'rw' => ['required', 'numeric'],
            ]);

            $data = Balita::findOrFail($balita)->load('ortu_balita');
            $data->nik = $request->nik;
            $data->nama_lengkap = $request->nama_lengkap;
            $data->tanggal_lahir = $request->tanggal_lahir;
            $data->jenis_kelamin = $request->jenis_kelamin;
            $data->bbl = $request->bbl;
            $data->pb = $request->pb;
            $data->proses_lahiran = $request->proses_lahiran;
            $data->tempat_lahiran = $request->tempat_lahiran;
            $data->save();


            $data->ortu_balita->nama_suami = $request->nama_ayah;
            $data->ortu_balita->nama_istri = $request->nama_ibu;
            $data->ortu_balita->nomor_telepon = $request->nomor_telepon;
            $data->ortu_balita->rt = $request->rt;
            $data->ortu_balita->rw = $request->rw;
            $data->ortu_balita->save();
        }

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
            $ibu_balita = Ortu::where('user_id', auth()->user()->id)->first();
            $balita = Balita::where('ortu_id', $ibu_balita->id)->get();
            return $balita->toJson();
        }

        return view('dashboard.page.ortu.index', ['activePage' => 'Balita']);
    }

    public function indexVerifikasiUpdateBalita(Request $request)
    {
        if ($request->ajax()) {
            $datas = PraUpdateBalita::all()->load('user');
            return DataTables::of($datas)
                ->addColumn('aksi', function ($model) {
                    $button = '<div class="btn-group"><button type="button" class="btn btn-info btn-sm" onclick="VerifikasiUpdateBalita(' . $model->id . ')"><i class="fa fa-list"></i> Verifikasi</button></div>';
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->toJson();
        }

        return view('dashboard.page.balita.verifikasi', ['activePage' => 'Verifikasi Update Balita']);
    }

    public function editVerifikasiUpdateBalita($id)
    {
        $pra_update = PraUpdateBalita::findOrFail($id);
        $balita = Balita::where('nik', $pra_update->nik)->first();

        return response()->json(compact('pra_update', 'balita'));
    }

    public function updateVerifikasiUpdateBalita(Request $request, $id)
    {
        if ($request->status == 'Verifikasi') {
            $pra_update = PraUpdateBalita::findOrFail($id);
            $balita = Balita::where('nik', $pra_update->nik)->first();
            $balita->update([
                'nama_lengkap' => $pra_update->nama_lengkap,
                'tanggal_lahir' => $pra_update->tanggal_lahir,
                'jenis_kelamin' => $pra_update->jenis_kelamin,
                'bbl' => $pra_update->bbl,
                'pb' => $pra_update->pb,
                'tempat_lahiran' => $pra_update->tempat_lahiran,
                'proses_lahiran' => $pra_update->proses_lahiran,
            ]);

            $log = JadwalKegiatan::create([
                'user_id' => auth()->user()->id,
                'pesan' => "Berhasil melakukan update profile balita",
                'tanggal' => Carbon::now()
            ]);

            PenerimaJadwal::create([
                'ortu_id' => $balita->ortu_id,
                'jadwal_kegiatan_id' => $log->id,
            ]);

            $pra_update->delete();
        } elseif ($request->status = 'Tolak Verifikasi') {
            $pra_update = PraUpdateBalita::findOrFail($id)->delete();
        }

        return response()->json(200);
    }
}
