<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\Karyawan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CutiController extends Controller
{
    public function cuti(){
        if(! Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        } else {
            $karyawan = Karyawan::orderBy('created_at', 'desc')->get();
            $cuti = Cuti::orderBy('created_at', 'desc')->get();

            return view('admin/cuti', compact('cuti', 'karyawan'));
        }
    }

    public function getJabatan(Request $request){
        if(! Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $jabatan = Karyawan::where('nip', $request->nip)->value('jabatan');
            return response()->json([
                'jabatan' => $jabatan,
            ]);
        }
    }

    public function tambahCuti(Request $request){
        if(! Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $cuti = new Cuti;
            $pengajuan = Carbon::now()->format('Y-m-d');

            $cuti->nip = $request->nip;
            $cuti->jenis_cuti = $request->jenis_cuti;
            $cuti->mulai = Carbon::parse($request->start_date)->format('Y-m-d');
            $cuti->hingga = Carbon::parse($request->end_date)->format('Y-m-d');
            $cuti->alasan = $request->alasan;
            $cuti->tgl_pengajuan = $pengajuan;

            try{
                if($cuti->save()){
                    return redirect()->back()->with('alert-success', 'Cuti berhasil ditambahkan!');
                }else{
                    return redirect()->back()->with('alert-danger', 'Terjadi kesalahan!');
                }
            }catch(\Exception $e){
                return redirect()->back()->with('alert-danger', $e);
            }
        }
    }

    public function ubahCuti(Request $request){
        if(! Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $cuti = Cuti::findOrFail($request->id_cuti);
            $cuti->nip = $request->nip;
            $cuti->jenis_cuti = $request->jenis_cuti;
            $cuti->mulai = Carbon::parse($request->start_date)->format('Y-m-d');
            $cuti->hingga = Carbon::parse($request->end_date)->format('Y-m-d');
            $cuti->alasan = $request->alasan;

            try{
                if($cuti->save()){
                    return redirect()->back()->with('alert-success', 'Cuti berhasil diubah!');
                }else{
                    return redirect()->back()->with('alert-danger', 'Terjadi kesalahan!');
                }
            }catch(\Exception $e){
                return redirect()->back()->with('alert-danger', $e);
            }

        }
    }

    public function hapusCuti(Request $request){
        if(! Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $cuti = Cuti::findOrFail($request->id_cuti);
            if($cuti->delete($cuti)){
                return redirect()->back()->with('alert-success', 'Cuti berhasil dihapus!');
            }else{
                return redirect()->back()->with('alert-danger', 'Terjadi kesalahan!');
            }
        }
    }
}
