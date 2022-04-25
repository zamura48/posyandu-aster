<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use App\Models\IbuBalita;
use App\Models\IbuHamil;
use App\Models\IbuKB;
use App\Models\Penimbangan;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\If_;

class GetDataController extends Controller
{
    public function getNamaBalita($id)
    {
        $balita = Balita::findOrFail(decrypt($id))->load('ibuBalita');

        $datas = [
            'nama_ayah' => $balita->ibuBalita->nama_ayah,
            'nama_ibu' => $balita->ibuBalita->nama_ibu
        ];

        return response()->json($datas);
    }

    public function getIbuHamils(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $ibu_hamils = IbuHamil::orderby('nama_istri', 'asc')
                ->limit(5)
                ->get();
        } else {
            $ibu_hamils = IbuHamil::orderby('nama_istri', 'asc')
                ->where('nama_istri', 'like', '%' . $search . '%')
                ->limit(5)
                ->get();
        }

        $response = array();
        foreach ($ibu_hamils as $ibu_hamil) {
            $response[] = array(
                'value' => $ibu_hamil->id,
                'label' => $ibu_hamil->nama_istri
            );
        }

        return response()->json($response);
    }

    public function getIbuKbs(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $ibu_kbs = IbuKB::orderby('nama_istri', 'asc')
                ->limit(5)
                ->get();
        } else {
            $ibu_kbs = IbuKB::orderby('nama_istri', 'asc')
                ->where('nama_istri', 'like', '%' . $search . '%')
                ->limit(5)
                ->get();
        }

        $response = array();
        foreach ($ibu_kbs as $ibu_kb) {
            $response[] = array(
                'value' => $ibu_kb->id,
                'label' => $ibu_kb->nama_istri
            );
        }

        return response()->json($response);
    }

    public function getNamaAyah(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $ibu_balitas = IbuBalita::orderby('nama_ayah', 'asc')
                ->limit(5)
                ->get();
        } else {
            $ibu_balitas = IbuBalita::orderby('nama_ayah', 'asc')
                ->where('nama_ayah', 'like', '%' . $search . '%')
                ->limit(5)
                ->get();
        }

        $response = array();
        foreach ($ibu_balitas as $ibu_balita) {
            $response[] = array(
                'value' => $ibu_balita->id,
                'label' => $ibu_balita->nama_ayah,
                'nama_ibu' => $ibu_balita->nama_ibu,
                'nomor_telepon' => $ibu_balita->nomor_telepon
            );
        }

        return response()->json($response);
    }

    public function getPenimbangan($id)
    {
        $penimbangan = Penimbangan::where('balita_id', $id)->get();
        $bb = [];
        $bulan = [];
        foreach ($penimbangan as $key => $value) {
            $bb[] = $value->bb;
        }

        return response()->json($bb);
    }
}
