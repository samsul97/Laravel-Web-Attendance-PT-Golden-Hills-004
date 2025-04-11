<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RekapAbsensi implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public $absensi;
    public $id_organisasi;

    public function __construct($absensi, $id_organisasi)
    {
        $this->absensi = $absensi;
        $this->id_organisasi = $id_organisasi;
    }

    public function view(): View
    {
        $absen = $this->absensi;
        $id_organisasi = $this->id_organisasi;
        return view('admin.export.rekapAbsensi', ['absensi' => $absen, 'id_organisasi' => $id_organisasi]);
    }
}
