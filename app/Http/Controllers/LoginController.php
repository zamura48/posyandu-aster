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
        $request->validate([
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
        $data = User::findOrFail(base64_decode($id))->load('ketua', 'kader', 'ortu');

        return view('auth.profile', ['data' => $data, 'activePage' => 'Profile']);
    }

    public function profile_update(Request $request, $id)
    {
        $user = User::findOrFail(base64_decode($id))->load('kader', 'ortu');
        if (auth()->user()->role = "Ketua" || auth()->user()->role = "Kader") {
            $request->validate([
                'nik' => ['required', 'min:16', 'max:16'],
                'nama_lengkap' => ['required', 'string'],
                'tanggal_lahir' => ['required', 'date'],
                'alamat' => ['required', 'string'],
                'nomor_telepon' => ['required', 'min:11', 'numeric']
            ]);

            $user->name = $request->nama_lengkap;
            $user->kader->nik = $request->nik;
            $user->kader->nama_istri = $request->nama_lengkap;
            $user->kader->tanggal_lahir = $request->tanggal_lahir;
            $user->kader->alamat = $request->alamat;
            $user->kader->nomor_telepon = $request->nomor_telepon;
            $user->save();
            $user->kader->save();
        } elseif (auth()->user()->role = "Ibu Balita") {
            $request->validate([
                'nik' => ['required', 'min:16', 'max:16'],
                'nama_istri' => ['required', 'string'],
                'pekerjaan_istri' => ['required', 'string'],
                'alamat' => ['required', 'string'],
                'nomor_telepon' => ['required', 'min:11', 'numeric'],
                'nama_suami' => ['required', 'string'],
                'pekerjaan_suami' => ['required', 'string']
            ]);

            $user->name = $request->nama_istri;
            $user->ortu->nik = $request->nik;
            $user->ortu->nama_istri = $request->nama_ibu;
            $user->ortu->pekerjaan_istri = $request->pekerjaan_ibu;
            $user->ortu->alamat = $request->alamat;
            $user->ortu->nomor_telepon = $request->nomor_telepon;
            $user->ortu->nama_suami = $request->nama_ayah;
            $user->ortu->pekerjaan_suami = $request->pekerjaan_ayah;
            $user->save();
            $user->ortu->save();
        }

        return response()->json(200);
    }

    public function ganti_password(Request $request, $id)
    {
        $request->validate([
            'password' => ['required', 'min:8', 'confirmed', 'string'],
            'password_confirmation' => ['required', 'string', 'min:8',]
        ]);

        $user = User::findOrFail(base64_decode($id));
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json(200);
    }
}
