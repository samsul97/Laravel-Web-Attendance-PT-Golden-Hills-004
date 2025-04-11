<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organisasi extends Model
{
    use HasFactory;

    protected $table = 'organisasi';
    protected $primaryKey = 'id_organisasi';
    protected $fillable = ['id_organisasi', 'nama', 'deskripsi'];

    public $incrementing = false;

    public function karyawan() {
        return $this->hasMany('App\Models\Karyawan', 'id_organisasi');
    }

}
