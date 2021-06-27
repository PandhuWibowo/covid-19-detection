<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Models\Pasien;

class ExportCovidPatient implements FromCollection, WithHeadings, ShouldAutoSize, WithColumnFormatting {
  protected $startDate;
  protected $endDate;

  function __construct($startDate, $endDate)
  {
    $this->startDate = $startDate;
    $this->endDate = $endDate;
  }

  function collection() {
    $dataPasienCovid = Pasien::select(
        'id_pendataan',
        'tgl_pendataan',
        'data_covid.nik',
        'nama',
        'tgl_terinfeksi',
        'status_virus',
        'tgl_sembuh',
        'status_penanganan',
      )
      ->join('citizens', 'data_covid.nik', '=', 'citizens.nik')
      ->where('tgl_pendataan', '>=', $this->startDate)
      ->where('tgl_pendataan', '<=', $this->endDate)
      ->get();

      foreach ($dataPasienCovid as $row) {
        $row->nik = "`" . $row->nik;
      }
    
      return $dataPasienCovid;
  }

  function headings(): Array {
    return [
      'Id Pendataan',
      'Tanggal Pendataan',
      'NIK',
      'Nama Pasien',
      'Tanggal Terinfeksi',
      'Status Terupdate',
      'Tanggal Sembuh',
      'Status Penanganan'
    ];
  }

  function columnFormats(): Array {
    return [
        'C' => '#',
    ];
  }
}