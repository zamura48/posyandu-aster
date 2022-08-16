<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use App\Models\IbuBalita;
use App\Models\IbuHamil;
use App\Models\IbuKB;
use App\Models\Imunisasi;
use App\Models\JenisVaksiImunisasi;
use App\Models\Ortu;
use App\Models\Penimbangan;
use App\Models\PenimbanganDanVitamin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\If_;

class GetDataController extends Controller
{
    public function getNamaBalita(Request $request)
    {
        $search = $request->search;
        $rtrw = auth()->user()->getRtRw();
        $balitas = Balita::join('ortus', 'ortus.id', 'balitas.ortu_id')
            ->orderBy('balitas.nama_lengkap', 'asc')
            ->select('balitas.id', 'balitas.nama_lengkap')
            ->where('ortus.rt', $rtrw['rt'])
            ->where('ortus.rw', $rtrw['rw']);

        if ($search == '') {
            $balitas = $balitas->limit(10)->get();
        } else {
            $balitas = $balitas->where('balitas.nama_lengkap', 'like', '%' . $search . '%')->limit(10)->get();
        }

        $response = array();
        foreach ($balitas as $balita) {
            $response[] = array(
                'id' => encrypt($balita->id),
                'text' => $balita->nama_lengkap
            );
        }

        return response()->json($response);
    }

    public function getJenisVaksin(Request $request)
    {
        $search = $request->search;
        $vaksin = [];
        $balita_sudah_vaksin = Imunisasi::where('balita_id', decrypt($request->id))->get();
        foreach ($balita_sudah_vaksin as $key => $value) {
            array_push($vaksin, $value->jenis_vaksin);
        }
        $belum_vaksin = JenisVaksiImunisasi::orderBy('id', 'asc')->whereNotIn('jenis_vaksin', $vaksin);

        if ($search == '') {
            $belum_vaksin = $belum_vaksin->get();
        } else {
            $belum_vaksin = $belum_vaksin->where('jenis_vaksin', 'like', '%' . $search . '%')->get();
        }

        $response = array();
        foreach ($belum_vaksin as $belum) {
            $response[] = array(
                'id' => $belum->jenis_vaksin,
                'text' => strtoupper($belum->jenis_vaksin)
            );
            break;
        }

        return response()->json($response);
    }

    public function getIbuHamils(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $ibu_hamils = Ortu::orderBy('nama_istri', 'asc')->limit(5)->get();
        } else {
            $ibu_hamils = Ortu::where('nama_istri', 'like', "%$search%")->orderBy('nama_istri', 'asc')->limit(5)->get();
        }

        $response = array();
        foreach ($ibu_hamils as $ibu_hamil) {
            if ($ibu_hamil->status != 'Ibu KB') {
                $response[] = array(
                    'value' => $ibu_hamil->id,
                    'nik' => $ibu_hamil->nik,
                    'label' => $ibu_hamil->nama_istri,
                    'tanggal_lahir' => $ibu_hamil->tanggal_lahir,
                    'alamat' => $ibu_hamil->alamat,
                    'nomor_telepon' => $ibu_hamil->nomor_telepon,
                    'pekerjaan_istri' => $ibu_hamil->pekerjaan_istri,
                    'nama_suami' => $ibu_hamil->nama_suami,
                    'pekerjaan_suami' => $ibu_hamil->pekerjaan_suami,
                );
            }
        }
        // dd($ibu_hamils);

