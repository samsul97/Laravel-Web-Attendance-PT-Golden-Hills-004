<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RekapPinjaman implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public $pinjaman;

    public function __construct($pinjaman)
    {
        $this->pinjaman = $pinjaman;
    }

    public function view(): View
    {
        $pinjaman = $this->pinjaman;
        return view('admin.export.rekapPinjaman', ['pinjaman' => $pinjaman]);
    }
}
