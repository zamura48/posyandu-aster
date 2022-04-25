<?php

namespace App\Http\Controllers;

use App\Models\IbuBalita;
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
            'username' => ['required', 'min:6', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:8'],
            'nama_ibu' => ['required'],
            'pekerjaan_ibu' => ['required'],
            'nama_ayah' => ['required'],
            'pekerjaan_ayah' => ['required'],
            'alamat' => ['required'],
            'nomor_telepon' => ['required']
        ]);

        $user_id = User::create([
            'role' => 'Ibu Balita',
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'status' => '0'
        ]);

        IbuBalita::updateOrCreate(
            ['nama_ibu' => $request->nama_ibu, 'nama_ayah' => $request->nama_ayah],
            [
                'nik' => $request->nik,
                'pekerjaan_ibu' => $request->pekerjaan_ibu,
                'alamat' => $request->alamat,
                'nomor_telepon' => $request->nomor_telepon,
                'pekerjaan_ayah' => $request->pekerjaan_ayah,
                'user_id' => $user_id->id
            ]
        );

        return redirect()->route('login');
    }
}
