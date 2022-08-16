<?php

namespace App\Http\Controllers;

use App\Exports\ImunisasiExport;
use App\Models\Balita;
use App\Models\IbuBalita;
use App\Models\Imunisasi;
use App\Models\JenisVaksiImunisasi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;
use Validator;

class ImunisasiController extends Controller
{
    public $imunisasi;

    public function __construct()
    {
        $this->imunisasi = new Imunisasi();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $data = $this->imunisasi->getDataImunisasi()->get()->dd();
        if ($request->ajax()) {
            if (empty($request->tahun)) {
                $data = $this->imunisasi->getDataImunisasi()->get();
            } else {
                $data = $this->imunisasi->getDataImunisasi()->whereYear('tanggal', $request->tahun)->get();
            }
            return DataTables::of($data)
                ->addColumn('aksi', function ($model) {
                    $button = '<div class="btn-group"><button type="button" class="btn btn-warning btn-sm" onclick="ubahDataImunisasi(' . $model->balita->id . ')"><i class="fa fa-edit"></i> Ubah</button> <button type="button" class="btn btn-danger btn-sm" onclick="hapusDataImunisasi(' . $model->id . ')"><i class="fa fa-trash"></i> Hapus</button></div>';
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->toJson();
        }

        $jenis_vaksin = JenisVaksiImunisasi::all();

        $datas = [
            'activePage' => 'Imunisasi',
            'jenis_vaksin' => $jenis_vaksin,
        ];

        return view('dashboard.page.imunisasi.index', $datas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $balitas = Balita::orderby('nama_lengkap', 'asc')->get();
        $balita = array();
        foreach ($balitas as $b) {
            $hitung_umur = Carbon::parse($b->tanggal_lahir)->diff(Carbon::now());
            if ($hitung_umur->format('%y Tahun') != "3 Tahun") {
                $balita[] = array(
                    "id" => $b->id,
                    "nama_lengkap" => $b->nama_lengkap
                );
            }
        }

        $datas = [
            'balitas' => $balita,
            'activePage' => 'Tambah Data Imunisasi'
        ];

        // return view('dashboard.page.imunisasi.create', $datas);
        // return view('dashboard.page.imunisasi.tambah', $datas);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_balita' => ['required'],
            'jenis_vaksin' => ['required']
        ]);

        $balita_id = decrypt($request->nama_balita);
        $vaksin = JenisVaksiImunisasi::select('id');
        $vaksin_id = $vaksin->where('jenis_vaksin', $request->jenis_vaksin)->first();

        if ($vaksin_id->id <= 1) {
            Imunisasi::create([
                "jenis_vaksin" => $request->jenis_vaksin,
                "tanggal" => $request->tanggal_input,
                "balita_id" => $balita_id,
            ]);
        } else {
            $vaksin_sebelumnya = JenisVaksiImunisasi::findOrFail($vaksin_id->id-1);
            $imunisasi_sebelumnya = Imunisasi::where('jenis_vaksin', $vaksin_sebelumnya->jenis_vaksin)
            ->where('balita_id', $balita_id)->first();

            if (empty($imunisasi_sebelumnya)) {
                return response()->json(['message' => "Balita tersebut belum Imunisasi ".strtoupper($vaksin_sebelumnya->jenis_vaksin)], 500);
            } else {
                Imunisasi::create([
                    "jenis_vaksin" => $request->jenis_vaksin,
                    "tanggal" => $request->tanggal_input,
                    "balita_id" => $balita_id,
                ]);
            }
        }

        return response()->json(200);
    }

    public function storeOld(Request $request)
    {
        $request->validate(['nama_balita' => ['required']]);

        $checkbox = $request->checkbox;
        $vaksin = $request->vaksi;
        $balita_id = decrypt($request->nama_balita);
        if (!empty($checkbox) && !empty($vaksin)) {
            foreach ($checkbox as $key_cb => $value_cb) {
                foreach ($vaksin as $key_vaksin => $value_vaksin) {
                    if ($key_cb == $key_vaksin) {
                        Imunisasi::create([
                            "jenis_vaksin" => $key_vaksin,
                            "tanggal" => $value_vaksin,
                            "balita_id" => $balita_id,
                        ]);
                    }
                }
            }
        } else {
            return response()->json(['message' => 'Pastikan untuk mencentang dan mengisi form'], 500);
        }

        return response()->json(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Imunisasi  $imunisasi
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Imunisasi::findOrFail($id);

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Imunisasi  $imunisasi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $imunisasi = $this->imunisasi->getDataImunisasi()->where('balita_id', $id)->get();

        return response()->json(compact('imunisasi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Imunisasi  $imunisasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $arr = [
            "hb0" => null,
            "bcg" => null,
            "p1" => null,
            "p2" => null,
            "p3" => null,
            "p4" => null,
            "dpt1" => null,
            "dpt2" => null,
            "dpt3" => null,
            "pcv1" => null,
            "pcv2" => null,
            "pcv3" => null,
            "ipv" => null,
            "campak" => null
        ];

        $checkbox = $request->checkbox;
        $vaksin = $request->vaksi;

        if (!empty($checkbox) && !empty($vaksin)) {
            foreach ($vaksin as $key_vaksin => $value_vaksin) {
                foreach ($checkbox as $key_cb => $value_cb) {
                    if ($key_vaksin === $key_cb) {
                        Imunisasi::updateOrCreate(
                            ["jenis_vaksin" => $key_vaksin, "balita_id" => $id],
                            ["tanggal" => $value_vaksin]
                        );
                        $arr["$key_cb"] = $value_vaksin;
                    }
                }
            }
        } elseif (empty($checkbox) || empty($vaksin)) {
            Imunisasi::where('balita_id', $id)->delete();
        }

        foreach ($arr as $key => $value) {
            if (is_null($value)) {
                Imunisasi::where('balita_id', $id)->where('jenis_vaksin', $key)->delete();
            }
        }

        return response()->json(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Imunisasi  $imunisasi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Imunisasi::where('balita_id', $id)->delete();

        return response()->json(200);
    }

    public function export(?int $tahun)
    {
        return Excel::download(new ImunisasiExport($tahun), "Imunisasi {$tahun}.xlsx");
    }
}
