<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Admin;
use App\Models\Karyawan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    //Login Index
    public function loginIndex(){
        if(! Session::get('loginAdmin')){
            $admin = Admin::get();
            if($admin->count()<1){
                $adm = new Admin;
                $adm->username = "admin";
                $adm->password = "admin123";
                $adm->save();
            }

            return view('admin/login');
        }else{
            return redirect('/admin/dashboard')->with('alert-warning', 'Anda masih dalam sesi!');
        }
    }

    //Login proses
    public function loginProses(Request $request){
        $username = $request->username;
        $password = $request->password;

        $admin = Admin::where('username', $username)->first();

        if($admin){
            if(Hash::check($password, $admin->password)){
                Session::put('loginAdmin', Hash::make($username));
                Session::put('username', $username);
                return redirect('/admin/dashboard')->with('alert-success', 'Login berhasil!');
            }else{
                return redirect()->back()->with('alert-danger', 'Password salah!');
            }
        }else{
            return redirect()->back()->with('alert-danger', 'Username salah!');
        }
    }

    //Logout
    public function logout(){
        if(! Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            Session::forget('loginAdmin');
            Session::forget('username');
            return redirect('/admin/login')->with('alert-danger', 'Anda telah logout!');
        }
    }

    //Dasboard Index
    public function dashboard(){
        if(! Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $today = Carbon::now()->format('Y-m-d');
            $karyawan_count = Karyawan::get()->count();
            $absensi_today_in_count = Absensi::where('tgl', $today)->where('in_out', "IN")->get()->count();
            $absensi_today_out_count = Absensi::where('tgl', $today)->where('in_out', "OUT")->get()->count();

            return view('admin/dashboard', compact('karyawan_count', 'absensi_today_in_count', 'absensi_today_out_count'));
        }
    }

    //Ganti pass Index
    public function gantiPassword(){
        if(! Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            return view('admin/gantiPassword');
        }
    }

    //Ganti pass proses
    public function gantiPasswordProses(Request $request){
        if(! Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $username = Session::get('username');
            $admin = Admin::findOrFail($username);
            $pass_lama = $request->pass_lama;
            $pass_baru = $request->pass_baru;
            $pass_baru_konf = $request->pass_baru_konf;

            if(Hash::check($pass_lama, $admin->password)){
                if($pass_baru == $pass_baru_konf){
                    $admin->password = $pass_baru;
                    if($admin->save()){
                        return redirect()->back()->with('alert-success', 'Password berhasil diganti!');
                    }else{
                        return redirect()->back()->with('alert-danger', 'Terjadi kesalahan!');
                    }
                }else{
                    return redirect()->back()->with('alert-danger', 'Konfirmasi password baru, salah!');
                }
            }else{
                return redirect()->back()->with('alert-danger', 'Password lama salah!');
            }
        }
    }
}
