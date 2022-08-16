<?php

namespace App\Http\Controllers;

use App\Models\IbuBalita;
use App\Models\Ortu;
use App\Models\PraRegister;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;

class RegisterController extends Controller
{
    protected function index()
    {
        return view('auth.register');
    }

    protected function validator()
    {
    }

    protected function create(Request $request)
    {
        $request->validate([
            'email' => ['required', 'unique:users,email'],
            'username' => ['required', 'min:6', 'unique:users,username'],
            'password' => ['required', 'confirmed', 'min:8', 'string'],
            'nik' => ['required', 'min:16', 'max:16', 'unique:pra_registers,nik'],
            'nama_ibu' => ['required', 'string'],
            'pekerjaan_ibu' => ['required', 'string'],
            'nama_ayah' => ['required', 'string'],
            'pekerjaan_ayah' => ['required', 'string'],
            'alamat' => ['required', 'string'],
            'rt' => ['required', 'numeric'],
            'rw' => ['required', 'numeric'],
            'nomor_telepon' => ['required', 'numeric']
        ]);

        try {
            PraRegister::create([
                'role' => 'Ibu Balita',
                'name' => $request->nama_ibu,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'status' => '0',
                'nik' => $request->nik,
                'nama_istri' => $request->nama_ibu,
                'nama_suami' => $request->nama_ayah,
                'pekerjaan_istri' => $request->pekerjaan_ibu,
                'alamat' => $request->alamat,
                'rt' => $request->rt,
                'rw' => $request->rw,
                'nomor_telepon' => $request->nomor_telepon,
                'pekerjaan_suami' => $request->pekerjaan_ayah,
            ]);
        } catch (\Exception $ex) {
            return response()->json(['message' => "Gagal Registrasi"], 500);
        }

        return response()->json(200);
    }
}
