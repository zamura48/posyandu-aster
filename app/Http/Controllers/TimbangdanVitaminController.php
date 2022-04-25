<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use App\Models\TimbangdanVitamin;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Validator;

class TimbangdanVitaminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(TimbangdanVitamin::all()->load('balita'))
                ->addColumn('aksi', function ($model) {
                    $button = '<button type="button" class="btn btn-warning btn-sm" onclick="ubahDataPemberianVitamin(' . $model->id . ')"><i class="fa fa-edit"></i> Ubah</button> <button type="button" class="btn btn-danger btn-sm" onclick="hapusDataPemberianVitamin(' . $model->id . ')"><i class="fa fa-trash"></i> Hapus</button>';
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->toJson();
        }

        $balita = Balita::all();

        return view('dashboard.page.timbangan_dan_vitamin.index', ['activePage' => 'Pemberian Vitamin', 'balitas' => $balita]);
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
            'id_balita' => ['required'],
            'vitamin_a' => ['required']
        ]);

        $data = TimbangdanVitamin::create([
            'vitamin_a' => $request->vitamin_a,
            'bb' => $request->bb,
            'tb' => $request->tb,
            'aksi_eksklusif' => $request->aksi_eksklusif,
            'inisiatif_menyusui_dini' => $request->inisiatif_menyusui_dini,
            'balita_id' => decrypt($request->id_balita)
        ]);

        return response()->json(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TimbangdanVitamin  $timbangdanVitamin
     * @return \Illuminate\Http\Response
     */
    public function show(TimbangdanVitamin $timbangdanVitamin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TimbangdanVitamin  $timbangdanVitamin
     * @return \Illuminate\Http\Response
     */
    public function edit($timbangdanVitamin)
    {
        $imunisasi = TimbangdanVitamin::findOrFail($timbangdanVitamin);
        $balita = Balita::findOrFail($imunisasi->id)->load('ibuBalita');
        $data = [
            'pemberian_vitamin' => $imunisasi,
            'balita' => $balita
        ];

        return response()->json(base64_encode(json_encode($data)));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TimbangdanVitamin  $timbangdanVitamin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $timbangdanVitamin)
    {
        $data = TimbangdanVitamin::findOrFail($timbangdanVitamin)
            ->update([
                'vitamin_a' => $request->vitamin_a,
                'bb' => $request->bb,
                'tb' => $request->tb,
                'aksi_eksklusif' => $request->aksi_eksklusif,
                'inisiatif_menyusui_dini' => $request->inisiatif_menyusui_dini,
            ]);

        return response()->json(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TimbangdanVitamin  $timbangdanVitamin
     * @return \Illuminate\Http\Response
     */
    public function destroy($timbangdanVitamin)
    {
        TimbangdanVitamin::findOrFail($timbangdanVitamin)->delete();

        return response()->json(200);
    }
}
