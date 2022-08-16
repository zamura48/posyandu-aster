<?php

namespace App\Http\Controllers;

use App\Exports\PenimbanganExport;
use App\Models\Balita;
use App\Models\Penimbangan;
use App\Models\PenimbanganDanVitamin;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;
use Validator;

class PenimbanganController extends Controller
{
    protected $penimbangan;

    public function __construct()
    {
        $this->penimbangan = new PenimbanganDanVitamin();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            if (empty($request->tahun)) {
                $datas = $this->penimbangan->getDataPenimbangan()->whereYear('tanggal_input', date('Y'))->get();
            } else {
                $datas = $this->penimbangan->getDataPenimbangan()->whereYear('tanggal_input', $request->tahun)->get();
            }

            return DataTables::of($datas)
                ->addColumn('aksi', function ($model) {
                    $button = '<div class="btn-group"><a href="' . route('penimbangan.edit', $model->balita_id) . '" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Ubah</a> <button type="button" class="btn btn-danger btn-sm" onclick="hapusDataPenimbangan(' . $model->balita_id . ')"><i class="fa fa-trash"></i> Hapus</button></div>';
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->toJson();
        }

        $balita = Balita::all();

        return view('dashboard.page.penimbangan.index', ['activePage' => 'Penimbangan Balita', 'balitas' => $balita]);
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
        // $request->validate([
        //     'bulan_tahun' => ['required'],
        //     'bb' => ['required'],
        //     'tb' => ['required'],
        //     'balita_id' => ['required']
        // ]);

        // // MEMISAH BULAN DAN TAHUN
        // $explode = explode("-", $request->bulan_tahun);

        // PenimbanganDanVitamin::create([
        //     'tahun' => $explode[1],
        //     'bulan' => $explode[0],
        //     'bb' => $request->bb,
        //     'tb' => $request->tb,
        //     'keterangan' => $request->keterangan,
        //     'balita_id' => decrypt($request->balita_id)
        // ]);

        // return response()->json(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penimbangan  $penimbangan
     * @return \Illuminate\Http\Response
     */
    public function show($penimbangan)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penimbangan  $penimbangan
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $penimbangan)
    {
        if ($request->ajax()) {
            $penimbangans = Balita::where('id', $penimbangan)->first()->load('penimbangan_dan_vitamin.balita');

            return DataTables::of($penimbangans->penimbangan_dan_vitamin)
                ->addColumn('aksi', function ($model) {
                    $button = '<div class="btn-group"><button type="button" class="btn btn-warning btn-sm" onclick="ubahDataPenimbangan(' . $model->id . ')"><i class="fa fa-edit"></i> Ubah</button> <button type="button" class="btn btn-danger btn-sm" onclick="hapusDataPenimbangan(' . $model->id . ')"><i class="fa fa-trash"></i> Hapus</button></div>';
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->toJson();
        }

        $datas = [
            'activePage' => "Penimbangan Balita",
            'penimbangan' => $penimbangan,
        ];

        return view('dashboard.page.penimbangan.edit', $datas);
    }

    public function getDataEdit($id)
    {
        $penimbangan = PenimbanganDanVitamin::findOrFail($id)->load('balita');
        return response()->json($penimbangan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Penimbangan  $penimbangan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $penimbangan)
    {
        $request->validate([
            'tanggal_input' => ['required', 'date'],
            'bb' => ['required'],
            'tb' => ['required']
        ]);
        // dd($request->all());

        PenimbanganDanVitamin::findOrFail($request->id)->update([
            'tanggal_input' => $request->tanggal_input,
            'bb' => $request->bb,
            'tb' => $request->tb,
            'keterangan' => $request->keterangan
        ]);

        return response()->json(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penimbangan  $penimbangan
     * @return \Illuminate\Http\Response
     */
    public function destroy($penimbangan)
    {
        PenimbanganDanVitamin::where('balita_id', $penimbangan)->delete();

        return response()->json(200);
    }

    public function destroyOne($id)
    {
        PenimbanganDanVitamin::findOrFail($id)->delete();

        return response()->json(200);
    }

    public function export(int $tahun)
    {
        return Excel::download(new PenimbanganExport($tahun), "Penimbangan {$tahun}.xlsx");
    }
}
