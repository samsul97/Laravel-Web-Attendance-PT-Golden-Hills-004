<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensi';
    protected $primaryKey = 'id_absensi';
    protected $fillable = ['nip', 'tgl', 'in_out', 'waktu', 'id_shift', 'ketepatan', 'lokasi', 'deskripsi', 'foto'];

    public function karyawan() {
        return $this->belongsTo('App\Models\Karyawan', 'nip');
    }

    public function shift() {
        return $this->belongsTo('App\Models\Shift', 'id_shift');
    }
}
