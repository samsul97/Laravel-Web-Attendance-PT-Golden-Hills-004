<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    use HasFactory;

    protected $table = 'cuti';
    protected $primaryKey = 'id_cuti';
    protected $fillable = ['id_cuti', 'nip', 'jenis_cuti', 'mulai', 'hingga', 'alasan', 'tgl_pengajuan'];

    public function karyawan(){
        return $this->belongsTo('App\Models\Karyawan', 'nip');
    }
}
