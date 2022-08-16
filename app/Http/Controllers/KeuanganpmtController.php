<?php

namespace App\Http\Controllers;

use App\Models\Keuanganpmt;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class KeuanganpmtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(Keuanganpmt::all())
                ->addColumn('aksi', function ($model) {
                    $button = '<div class="btn-group"> <button type="button" class="btn btn-warning btn-sm" onclick="ubahDataKeuanganPMT(' . $model->id . ')"><i class="fa fa-edit"></i> Ubah</button> <button type="button" class="btn btn-danger btn-sm" onclick="hapusDataKeuanganPMT(' . $model->id . ')"><i class="fa fa-trash"></i> Hapus</button></div>';
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->toJson();
        }

        return view('dashboard.page.keuangan_pmt.index', ['activePage' => "Keuangan PMT"]);
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
            'uang_masuk' => ['required', 'numeric'],
            'tanggal_masuk' => ['required', 'date'],
            'uang_keluar' => ['required', 'numeric'],
            'tanggal_keluar' => ['required', 'date'],
            'keterangan' => ['required', 'string']
        ]);

        Keuanganpmt::create([
            'uang_masuk' => $request->uang_masuk,
            'tanggal_masuk' => $request->tanggal_masuk,
            'uang_keluar' => $request->uang_keluar,
            'tanggal_keluar' => $request->tanggal_keluar,
            'keterangan' => $request->keterangan
        ]);

        return response()->json(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Keuanganpmt  $keuanganpmt
     * @return \Illuminate\Http\Response
     */
    public function show(Keuanganpmt $keuanganpmt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Keuanganpmt  $keuanganpmt
     * @return \Illuminate\Http\Response
     */
    public function edit($keuanganpmt)
    {
        $data = Keuanganpmt::findOrFail($keuanganpmt);
        return response()->json(base64_encode(json_encode($data)));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Keuanganpmt  $keuanganpmt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $keuanganpmt)
    {
        $request->validate([
            'uang_masuk' => ['required', 'numeric'],
            'tanggal_masuk' => ['required', 'date'],
            'uang_keluar' => ['required', 'numeric'],
            'tanggal_keluar' => ['required', 'date'],
            'keterangan' => ['required', 'string']
        ]);

        Keuanganpmt::findOrFail(base64_decode($keuanganpmt))->update([
            'uang_masuk' => $request->uang_masuk,
            'tanggal_masuk' => $request->tanggal_masuk,
            'uang_keluar' => $request->uang_keluar,
            'tanggal_keluar' => $request->tanggal_keluar,
            'keterangan' => $request->keterangan
        ]);

        return response()->json(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Keuanganpmt  $keuanganpmt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Keuanganpmt $keuanganpmt)
    {
        $keuanganpmt->delete();

        return response()->json(200);
    }
}
