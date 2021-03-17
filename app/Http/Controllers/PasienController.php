<?php

namespace App\Http\Controllers;

use App\Models\DetilKK;
use App\Models\KartuKeluarga;
use App\Models\Pasien;
use App\Models\Warga;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PasienController extends Controller
{
    public function index() {
        $pasien = Pasien::all();
        return view('admin-dashboard.pasien.index', [
            'pasien' => $pasien
        ]);
    }

    public function tambahPasien() {
        $warga = Warga::all();
        return view('admin-dashboard.pasien.tambah-pasien-covid', [
            'warga' => $warga
        ]);
    }

    public function simpanPasienCovid(Request $request) {
        try {
            $anggotaKeluarga = DetilKK::where('nik_keluarga', $request->nik)->first();
            if (empty($anggotaKeluarga)) return response()->json([
                'status' => 400,
                'message' => 'NIK tidak terdaftar'
            ], 400);

            $newPatient = new Pasien;
            $newPatient->tgl_pendataan = Carbon::now();
            $newPatient->id_user = $request->session()->get('id_user');
            $newPatient->nik = $request->nik;
            $newPatient->id_kk = $anggotaKeluarga->id_kk;
            $newPatient->tgl_terinfeksi = $request->tanggal_terinfeksi;
            $newPatient->status_virus = $request->status_virus;
            $newPatient->status_penanganan = $request->status_penanganan;

            if ($newPatient->save()) return response()->json([
                'status' => 201,
                'message' => 'Pasien baru berhasil ditambahkan'
            ]);

            return response()->json([
                'status' => 400,
                'message' => 'Pasien baru gagal ditambahkan'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Internal Server Error',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
