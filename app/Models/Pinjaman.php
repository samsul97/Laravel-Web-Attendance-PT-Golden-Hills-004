<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    use HasFactory;

    protected $table = 'pinjaman';
    protected $primaryKey = 'id_pinjaman';
    protected $fillable = ['id_pinjaman', 'nip', 'nominal', 'deskripsi'];

    public $incrementing = false;

    public function karyawan(){
        return $this->belongsTo('App\Models\Karyawan', 'nip');
    }
}
