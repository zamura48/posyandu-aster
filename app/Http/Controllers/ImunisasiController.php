<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use App\Models\IbuBalita;
use App\Models\Imunisasi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Validator;

class ImunisasiController extends Controller
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
            if (empty($request->form_date) && empty($request->to_date)) {
                $data = Imunisasi::all()->load('balita');
            } else {
                $data = Imunisasi::whereBetween('hb0', [$request->form_date, $request->to_date])->get()->load('balita');
            }
            return DataTables::of($data)
                ->addColumn('aksi', function ($model) {
                    $button = '<button type="button" class="btn btn-primary btn-sm" onclick="detailDataImunisasi(' . $model->id . ')"><i class="fa fa-list"></i> Detail</button> <button type="button" class="btn btn-warning btn-sm" onclick="ubahDataImunisasi(' . $model->id . ')"><i class="fa fa-edit"></i> Ubah</button> <button type="button" class="btn btn-danger btn-sm" onclick="hapusDataImunisasi(' . $model->id . ')"><i class="fa fa-trash"></i> Hapus</button>';
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->toJson();
        }

        return view('dashboard.page.imunisasi.index', ['activePage' => 'Imunisasi']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $balita = Balita::orderby('nama_lengkap', 'asc')->get();
        $datas = [
            'balitas' => $balita,
            'activePage' => 'Tambah Data Imunisasi'
        ];

        return view('dashboard.page.imunisasi.create', $datas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['id_balita' => ['required']]);

        $arrays = [
            "hb0" => "hb0",
            "bcg" => "bcg",
            "p1" => "p1",
            "p2" => "p2",
            "p3" => "p3",
            "p4" => "p4",
            "dpt1" => "dpt1",
            "dpt2" => "dpt2",
            "dpt3" => "dpt3",
            "pcv1" => "pcv1",
            "pcv2" => "pcv2",
            "pcv3" => "pcv3",
            "ipv" => "ipv",
            "campak" => "campak"
        ];

        foreach ($request->imun as $key => $value) {
            if ($request->imun[$key] == $arrays[$value]) {
                unset($arrays[$value]);
            }
        }

        $balita = Balita::findOrFail(decrypt($request->id_balita));

        foreach ($request->imun as $key => $value) {
            if (is_null($balita->imunisasi)) {
                Imunisasi::updateOrCreate(['balita_id' => $balita->id], ['' . $value . '' => Carbon::now()->toDateString()]);
            } else {
                if (is_null($balita->imunisasi->$value)) {
                    Imunisasi::updateOrCreate(['balita_id' => $balita->id], ['' . $value . '' => Carbon::now()->toDateString()]);
                } else {
                    foreach ($arrays as $key => $value) {
                        Imunisasi::updateOrCreate(['balita_id' => $balita->id], ['' . $value . '' => null]);
                    }
                }
            }
        }

        return response()->json(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Imunisasi  $imunisasi
     * @return \Illuminate\Http\Response
     */
    public function show(Imunisasi $imunisasi)
    {
        $this->data = Imunisasi::findOrFail($imunisasi);

        return response()->json($this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Imunisasi  $imunisasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Imunisasi $imunisasi)
    {
        $this->data = Imunisasi::findOrFail($imunisasi);

        return response()->json($this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Imunisasi  $imunisasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Imunisasi $imunisasi)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Imunisasi  $imunisasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Imunisasi $imunisasi)
    {
        Imunisasi::findOrFail($imunisasi)->delete();

        return response()->json(200);
    }

    public function getNamaOrtu($imunisasi)
    {
        $balita = Balita::findOrFail(decrypt($imunisasi))->load('ibubalita', 'imunisasi');

        $datas = [
            'nama_ayah' => $balita->ibuBalita->nama_ayah,
            'nama_ibu' => $balita->ibuBalita->nama_ibu,
            'imunisasi' => $balita->imunisasi
        ];

        return response()->json($datas);
    }

    public function getNamaBalita(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $balitas = Balita::orderBy('nama_lengkap', 'asc')
                ->select('id', 'nama_lengkap')
                ->limit(10)
                ->get();
        } else {
            $balitas = Balita::orderBy('nama_lengkap', 'asc')
                ->select('id', 'nama_lengkap')
                ->where('nama_lengkap', 'like', '%' . $search . '%')
                ->limit(10)
                ->get();
        }

        $response = array();
        foreach ($balitas as $balita) {
            $response[] = array(
                'id' => $balita->id,
                'text' => $balita->nama_lengkap
            );
        }

        return response()->json($response);
    }
}
