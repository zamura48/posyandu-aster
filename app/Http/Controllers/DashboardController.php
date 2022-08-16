<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use App\Models\IbuHamil;
use App\Models\IbuKB;
use App\Models\JadwalKegiatan;
use App\Models\Ortu;
use App\Models\PenerimaJadwal;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\GetDataController;

class DashboardController extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = new User();
    }

    public function index()
    {
        $ortu = Ortu::all();
        $user = User::all();

        $total_ibuhamil = count($ortu->whereIn('status', 'Ibu Hamil'));
        $total_ibukb = count($ortu->whereIn('status', 'Ibu KB'));
        $total_kader = count($user->whereIn('role', 'Kader'));
        if (auth()->user()->role === 'Ketua' || auth()->user()->role === 'Kader') {
            $rtrw = $this->model->getRtRw();
            $balita = Balita::with('ortu_balita')
                ->join('ortus', 'ortus.id', 'balitas.ortu_id')
                ->select('balitas.*')
                ->where('ortus.rt', $rtrw['rt'])
                ->where('ortus.rw', $rtrw['rw'])
                ->get();
            $total_balita = count($balita);
        } elseif (auth()->user()->role === 'Ibu Balita') {
            $ortu_id = User::findOrFail(auth()->user()->id)->load('ortu');
            $balita = Balita::where('ortu_id', $ortu_id->ortu->id)->get();
            $total_balita = count($balita);
        }

        $ortu_id = $ortu->whereIn('user_id', auth()->user()->id);
        $pengumumans = array();

        if (!empty($ortu_id)) {
            foreach ($ortu_id as $key => $value) {
                $penerima = PenerimaJadwal::where('ortu_id', $value->id)
                    ->orderBy('jadwal_kegiatan_id', 'desc')
                    ->limit(5)->get()->load('jadwal_kegiatan');
                foreach ($penerima as $index => $val) {
                    $pengumumans[] = array(
                        'nama_kegiatan' => $val->jadwal_kegiatan->nama_kegiatan,
                        'pesan' => $val->jadwal_kegiatan->pesan,
                        'tanggal' => $val->jadwal_kegiatan->tanggal
                    );
                }
            }
        }
        // $pengumumans = array_slice($pengumuman, count($pengumuman) - 5);
        // dd($pengumumans);

        $activePage = 'Dashboard';
        $data = compact("activePage", "total_balita", "total_ibukb", "total_kader", "total_ibuhamil", "pengumumans");
        return view('dashboard.index', $data);
    }
}
