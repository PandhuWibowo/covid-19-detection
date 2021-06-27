<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KartuKeluarga;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportFamily;
use App\Exports\ExportCovidPatient;

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

    function getPatient(Request $request) {
        if (!$request->startDate || !$request->endDate) return back()->with('sign_important', 'Start date or end date is required');
        $startDate = strtotime($request->startDate);
        $endDate = strtotime($request->endDate);
        if ($endDate < $startDate) return back()->with('out_of_range', 'End date out of start date');
        return Excel::download(new ExportCovidPatient($request->startDate, $request->endDate), 'Data Pasien Covid.xlsx');
    }
}
