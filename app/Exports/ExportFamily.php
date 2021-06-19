<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Models\Warga;
use App\Models\KartuKeluarga;
use App\Models\DetilKK;

class ExportFamily implements FromCollection, WithHeadings, ShouldAutoSize, WithColumnFormatting
{
    protected $id;

    function __construct($id) {
        $this->id = $id;
    }

    public function collection()
    {
        $dataAnggotaPerKartuKeluarga = DetilKK::select(
                'kartu_keluarga.id_kk', 
                'citizens.nik', 
                'citizens.nama', 
                'citizens.alamat',
                'citizens.pendidikan',
                'citizens.pekerjaan',
                'citizens.status_pernikahan',
                'citizens.tgl_lahir',
                'citizens.no_telp',
                'detil_kk.status_keluarga',
                'kartu_keluarga.status_tempat_tinggal'
            )
            ->join('kartu_keluarga', 'detil_kk.id_kk', '=', 'kartu_keluarga.id_kk')
            ->join('citizens', 'detil_kk.nik_keluarga', '=', 'citizens.nik')
            ->where('detil_kk.id_kk', $this->id)
            ->get();

        foreach ($dataAnggotaPerKartuKeluarga as $row) {
            $row->id_kk = "`" . $row->id_kk;
            $row->nik = "`" . $row->nik;
        }
        
        return $dataAnggotaPerKartuKeluarga;
    }

    function headings(): Array {
        return [
            // '#',
            'No. Kartu Keluarga',
            'NIK',
            'Nama Lengkap',
            'Alamat',
            'Pendidikan',
            'Pekerjaan',
            'Status Pernikahan',
            'Tanggal Lahir',
            'No. Telepon',
            'Status Keluarga',
            'Status Tempat Tinggal'
        ];
    }

    function columnFormats(): Array {
        return [
            'A' => '#',
            'B' => '#',
        ];
    }

    // function map($softreserve): Array {
    //     return [
    //         (string) $softreserve->id_kk,
    //         (string) $softreserve->nik
    //     ];
    // }
}
