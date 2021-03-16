<?php

namespace App\Http\Controllers;

use App\Models\DetilKK;
use App\Models\KartuKeluarga;
use Illuminate\Http\Request;
use App\Models\Warga;

class WargaController extends Controller
{
    public function index() {
        $kartuKeluarga = KartuKeluarga::all();
        return view('admin-dashboard.warga.index', [
            'kartuKeluarga' => $kartuKeluarga
        ]);
    }

    public function addCitizen() {
        return view('admin-dashboard.warga.tambah-warga');
    }

    public function createWarga(Request $request) {
        try {
            $kartuKeluargaExisting = KartuKeluarga::find($request->id_kk);
            if ($kartuKeluargaExisting) return response()->json([
                'status' => 400,
                'message' => 'No. Kartu Keluarga sudah terdaftar'
            ]);

            $warga = Warga::find($request->nik);
            if ($warga) return response()->json([
                'status' => 400,
                'message' => 'NIK sudah terdaftar'
            ]);

            $newKartuKeluarga = new KartuKeluarga;
            $newKartuKeluarga->nik_kepala_keluarga = $request->nik_kepala_keluarga;
            $newKartuKeluarga->id_user = $request->session()->get('id_user');
            $newKartuKeluarga->status_tempat_tinggal = $request->status_tempat_tinggal;
            $newKartuKeluarga->id_kk = $request->id_kk;

            $newWarga = new Warga;
            $newWarga->id_user = $request->session()->get('id_user');
            $newWarga->nik = $request->nik;
            $newWarga->nama = $request->nama;
            $newWarga->alamat = $request->alamat;
            $newWarga->no_telp = $request->no_telp;
            $newWarga->pendidikan = $request->pendidikan;
            $newWarga->pekerjaan = $request->pekerjaan;
            $newWarga->status_pernikahan = $request->status_pernikahan;
            $newWarga->tgl_lahir = $request->tanggal_lahir;

            $newDetilKK = new DetilKK;
            $newDetilKK->id_kk = $request->id_kk;
            $newDetilKK->nik_keluarga = $request->nik;
            $newDetilKK->status_keluarga = $request->status_keluarga;

            if ($newKartuKeluarga->save() && $newWarga->save() && $newDetilKK->save()) return response()->json([
                'status' => 201,
                'message' => 'Warga baru berhasil disimpan'
            ]);

            return response()->json([
                'status' => 400,
                'message' => 'Warga baru gagal disimpan'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Internal Server Error',
                'error' => $e
            ], 500);
        }
    }

