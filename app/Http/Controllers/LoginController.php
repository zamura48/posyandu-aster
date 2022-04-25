<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password, 'status' => '1'])) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->with([
            'error' => 'Username atau Password anda salah'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function profile($id)
    {
        $data = User::findOrFail($id)->load('kader', 'ibu_balita');

        return view('auth.profile', ['data' => $data, 'activePage' => 'Profile']);
    }

    public function profile_update(Request $request, $id)
    {
        if ($request->password == null) {
            $request->validate([
                'password' => ['required', 'confirmed']
            ]);

            $user = User::findOrFail($id);
            $user->password = Hash::make($request->password);
            $user->save();
        } else {
            $user = User::findOrFail($id);
            if (!isset($user->kader)) {
                $request->validate([
                    'nik' => ['required', 'min:16', 'max:16'],
                    'nama_lengkap' => ['required'],
                    'tanggal_lahir' => ['required'],
                    'alamat' => ['required'],
                    'nomor_telepon' => ['required', 'min:11', 'numeric']
                ]);

                $user->kader->nik = $request->nik;
                $user->kader->nama_lengkap = $request->nama_lengkap;
                $user->kader->tanggal_lahir = $request->tanggal_lahir;
                $user->kader->alamat = $request->alamat;
                $user->kader->nomor_telepon = $request->nomor_telepon;
                $user->save();
            } else {
                $request->validate([
                    'nik' => ['required', 'min:16', 'max:16'],
                    'nama_ibu' => ['required'],
                    'pekerjaan_ibu' => ['required'],
                    'alamat' => ['required'],
                    'nomor_telepon' => ['required', 'min:11', 'numeric'],
                    'nama_ayah' => ['required'],
                    'pekerjaan_ayah' => ['required']
                ]);

                $user->ibu_balita->nik = $request->nik;
                $user->ibu_balita->nama_ibu = $request->nama_ibu;
                $user->ibu_balita->pekerjaan_ibu = $request->pekerjaan_ibu;
                $user->ibu_balita->alamat = $request->alamat;
                $user->ibu_balita->nomor_telepon = $request->nomor_telepon;
                $user->ibu_balita->nama_ayah = $request->nama_ayah;
                $user->ibu_balita->pekerjaan_ayah = $request->pekerjaan_ayah;
                $user->save();
            }

            return redirect()->back();
        }
    }
}
