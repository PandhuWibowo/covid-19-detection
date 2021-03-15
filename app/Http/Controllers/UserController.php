<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index() {
        $users = User::all();
        return view('admin-dashboard.users.index', [
            'users' => $users
        ]);
    }

    public function createUser(Request $request) {
        try {
            $request->validate([
                'nama' => 'required|string',
                'no_telp' => 'required|string|unique:users',
                'jabatan' => 'required|string',
                'password' => 'required|string',
                'alamat' => 'required|string'
            ]);

            $userExisting = User::where('no_telp', $request->no_telp)->first();
            if ($userExisting) return response()->json([
                'status' => 200,
                'message' => 'User sudah pernah terdaftar',
            ], 200);

            $newUser = new User;
            $newUser->nama = $request->nama;
            $newUser->jabatan = $request->jabatan;
            $newUser->alamat = $request->alamat;
            $newUser->password = Hash::make($request->password);
            $newUser->no_telp = $request->no_telp;

            if ($newUser->save()) return response()->json([
                'status' => 201,
                'message' => 'User baru berhasil disimpan'
            ], 200);

            return response()->json([
                'status' => 400,
                'message' => 'User baru gagal disimpan'
            ], 400);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Internal Server Error',
                'error' => $e
            ], 500);
        }

    }
}