    public function updateStatusTempatTinggal(Request $request, $id_kk) {
        try {
            $kartuKeluargaSekarang = KartuKeluarga::find($id_kk);
            if (empty($kartuKeluargaSekarang)) return response()->json([
                'status' => 400,
                'message' => 'No. Kartu Keluarga tidak terdaftar'
            ], 400);

            $kartuKeluargaSekarang->status_tempat_tinggal = $request->status_tempat_tinggal;
            if ($kartuKeluargaSekarang->save()) return response()->json([
                'status' => 200,
                'message' => 'Status Tempat Tinggal Kartu Keluarga berhasil diubah'
            ], 200);

            return response()->json([
                'status' => 400,
                'message' => 'Status Tempat Tinggal Kartu Keluarga gagal diubah'
            ], 400);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Internal Server Error',
                'error' => $e
            ], 500);
        }
    }

    public function getKartuKeluarga($id_kk) {
        $kartuKeluarga = KartuKeluarga::find($id_kk);
        $anggota = KartuKeluarga::where('id_kk', $id_kk)->get();
        if (empty($kartuKeluarga)) return redirect('warga')->with('invalid_id', "No. Kartu Keluarga ($id_kk) tidak ada");
        return view('admin-dashboard.warga.kartu-keluarga', [
            'anggota' => $anggota,
            'id_kk' => $id_kk
        ]);
    }

    public function addAnggotaKeluarga($id_kk) {
        $kartuKeluargaExisting = KartuKeluarga::find($id_kk);
        if (empty($kartuKeluargaExisting)) return redirect("warga/kartu-keluarga/$id_kk")->with('invalid_id', "No. Kartu Keluarga ($id_kk) tidak ada");
        return view('admin-dashboard.warga.tambah-anggota-keluarga', [
            'kartuKeluarga' => $kartuKeluargaExisting
        ]);
    }

    public function createAnggotaKeluarga(Request $request) {
        try {
            $kartuKeluargaExisting = KartuKeluarga::find($request->id_kk);
            if (empty($kartuKeluargaExisting)) return response()->json([
                'status' => 400,
                'message' => 'No. Kartu Keluarga tidak terdaftar'
            ]);

            $warga = Warga::find($request->nik);
            if ($warga) return response()->json([
                'status' => 400,
                'message' => 'NIK sudah terdaftar'
            ]);

            $newWarga = new Warga;
            $newWarga->id_user = $request->session()->get('id_user');
            $newWarga->nik = $request->nik;
            $newWarga->nama = $request->nama;
            $newWarga->alamat = $request->alamat;
            $newWarga->no_telp = $request->no_telp;
            $newWarga->pendidikan = $request->pendidikan;
            $newWarga->pekerjaan = $request->pekerjaan;
            $newWarga->status_pernikahan = $request->status_pernikahan;
            $newWarga->tgl_lahir = $request->tanggal_lahir;

            $newDetilKK = new DetilKK;
            $newDetilKK->id_kk = $request->id_kk;
            $newDetilKK->nik_keluarga = $request->nik;
            $newDetilKK->status_keluarga = $request->status_keluarga;

            if ($newWarga->save() && $newDetilKK->save()) return response()->json([
                'status' => 201,
                'message' => 'Warga baru berhasil disimpan'
            ]);

            return response()->json([
                'status' => 400,
                'message' => 'Warga baru gagal disimpan'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Internal Server Error',
                'error' => $e
            ], 500);
        }
    }

    public function editAnggotaKeluarga($id_kk, $nik) {
        $kartuKeluargaExisting = KartuKeluarga::find($id_kk);
        if (empty($kartuKeluargaExisting)) return redirect("warga/kartu-keluarga/$id_kk")->with('invalid_id', "No. Kartu Keluarga ($id_kk) tidak ada");
        $warga = Warga::with('detil_kk')->find($nik);
        if (empty($warga)) return redirect("warga/kartu-keluarga/$id_kk")->with('invalid_nik', "NIK ($nik) tidak ada");
        return view('admin-dashboard.warga.ubah-anggota-keluarga', [
            'kartuKeluarga' => $kartuKeluargaExisting,
            'warga' => $warga
        ]);
    }

    public function updateAnggotaKeluarga(Request $request, $id_kk, $nik) {
        try {
            $kartuKeluargaExisting = KartuKeluarga::find($id_kk);
            if (empty($kartuKeluargaExisting)) return response()->json([
                'status' => 400,
                'message' => 'No. Kartu Keluarga tidak terdaftar'
            ]);

            $warga = Warga::find($nik);
            if (empty($warga)) return response()->json([
                'status' => 400,
                'message' => 'NIK tidak terdaftar'
            ]);

            $warga->id_user = $request->session()->get('id_user');
            $warga->nama = $request->nama;
            $warga->alamat = $request->alamat;
            $warga->no_telp = $request->no_telp;
            $warga->pendidikan = $request->pendidikan;
            $warga->pekerjaan = $request->pekerjaan;
            $warga->status_pernikahan = $request->status_pernikahan;
            $warga->tgl_lahir = $request->tanggal_lahir;
            if ($warga->save()) return response()->json([
                'status' => 200,
                'message' => 'Warga berhasil diubah'
            ]);

            return response()->json([
                'status' => 400,
                'message' => 'Warga gagal diubah'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Internal Server Error',
                'error' => $e
            ], 500);
        }
    }
}
