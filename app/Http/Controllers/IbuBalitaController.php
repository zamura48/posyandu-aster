<?php

namespace App\Http\Controllers;

use App\Models\IbuBalita;
use App\Models\Ortu;
use App\Models\PraRegister;
use App\Models\User;
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
            $datas = PraRegister::all();
            return DataTables::of($datas)
                ->addColumn('aksi', function ($model) {
                    $button = '<div class="btn-group"><button type="button" class="btn btn-info btn-sm" onclick="VerifikasiIbuBalita(' . $model->id . ')"><i class="fa fa-list"></i> Verifikasi</button></div>';
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
        // $request->validate([
        //     'nik' => ['required', 'min:16', 'max:16', 'unique:balitas'],
        //     'nama_lengkap' => ['required'],
        //     'tanggal_lahir' => ['required'],
        //     'jenis_kelamin' => ['required'],
        // ]);

        // $ibu_balita_id = IbuBalita::where('user_id', auth()->user()->id)->first();

        // $balita = Balita::create([
        //     'nik' => $request->nik,
        //     'nama_lengkap' => $request->nama_lengkap,
        //     'tanggal_lahir' => $request->tanggal_lahir,
        //     'jenis_kelamin' => $request->jenis_kelamin,
        //     'bbl' => $request->bbl,
        //     'pb' => $request->pb,
        //     'ibu_balita_id' => $ibu_balita_id
        // ]);

        // $hitung_umur = Carbon::parse($request->tanggal_lahir)->diff(Carbon::now());

        // if ($hitung_umur->format('%y Tahun') == "0 Tahun" || $hitung_umur->format('%y Tahun') == "1 Tahun") {
        //     Imunisasi::create([
        //         'balita_id' => $balita->id
        //     ]);
        // }

        // return response()->json(['status' => 200]);
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
        $pra_register = PraRegister::findOrFail($ibuBalita);
        $ortu = Ortu::where('nik', $pra_register->nik)
            ->where('nama_istri', 'like', "%$pra_register->nama_istri%")
            ->where('nama_suami', 'like', "%$pra_register->nama_suami%")->get()->load('user', 'balita');

        return response()->json(['pra_registers' => $pra_register, 'ortu' => $ortu]);
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
        if ($request->status == true) {
            $pra_register = PraRegister::findOrFail($ibuBalita);

            $user_id = User::create([
                'role' => 'Ibu Balita',
                'name' => $pra_register->nama_istri,
                'username' => $pra_register->username,
                'password' => $pra_register->password,
                'status' => $pra_register->status
            ]);

            $ortu = Ortu::with('user')->where('nik', $pra_register->nik)
                ->where('nama_istri', 'like', "%$pra_register->nama_istri%")
                ->where('nama_suami', 'like', "%$pra_register->nama_suami%")->first();

            if (empty($ortu)) {
                $ibu_balita =  Ortu::create([
                    'nik' => $pra_register->nik,
                    'nama_istri' => $pra_register->nama_istri,
                    'nama_suami' => $pra_register->nama_suami,
                    'pekerjaan_istri' => $pra_register->pekerjaan_istri,
                    'alamat' => $pra_register->alamat,
                    'rt' => $pra_register->rt,
                    'rw' => $pra_register->rw,
                    'nomor_telepon' => $pra_register->nomor_telepon,
                    'pekerjaan_suami' => $pra_register->pekerjaan_suami,
                    'user_id' => $user_id->id
                ]);
                $ibu_balita = Ortu::findOrFail($ibu_balita->id)->load('user');

                $ibu_balita->user_id = $user_id->id;
                $ibu_balita->user->status = $request->status;
                $ibu_balita->user->save();
            } else {
                // dd($ortu->user->status);
                $ortu->update([
                    'user_id' => $user_id->id
                ]);
                $ortu->user->status = true;
                $ortu->user->save();
            }

            $pra_register->delete();
        }

        // return response()->json(200);
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
