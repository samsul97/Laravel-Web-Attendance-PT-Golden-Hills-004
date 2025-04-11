<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $table = 'shift';
    protected $primaryKey = 'id_shift';
    protected $fillable = ['id_shift', 'desc_shift', 'clock_in', 'clock_out'];

    public $incrementing = false;

    public function absensi() {
        return $this->hasMany('App\Models\Absensi', 'id_shift');
    }
}
