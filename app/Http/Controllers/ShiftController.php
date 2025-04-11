<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ShiftController extends Controller
{
    public function shift(){
        if(! Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $i = 0;
            $shift = Shift::orderBy('created_at', 'desc')->get();

            return view('admin/shift', compact('i', 'shift'));
        }
    }

    public function tambahShift(Request $request){
        if(! Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $this->validate($request, [
                'id_shift' => '|required|unique:shift',
            ]);

            $id_shift = $request->id_shift;
            $desc_shift = $request->desc_shift;
            $clock_in = $request->clock_in;
            $clock_out = $request->clock_out;

            $shift = new Shift;
            $shift->id_shift = $id_shift;
            $shift->desc_shift = $desc_shift;
            $shift->clock_in = $clock_in;
            $shift->clock_out = $clock_out;

            if($shift->save()){
                return redirect()->back()->with('alert-success', 'Shift berhasil ditambah!');
            }else{
                return redirect()->back()->with('alert-danger', 'Terjadi kesalahan!');
            }
        }
    }

    public function ubahShift(Request $request){
        if(! Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{

            $id_shift = $request->id_shift;
            $desc_shift = $request->desc_shift;
            $clock_in = $request->clock_in;
            $clock_out = $request->clock_out;

            $shift = Shift::findOrFail($id_shift);
            $shift->desc_shift = $desc_shift;
            $shift->clock_in = $clock_in;
            $shift->clock_out = $clock_out;

            if($shift->save()){
                return redirect()->back()->with('alert-success', 'Shift berhasil diubah!');
            }else{
                return redirect()->back()->with('alert-danger', 'Terjadi kesalahan!');
            }
        }
    }

    public function hapusShift(Request $request){
        if(! Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{

            $id_shift = $request->id_shift;

            $absensi = Absensi::where('id_shift', $id_shift)->get();

            if($absensi->count() > 0){
                return redirect()->back()->with('alert-warning', 'Data shift sedang dipakai!');
            }else{
                $shift = Shift::findOrFail($id_shift);

                if($shift->delete($shift)){
                    return redirect()->back()->with('alert-success', 'Shift berhasil dihapus!');
                }else{
                    return redirect()->back()->with('alert-danger', 'Terjadi kesalahan!');
                }
            }
        }
    }
}
