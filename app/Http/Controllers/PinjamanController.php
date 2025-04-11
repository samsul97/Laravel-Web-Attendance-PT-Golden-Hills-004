<?php

namespace App\Http\Controllers;

use App\Exports\RekapPinjaman;
use App\Models\Karyawan;
use App\Models\Organisasi;
use App\Models\Pinjaman;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class PinjamanController extends Controller
{
    public function pinjaman(){
        if(! Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        } else {
            $pinjaman = Pinjaman::orderBy('created_at', 'desc')->get();
            $karyawan = Karyawan::orderBy('created_at', 'desc')->get();
            $organisasi = Organisasi::orderBy('created_at', 'desc')->get();

            return view('admin/pinjaman', compact('pinjaman', 'karyawan', 'organisasi'));
        }
    }

    public function tambahPinjaman(Request $request){
        if(! Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $id = uniqid('pij-', false);

            $loan = new Pinjaman;
            $tgl_pengajuan = Carbon::now()->format('Y-m-d');

            $loan->id_pinjaman = $id;
            $loan->nip = $request->nip;
            $loan->nominal = $request->nominal;
            $loan->deskripsi = $request->deskripsi;
            $loan->tgl_pengajuan = $tgl_pengajuan;

            try{
                if($loan->save()){
                    return redirect()->back()->with('alert-success', 'Pinjaman berhasil ditambahkan!');
                }else{
                    return redirect()->back()->with('alert-danger', 'Terjadi kesalahan!');
                }
            }catch(\Exception $e){
                return redirect()->back()->with('alert-danger', 'Karyawan tidak boleh kosong!');
            }
        }
    }

    public function ubahPinjaman(Request $request){
        if(! Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $loan = Pinjaman::findOrFail($request->id_pinjaman);
            $loan->nip = $request->nip;
            $loan->nominal = $request->nominal;
            $loan->deskripsi = $request->deskripsi;

            try{
                if($loan->save()){
                    return redirect()->back()->with('alert-success', 'Pinjaman berhasil diubah!');
                }else{
                    return redirect()->back()->with('alert-danger', 'Terjadi kesalahan!');
                }
            }catch(\Exception $e){
                return redirect()->back()->with('alert-danger', 'Karyawan tidak boleh kosong!');
            }
        }
    }

    public function hapusPinjaman(Request $request){
        if(! Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $loan = Pinjaman::findOrFail($request->id_pinjaman);
            if($loan->delete($loan)){
                return redirect()->back()->with('alert-success', 'Pinjaman berhasil dihapus!');
            }else{
                return redirect()->back()->with('alert-danger', 'Terjadi kesalahan!');
            }
        }
    }

    public function unduhPinjaman(Request $request){
        if(! Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $nip = $request->nip;
            $id_org = $request->id_organisasi;

            if($nip != NULL && $id_org == NULL){
                $nama = Karyawan::where('nip', $nip)->value('nama');
                $title = 'Rekap Pinjaman_' . $nip . '_' . $nama . '.xlsx';
                $data = DB::table('pinjaman')
                        ->join('karyawan', 'karyawan.nip', '=', 'pinjaman.nip')
                        ->select('id_pinjaman', 'karyawan.nip', 'karyawan.nama', 'nominal', 'deskripsi', 'tgl_pengajuan')
                        ->where('pinjaman.nip', $nip)
                        ->get();

                return Excel::download(new RekapPinjaman($data), $title);
            }else if($nip == NULL && $id_org != NULL){
                $org = Organisasi::where('id_organisasi', $id_org)->value('nama');
                $title = 'Rekap Pinjaman_' . $org . '.xlsx';
                $data = DB::table('pinjaman')
                        ->join('karyawan', 'karyawan.nip', '=', 'pinjaman.nip')
                        ->select('id_pinjaman', 'karyawan.nip', 'karyawan.nama', 'nominal', 'deskripsi', 'tgl_pengajuan')
                        ->where('karyawan.id_organisasi', $id_org)
                        ->get();

                return Excel::download(new RekapPinjaman($data), $title);
            }else if($nip == NULL && $id_org == NULL){
                $title = 'Rekap Pinjaman_All.xlsx';
                $data = DB::table('pinjaman')
                        ->join('karyawan', 'karyawan.nip', '=', 'pinjaman.nip')
                        ->select('id_pinjaman', 'karyawan.nip', 'karyawan.nama', 'nominal', 'deskripsi', 'tgl_pengajuan')
                        ->get();

                return Excel::download(new RekapPinjaman($data), $title);
            }else{
                $nama = Karyawan::where('nip', $nip)->value('nama');
                $org = Organisasi::where('id_organisasi', $id_org)->value('nama');
                $title = 'Rekap Pinjaman_' . $nama . '_' . $org . '.xlsx';
                $data = DB::table('pinjaman')
                        ->join('karyawan', 'karyawan.nip', '=', 'pinjaman.nip')
                        ->select('id_pinjaman', 'karyawan.nip', 'karyawan.nama', 'nominal', 'deskripsi', 'tgl_pengajuan')
                        ->where('karyawan.id_organisasi', $id_org)
                        ->where('pinjaman.nip', $nip)
                        ->get();

                return Excel::download(new RekapPinjaman($data), $title);
            }
        }
    }

    public function pratinjauPinjaman(Request $request){
        if(! Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $nip = $request->nip;
            $id_org = $request->id_organisasi;

            if($nip != NULL && $id_org == NULL){
                $data = DB::table('pinjaman')
                        ->join('karyawan', 'karyawan.nip', '=', 'pinjaman.nip')
                        ->select('id_pinjaman', 'karyawan.nip', 'karyawan.nama', 'nominal', 'deskripsi', 'tgl_pengajuan')
                        ->where('pinjaman.nip', $nip)
                        ->get();

                return response()->json([
                    'data' => $data,
                ]);
            }else if($nip == NULL && $id_org != NULL){
                $data = DB::table('pinjaman')
                        ->join('karyawan', 'karyawan.nip', '=', 'pinjaman.nip')
                        ->select('id_pinjaman', 'karyawan.nip', 'karyawan.nama', 'nominal', 'deskripsi', 'tgl_pengajuan')
                        ->where('karyawan.id_organisasi', $id_org)
                        ->get();

                return response()->json([
                    'data' => $data,
                ]);
            }else if($nip == NULL && $id_org == NULL){
                $data = DB::table('pinjaman')
                        ->join('karyawan', 'karyawan.nip', '=', 'pinjaman.nip')
                        ->select('id_pinjaman', 'karyawan.nip', 'karyawan.nama', 'nominal', 'deskripsi', 'tgl_pengajuan')
                        ->get();

                return response()->json([
                    'data' => $data,
                ]);
            }else{
                $data = DB::table('pinjaman')
                        ->join('karyawan', 'karyawan.nip', '=', 'pinjaman.nip')
                        ->select('id_pinjaman', 'karyawan.nip', 'karyawan.nama', 'nominal', 'deskripsi', 'tgl_pengajuan')
                        ->where('karyawan.id_organisasi', $id_org)
                        ->where('pinjaman.nip', $nip)
                        ->get();

                return response()->json([
                    'data' => $data,
                ]);
            }

        }
    }

}
