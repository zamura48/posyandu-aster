<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use App\Models\IbuBalita;
use App\Models\JadwalKegiatan;
use App\Models\Ortu;
use App\Models\PenerimaJadwal;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class JadwalKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = JadwalKegiatan::where('user_id', '=', '1')->orderBy('created_at', 'desc')->get()->load('penerima');

            return DataTables::of($data)
                ->addColumn('aksi', function ($model) {
                    $button = '<div class="btn-group"><button type="button" class="btn btn-warning btn-sm" onclick="ubahDataJadwalKegiatan(' . $model->id . ')"><i class="fa fa-edit"></i> Ubah</button> <button type="button" class="btn btn-danger btn-sm" onclick="hapusDataJadwalKegiatan(' . $model->id . ')"><i class="fa fa-trash"></i> Hapus</button></div>';
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->toJson();
        }

        $data = [
            "activePage" => "Jadwal Kegiatan",
        ];

        return view("dashboard.page.jadwal_kegiatan.index", $data);
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
            'kegiatan' => ['required'],
            'tanggal_kegiatan' => ['required', 'date'],
            'pesan' => ['required']
        ]);

        $balitas = Balita::all()->load('ortu_balita');
        $users = User::all()->load('ortu');
        $pesan = $request->pesan;

        $jadwal_kegiatan = JadwalKegiatan::create([
            'user_id' => auth()->user()->id,
            'nama_kegiatan' => $request->kegiatan,
            'tanggal' => $request->tanggal_kegiatan,
            'pesan' => $pesan
        ]);

        foreach ($balitas as $balita) {
            $umur_balita = Carbon::parse($balita->tanggal_lahir)->diff(Carbon::now());
            if ($umur_balita->format('%y Tahun') == "0 Tahun" || $umur_balita->format('%y Tahun') == "1 Tahun" && $umur_balita->format('%y Tahun') != "5 Tahun") {
                $this->penerimaJadwal($jadwal_kegiatan->id, $balita->ortu_id);
                $this->notifWa($balita->ortu_balita->nomor_telepon, $request->pesan);
            }
        }

        foreach ($users as $user) {
            if ($user->role === "Kader") {
                $this->penerimaJadwal($jadwal_kegiatan->id, $user->ortu->id);
                $this->notifWa($user->ortu->nomor_telepon, $request->pesan);
            }
        }

        return response()->json(200);
    }

    protected function penerimaJadwal(int $jadwal_kegiatan_id, int $ortu_id): void
    {
        $data = PenerimaJadwal::where('jadwal_kegiatan_id', 9)
            ->where('ortu_id', $ortu_id)->first();
        if (empty($data)) {
            PenerimaJadwal::create([
                'jadwal_kegiatan_id' => $jadwal_kegiatan_id,
                'ortu_id' => $ortu_id
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JadwalKegiatan  $jadwalKegiatan
     * @return \Illuminate\Http\Response
     */
    public function show(JadwalKegiatan $jadwalKegiatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JadwalKegiatan  $jadwalKegiatan
     * @return \Illuminate\Http\Response
     */
    public function edit(JadwalKegiatan $jadwalKegiatan)
    {
        return response()->json($jadwalKegiatan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JadwalKegiatan  $jadwalKegiatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $jadwalKegiatan)
    {
        $request->validate([
            'kegiatan' => ['required'],
            'tanggal_kegiatan' => ['required', 'date'],
            'pesan' => ['required']
        ]);

        JadwalKegiatan::findOrFail($jadwalKegiatan)->update([
            'nama_kegiatan' => $request->kegiatan,
            'tanggal' => $request->tanggal_kegiatan,
            'pesan' => $request->pesan
        ]);

        return response()->json(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JadwalKegiatan  $jadwalKegiatan
     * @return \Illuminate\Http\Response
     */
    public function destroy($jadwalKegiatan)
    {
        $data = JadwalKegiatan::findOrFail($jadwalKegiatan)->load('penerima');
        foreach ($data->penerima as $penerima) {
            $penerima->delete();
        }
        $data->delete();

        return response()->json(200);
    }

    public function notifWa($nomor_hp, $pesan)
    {
        $number = $nomor_hp;
        $message = $pesan;
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://127.0.0.1:8000/send-message',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'number=' . $number . '&message=' . $message,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
    }
}
