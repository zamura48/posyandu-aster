<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use App\Models\Penimbangan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Validator;

class PenimbanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(Penimbangan::all()->load('balita'))
                ->addColumn('aksi', function ($model) {
                    $button = '<button type="button" class="btn btn-info btn-sm" onclick="detailDataPenimbangan(' . $model->id . ')"><i class="fa fa-list"></i> Detail</button> <button type="button" class="btn btn-warning btn-sm" onclick="ubahDataPenimbangan(' . $model->id . ')"><i class="fa fa-edit"></i> Ubah</button> <button type="button" class="btn btn-danger btn-sm" onclick="hapusDataPenimbangan(' . $model->id . ')"><i class="fa fa-trash"></i> Hapus</button>';
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
        $rules = [
            'tahun' => 'required',
            'bulan' => 'required',
            'bb' => 'required',
            'tb' => 'required',
            'balita_id' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->toArray()]);
        }

        Penimbangan::create([
            'tahun' => $request->tahun,
            'bulan' => $request->bulan,
            'bb' => $request->bb,
            'tb' => $request->tb,
            'keterangan' => $request->keterangan,
            'balita_id' => decrypt($request->balita_id)
        ]);

        return response()->json(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penimbangan  $penimbangan
     * @return \Illuminate\Http\Response
     */
    public function show(Penimbangan $penimbangan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penimbangan  $penimbangan
     * @return \Illuminate\Http\Response
     */
    public function edit($penimbangan)
    {
        $data = Penimbangan::findOrFail($penimbangan)->load('balita');

        return response()->json(base64_encode(json_encode($data)));
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
        $rules = [
            'tahun' => 'required',
            'bulan' => 'required',
            'bb' => 'required',
            'tb' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->toArray()]);
        }

        $data = Penimbangan::findOrFail($penimbangan);
        $data->tahun = $request->tahun;
        $data->bulan = $request->bulan;
        $data->bb = $request->bb;
        $data->tb = $request->tb;
        $data->keterangan = $request->keterangan;
        $data->save();

        return response()->json(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penimbangan  $penimbangan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penimbangan $penimbangan)
    {
        $penimbangan->delete();

        return response()->json(200);
    }
}
