<?php

namespace App\Http\Controllers;

use App\Exports\RekapAbsensi;
use App\Models\Absensi;
use App\Models\Karyawan;
use App\Models\Organisasi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class AbsensiController extends Controller
{
    public function absensi(){
        if(! Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $i = 0;
            $absensi = Absensi::orderBy('created_at', 'desc')->get();
            $karyawan = Karyawan::get();
            $organisasi = Organisasi::get();

            return view('admin/absensi', compact('i', 'absensi', 'karyawan', 'organisasi'));
        }
    }

    public function filterAbsensi(Request $request){
        if(! Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $nip = $request->nip;
            $id_organisasi = $request->organisasi;
            $start_date = Carbon::parse($request->start_date)->format('Y-m-d');
            $end_date = Carbon::parse($request->end_date)->format('Y-m-d');

            if($nip == null && $id_organisasi != null){
                $absensi = Absensi::whereBetween('tgl', [$start_date, $end_date])->get();
                $nama_organisasi = Organisasi::findOrFail($id_organisasi)->nama;
                $title = 'Rekap Absensi_' . $nama_organisasi . '_' . $request->start_date . '_to_' . $request->end_date . '.xlsx';

                if($absensi->count() < 1){
                    return redirect()->back()->with('alert-warning', 'Data absensi ' . $nama_organisasi . ' dari tanggal ' . $request->start_date . ' sampai ' . $request->end_date . ' tidak ditemukan!');
                }else{
                    return Excel::download(new RekapAbsensi($absensi, $id_organisasi), $title);
                }
            }else if($nip != null && $id_organisasi == null){
                $id_organisasi = null;
                $absensi = Absensi::whereBetween('tgl', [$start_date, $end_date])->where('nip', $nip)->get();
                $nama_karyawan = Karyawan::findOrFail($nip)->nama;
                $title = 'Rekap Absensi_' . $nama_karyawan . '_' . $request->start_date . '_to_' . $request->end_date . '.xlsx';

                if($absensi->count() < 1){
                    return redirect()->back()->with('alert-warning', 'Data absensi ' . $nama_karyawan . ' dari tanggal ' . $request->start_date . ' sampai ' . $request->end_date . ' tidak ditemukan!');
                }else{
                    return Excel::download(new RekapAbsensi($absensi, $id_organisasi), $title);
                }
            }else if($nip != null && $id_organisasi != null){
                $absensi = Absensi::whereBetween('tgl', [$start_date, $end_date])->where('nip', $nip)->get();
                $nama_karyawan = Karyawan::findOrFail($nip)->nama;
                $title = 'Rekap Absensi_' . $nama_karyawan . '_' . $request->start_date . '_to_' . $request->end_date . '.xlsx';

                if($absensi->count() < 1){
                    return redirect()->back()->with('alert-warning', 'Data absensi ' . $nama_karyawan . ' dari tanggal ' . $request->start_date . ' sampai ' . $request->end_date . ' tidak ditemukan!');
                }else{
                    return Excel::download(new RekapAbsensi($absensi, $id_organisasi), $title);
                }
            }else{
                $id_organisasi = null;
                $absensi = Absensi::whereBetween('tgl', [$start_date, $end_date])->get();
                $title = 'Rekap Absensi_' . $request->start_date . '_to_' . $request->end_date . '.xlsx';

                if($absensi->count() < 1){
                    return redirect()->back()->with('alert-warning', 'Data absensi dari tanggal ' . $request->start_date . ' sampai ' . $request->end_date . ' tidak ditemukan!');
                }else{
                    return Excel::download(new RekapAbsensi($absensi, $id_organisasi), $title);
                }
            }
        }
    }

    public function pratinjauRekap(Request $request){
        if(! Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $nip = $request->nip;
            $id_organisasi = $request->organisasi;
            $start_date = Carbon::parse($request->start_date)->format('Y-m-d');
            $end_date = Carbon::parse($request->end_date)->format('Y-m-d');

            if($nip == null && $id_organisasi != null){
                $absensi = Absensi::join('karyawan', 'karyawan.nip', '=', 'absensi.nip')
                ->join('shift', 'shift.id_shift', '=', 'absensi.id_shift')
                ->select('karyawan.nip', 'karyawan.nama', 'karyawan.id_organisasi', 'tgl', 'in_out', 'waktu', 'shift.desc_shift', 'shift.clock_in', 'shift.clock_out', 'ketepatan', 'lokasi', 'deskripsi', 'foto')
                ->where('karyawan.id_organisasi', $id_organisasi)
                ->whereBetween('tgl', [$start_date, $end_date])->get();

                return response()->json([
                    'absensi' => $absensi,
                ]);
            }else if($nip != null && $id_organisasi == null){
                $absensi = Absensi::join('karyawan', 'karyawan.nip', '=', 'absensi.nip')
                ->join('shift', 'shift.id_shift', '=', 'absensi.id_shift')
                ->select('karyawan.nip', 'karyawan.nama', 'karyawan.id_organisasi', 'tgl', 'in_out', 'waktu', 'shift.desc_shift', 'shift.clock_in', 'shift.clock_out', 'ketepatan', 'lokasi', 'deskripsi', 'foto')
                ->where('karyawan.nip', $nip)
                ->whereBetween('tgl', [$start_date, $end_date])->get();

                return response()->json([
                    'absensi' => $absensi,
                ]);
            }else if($nip != null && $id_organisasi != null){
                $absensi = Absensi::join('karyawan', 'karyawan.nip', '=', 'absensi.nip')
                ->join('shift', 'shift.id_shift', '=', 'absensi.id_shift')
                ->select('karyawan.nip', 'karyawan.nama', 'karyawan.id_organisasi', 'tgl', 'in_out', 'waktu', 'shift.desc_shift', 'shift.clock_in', 'shift.clock_out', 'ketepatan', 'lokasi', 'deskripsi', 'foto')
                ->whereBetween('tgl', [$start_date, $end_date])
                ->where('karyawan.id_organisasi', $id_organisasi)
                ->where('karyawan.nip', $nip)->get();

                return response()->json([
                    'absensi' => $absensi,
                ]);
            }else{
                $absensi = Absensi::join('karyawan', 'karyawan.nip', '=', 'absensi.nip')
                ->join('shift', 'shift.id_shift', '=', 'absensi.id_shift')
                ->select('karyawan.nip', 'karyawan.nama', 'karyawan.id_organisasi', 'tgl', 'in_out', 'waktu', 'shift.desc_shift', 'shift.clock_in', 'shift.clock_out', 'ketepatan', 'lokasi', 'deskripsi', 'foto')
                ->whereBetween('tgl', [$start_date, $end_date])->get();

                return response()->json([
                    'absensi' => $absensi,
                ]);
            }
        }
    }
}