        return response()->json($response);
    }

    public function getIbuKbs(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $ibu_kbs = Ortu::orderby('nama_istri', 'asc')
                ->limit(5)
                ->get();
        } else {
            $ibu_kbs = Ortu::where('nama_istri', 'like', '%' . $search . '%')
                ->orderby('nama_istri', 'asc')
                ->limit(5)
                ->get();
        }

        $response = array();
        foreach ($ibu_kbs as $ibu_kb) {
            if ($ibu_kb !== 'Ibu Hamil') {
                $response[] = array(
                    'value' => $ibu_kb->id,
                    'label' => $ibu_kb->nama_istri,
                    'nik' => $ibu_kb->nik,
                    'tanggal_lahir' => $ibu_kb->tanggal_lahir,
                    'alamat' => $ibu_kb->alamat,
                    'nomor_telepon' => $ibu_kb->nomor_telepon,
                    'pekerjaan_istri' => $ibu_kb->pekerjaan_istri,
                    'nama_suami' => $ibu_kb->nama_suami,
                    'pekerjaan_suami' => $ibu_kb->pekerjaan_suami,
                    'jumlah_anak' => $ibu_kb->jumlah_anak
                );
            }
        }

        return response()->json($response);
    }

    public function getNamaIbu(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $ortu_balitas = Ortu::orderby('nama_istri', 'asc')
                ->limit(5)
                ->get();
        } else {
            $ortu_balitas = Ortu::orderby('nama_istri', 'asc')
                ->where('nama_istri', 'like', '%' . $search . '%')
                ->limit(5)
                ->get();
        }

        $response = array();
        foreach ($ortu_balitas as $ortu_balita) {
            $response[] = array(
                'value' => $ortu_balita->id,
                'label' => $ortu_balita->nama_istri,
                'nik' => $ortu_balita->nik,
                'nama_ayah' => $ortu_balita->nama_suami,
                'nomor_telepon' => $ortu_balita->nomor_telepon,
                'rt' => $ortu_balita->rt,
                'rw' => $ortu_balita->rw
            );
        }

        return response()->json($response);
    }

    public function getNamaBalitaPenimbangan(Request $request)
    {
        $search = $request->search;
        $rtrw = auth()->user()->getRtRw();
        $balitas = Balita::join('ortus', 'ortus.id', 'balitas.ortu_id')
            ->orderBy('balitas.nama_lengkap', 'asc')
            ->select('balitas.id', 'balitas.nama_lengkap')
            ->where('ortus.rt', $rtrw['rt'])
            ->where('ortus.rw', $rtrw['rw']);

        if ($search == '') {
            $balitas = $balitas->limit(10)->get();
        } else {
            $balitas = $balitas->where('balitas.nama_lengkap', 'like', '%' . $search . '%')->limit(10)->get();
        }

        $response = array();
        foreach ($balitas as $balita) {
            $response[] = array(
                'id' => encrypt($balita->id),
                'text' => $balita->nama_lengkap
            );
        }

        return response()->json($response);
    }

    public function getPenimbangan($id)
    {
        $penimbangan = PenimbanganDanVitamin::where('balita_id', $id)->orderBy('tanggal_input', 'asc')->get();

        if (count($penimbangan) <= 0) {
            return response()->json();
        }

        $bb = array();
        $bulan = array();
        foreach ($penimbangan as $key => $value) {
            $bb[] = $value->bb;
            if (date('m', strtotime($value->tanggal_input)) === "01") {
                $bulan[] = "Jan";
            } elseif (date('m', strtotime($value->tanggal_input)) === "02") {
                $bulan[] = "Feb";
            } elseif (date('m', strtotime($value->tanggal_input)) === "03") {
                $bulan[] = "Mar";
            } elseif (date('m', strtotime($value->tanggal_input)) === "04") {
                $bulan[] = "Apr";
            } elseif (date('m', strtotime($value->tanggal_input)) === "05") {
                $bulan[] = "Mei";
            } elseif (date('m', strtotime($value->tanggal_input)) === "06") {
                $bulan[] = "Jun";
            } elseif (date('m', strtotime($value->tanggal_input)) === "07") {
                $bulan[] = "Jul";
            } elseif (date('m', strtotime($value->tanggal_input)) === "08") {
                $bulan[] = "Ags";
            } elseif (date('m', strtotime($value->tanggal_input)) === "09") {
                $bulan[] = "Sep";
            } elseif (date('m', strtotime($value->tanggal_input)) === "10") {
                $bulan[] = "Okt";
            } elseif (date('m', strtotime($value->tanggal_input)) === "11") {
                $bulan[] = "Nov";
            } elseif (date('m', strtotime($value->tanggal_input)) === "12") {
                $bulan[] = "Des";
            }
        }

        $balita = Balita::findOrFail($id);
        $hitung_umur = Carbon::parse($balita->tanggal_lahir)->diff(Carbon::now())->format('%y');

        $data_first = $penimbangan->first();
        $data_last = $penimbangan->last();
        $daterange = $data_first != $data_last ? "$data_first->tanggal_input - $data_last->tanggal_input" : "$data_first->tanggal_input";
        $tahun_pertama = date('Y', strtotime($data_first->tanggal_input));
        $tahun_terakhir = date('Y', strtotime($data_last->tanggal_input));
        $tahun = $tahun_pertama == $tahun_terakhir ? $tahun_pertama : "$tahun_pertama - $tahun_terakhir";
        $current = current($bb);
        $end = end($bb);

        $datas = [
            'current' => $current,
            'end' => $end,
            'bb' => $bb,
            'bb_first' => $data_first->bb,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'daterange' => $daterange,
            'umur' => $hitung_umur,
            'jenis_kelamin' => $balita->jenis_kelamin
        ];

        return response()->json($datas);
    }

    public function getNamaOrtu($id)
    {
        $balita = Balita::findOrFail(decrypt($id))->load('ortu_balita');

        $datas = [
            'nama_suami' => $balita->ortu_balita->nama_suami,
            'nama_istri' => $balita->ortu_balita->nama_istri,
            // 'imunisasi' => $balita->imunisasi
        ];

        return response()->json($datas);
    }

    public function getBalita(Request $request)
    {
        if ($request->ajax()) {
            $request->validate([
                'nik' => ['required', 'numeric']
            ]);

            $nik = $request->nik;

            $balita = Balita::where('nik', $nik)->first();
            $penimbangan = $balita->penimbangan_dan_vitamin;
            $data = [
                'balita' => $balita,
                'penimbangan' => $penimbangan
            ];
            return response()->json($data);
        }
    }
}
