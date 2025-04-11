<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawan';
    protected $primaryKey = 'nip';
    protected $fillable = ['nip', 'nama','tempat_lahir', 'tanggal_lahir', 'status', 'id_organisasi', 'jabatan', 'facebook', 'instagram', 'linkedin', 'youtube', 'kontak_darurat', 'email','password', 'tgl_daftar', 'foto_profil'];
    protected $hidden = ['password'];

    public $incrementing = false;

    public function setPasswordAttribute($value) {
      $this->attributes['password'] = bcrypt($value);
    }

    public function absensi() {
        return $this->hasMany('App\Models\Absensi', 'nip');
    }

    public function pinjaman() {
        return $this->hasMany('App\Models\Pinjaman', 'nip');
    }

    public function cuti() {
        return $this->hasMany('App\Models\Cuti', 'nip');
    }

    public function organisasi(){
        return $this->belongsTo('App\Models\Organisasi', 'id_organisasi');
    }
}
