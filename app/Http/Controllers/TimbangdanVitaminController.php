<?php

namespace App\Http\Controllers;

use App\Exports\PemberianVitaminExport;
use App\Models\Balita;
use App\Models\PenimbanganDanVitamin;
use App\Models\TimbangdanVitamin;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
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
        $rtrw = auth()->user()->getRtRw();
        $data = PenimbanganDanVitamin::with('balita')
            ->join('balitas', 'balitas.id', 'penimbangan_dan_vitamin.balita_id')
            ->join('ortus', 'ortus.id', 'balitas.ortu_id')
            ->select('penimbangan_dan_vitamin.*', 'balitas.nama_lengkap', 'ortus.rt', 'ortus.rw')
            ->where('ortus.rt', $rtrw['rt'])
            ->where('ortus.rw', $rtrw['rw']);


        if ($request->ajax()) {
            if (empty($request->bulan) && empty($request->tahun)) {
                $data = $data->whereYear('tanggal_input', date('Y'))->whereIn('vitamin_a', ['Biru', 'Merah'])->get();
            } else {
                $data = $data->whereMonth('tanggal_input', $request->bulan)
                    ->whereYear('tanggal_input', $request->tahun)
                    ->whereIn('vitamin_a', ['Biru', 'Merah'])
                    ->get();
            }
            return DataTables::of($data)
                ->addColumn('aksi', function ($model) {
                    $button = '<div class="btn-group"><button type="button" class="btn btn-warning btn-sm" onclick="ubahDataPemberianVitamin(' . $model->id . ')"><i class="fa fa-edit"></i> Ubah</button> <button type="button" class="btn btn-danger btn-sm" onclick="hapusDataPemberianVitamin(' . $model->id . ')"><i class="fa fa-trash"></i> Hapus</button></div>';
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->toJson();
        }

        return view('dashboard.page.timbangan_dan_vitamin.index', ['activePage' => 'Pemberian Vitamin']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $balitas = Balita::all();

        $datas = [
            'activePage' => "Penimbangan dan Vitamin",
            'balitas' => $balitas
        ];
        return view('dashboard.page.timbangan_dan_vitamin.create', $datas);
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
            'nama_balita' => ['required'],
            'bb' => ['required', 'numeric'],
            'tb' => ['required', 'numeric'],
            'tanggal' => ['required', 'date']
        ]);

        // MENCARI DATA TERAKHIR BERDASARKAN ID BALITA
        $last_data = PenimbanganDanVitamin::latest()->where('balita_id', decrypt($request->nama_balita))->first();

        // MENCARI DATA BALITA
        $balita = Balita::findOrFail(decrypt($request->nama_balita))->load('ortu_balita');
        // MENGHITUNG UMUR BALITA
        $umur = Carbon::parse($balita->tanggal_lahir)->diff(Carbon::now());
        // MENAMPILKAN UMUR BALITA
        $umur = $umur->format('%y Tahun');

        // MEMBUAT TANGGAL BERDASARKAN INPUT TANGGAL
        $date_create = date_create($request->tanggal);
        // MENGUBAH FORMAT TANGGAL MENJADI BULAN
        $date_format = date_format($date_create, 'm');
        // KONDISI JIKA BULAN SAMA DENGAN 01 ATAU 08
        if ($date_format === "01" || $date_format === "08") {
            $request->validate(['vitamin_a' => ['required']]);

            // KONDISI JIKA UMUR SAMA DENGAN 0 TAHUN / 1 TAHUN / 2 TAHUN
            if ($umur == '0 Tahun' || $umur == '1 Tahun' || $umur == '2 Tahun') {
                // KONDISI JIKA INPUT VITAMIN SAMA DENGAN MERAH
                if ($request->vitamin_a !== 'Merah') {
                    return response()->json(['message' => 'Vitamin Biru diberikan untuk balita lebih dari 2 tahun'], 500);
                }
            } else {
                // KONDISI JIKA INPUT VITAMIN SAMA DENGAN BIRU
                if ($request->vitamin_a !== 'Biru') {
                    return response()->json(['message' => 'Vitamin Merah diberikan untuk balita yang berumur kurang dari 2 tahun'], 500);
                }
            }
        }

        if (!empty($last_data) && $last_data->tanggal_input == $request->tanggal) {
            return response()->json(['message' => 'Balita tersebut sudah melakukan penimbangan'], 500);
        } elseif (!empty($last_data) && $last_data->tanggal_input < $request->tanggal) {
            // KONDISI JIKA VARIABEL TIDAK KOSONG DAN BERAT BADAN TURU DARI PENIMBANGAN SEBELUMNYA
            if ($request->bb < $last_data->bb) {
                // MENGHITUNG TURUNYA BERAT BADAN
                $berat_badan = $last_data->bb - $request->bb;
                $nomor_hp = $balita->ortu_balita->nomor_telepon;
                if ($berat_badan <= 0.9) {
                    $berat_badan = "{$berat_badan}gram";
                } else {
                    $berat_badan = "{$berat_badan}kg";
                }
                $pesan = "Hai bun, saya dari posyandu aster ingin memberitahukan bahwa berat badan balita anda yang bernama {$balita->nama_lengkap} turun {$berat_badan} nih. Pastikan balita anda mengkonsumsi makanan yang sehat dan ";
                // MEMANGGIL METHOD/FUNCTION notifWa
                $this->notifWa($nomor_hp, $pesan);
            }
        }

        /**
         * MENDEFINISIKAN OBJEK
         * ATAU
         * MEMANGGIL MODEL PenimbanganDanVitamin
         * */
        $data = new PenimbanganDanVitamin();
        $data->vitamin_a = $request->vitamin_a;


        $data->bb = $request->bb;
        $data->tb = $request->tb;
        $data->aksi_eksklusif = $request->aksi_eksklusif;
        $data->inisiatif_menyusui_dini = $request->inisiatif_menyusui_dini;
        $data->tanggal_input = $request->tanggal;
        $data->balita_id = decrypt($request->nama_balita);
        $data->save();

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
        $imunisasi = PenimbanganDanVitamin::findOrFail($timbangdanVitamin);
        $balita = Balita::findOrFail($imunisasi->balita_id)->load('ortu_balita');
        $datas = [
            'pemberian_vitamin' => $imunisasi,
            'balita' => $balita
        ];

        return response()->json(base64_encode(json_encode($datas)));
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
        $request->validate([
            'vitamin_a' => ['required'],
            'bb' => ['required'],
            'tb' => ['required']
        ]);

        $penimbangan = PenimbanganDanVitamin::findOrFail($timbangdanVitamin)->load('balita');
        // MENGHITUNG UMUR BALITA
        $umur = Carbon::parse($penimbangan->balita->tanggal_lahir)->diff(Carbon::now());
        // MENAMPILKAN UMUR BALITA
        $umur = $umur->format('%y Tahun');

        // KONDISI JIKA UMUR SAMA DENGAN 0 TAHUN / 1 TAHUN / 2 TAHUN
        if ($umur == '0 Tahun' || $umur == '1 Tahun' || $umur == '2 Tahun') {
            // KONDISI JIKA INPUT VITAMIN SAMA DENGAN BIRU
            if ($request->vitamin_a === 'Biru') {
                return response()->json(['message' => 'Vitamin Biru diberikan untuk balita lebih dari 2 tahun'], 500);
            }
        } else {
            // KONDISI JIKA INPUT VITAMIN SAMA DENGAN BIRU
            if ($request->vitamin_a === 'Merah') {
                return response()->json(['message' => 'Vitamin Merah diberikan untuk balita yang berumur kurang dari 2 tahun'], 500);
            }
        }

        $penimbangan->vitamin_a = $request->vitamin_a;
        $penimbangan->bb = $request->bb;
        $penimbangan->tb = $request->tb;
        $penimbangan->aksi_eksklusif = $request->aksi_eksklusif;
        $penimbangan->inisiatif_menyusui_dini = $request->inisiatif_menyusui_dini;
        $penimbangan->save();

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
        PenimbanganDanVitamin::findOrFail($timbangdanVitamin)->delete();

        return response()->json(200);
    }

    public function export(int $bulan = 0, int $tahun = 0)
    {
        $year = date('Y');
        return Excel::download(new PemberianVitaminExport($bulan, $tahun), "Pemberian Vitamin {$year}.xlsx");
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
