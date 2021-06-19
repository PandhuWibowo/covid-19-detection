<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KartuKeluarga;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportFamily;

class ReportController extends Controller
{
    function index() {
        $kartuKeluarga = KartuKeluarga::select('id_kk', 'nik_kepala_keluarga')->get();
        return view('admin-dashboard.laporan.index', [
            'kartuKeluarga' => $kartuKeluarga
        ]);
    }

    function getFamily(Request $request) {
        $idKK = $request->idKK;
        return Excel::download(new ExportFamily($idKK), 'Data Kartu Keluarga.xlsx');
    }
}
