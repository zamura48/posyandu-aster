<?php

namespace App\Http\Controllers;

use App\Models\IbuBalita;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class IbuBalitaController extends Controller
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
            return DataTables::of(IbuBalita::where('nik', '!=', null)->get()->load('user'))
                ->addColumn('aksi', function ($model) {
                    $button = '<button type="button" class="btn btn-info btn-sm" onclick="VerifikasiIbuBalita(' . $model->id . ')"><i class="fa fa-list"></i> Verifikasi</button>';
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->toJson();
        }

        return view('dashboard.page.ibubalita.verifikasi', ['activePage' => 'Ibu Balita']);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IbuBalita  $ibuBalita
     * @return \Illuminate\Http\Response
     */
    public function show(IbuBalita $ibuBalita)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IbuBalita  $ibuBalita
     * @return \Illuminate\Http\Response
     */
    public function edit($ibuBalita)
    {
        $data = IbuBalita::findOrFail($ibuBalita)->load('user', 'balita');

        return response()->json(base64_encode(json_encode($data)));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IbuBalita  $ibuBalita
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $ibuBalita)
    {
        $ibu_balita = IbuBalita::findOrFail($ibuBalita);
        $ibu_balita->user->status = $request->status;
        $ibu_balita->user->save();

        return response()->json(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IbuBalita  $ibuBalita
     * @return \Illuminate\Http\Response
     */
    public function destroy($ibuBalita)
    {
        //
    }
}
