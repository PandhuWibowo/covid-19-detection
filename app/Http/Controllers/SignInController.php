<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SignInController extends Controller
{
    public function auth(Request $request) {
        $request->validate([
            'no_telp' => 'required|min:10|max:12',
            'password' => 'required|min:8|max:12'
        ]);
        $userInfo = User::where('no_telp', $request->no_telp)->first();

        if (!$userInfo || empty($userInfo)) {
            return back()->with('failed', 'Kami belum menyimpan data Anda');
        } else {
            if (Hash::check($request->password, $userInfo->password)) {
                $request->session()->put('id_user', $userInfo->id_user);
                $request->session()->put('nama', $userInfo->nama);
                $request->session()->put('no_telp', $userInfo->no_telp);
                $request->session()->put('jabatan', $userInfo->jabatan);
                return redirect()->intended('dashboard');
            } else return back()->with('failed', 'Password salah');
        }
    }

    public function dashboard() {
        return view('admin-dashboard.dashboard');
    }

    public function signout() {
        if (session()->has('id_user')) {
            session()->pull('id_user');
            session()->pull('nama');
            session()->pull('no_telp');
            session()->pull('jabatan');
            return redirect('signin');
        }
        dd('diluar if');
    }
}
