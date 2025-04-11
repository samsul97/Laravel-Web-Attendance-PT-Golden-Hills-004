<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Cuti;
use App\Models\Karyawan;
use App\Models\Pinjaman;
use App\Models\Shift;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function loginIndex(){
        if(! Session::get('loginUser')){
            return view('user/login');
        }else{
            return redirect('/user/dashboard')->with('alert-warning', 'Sesi anda belum berakhir!');
        }
    }

    public function loginProses(Request $request){
        if(! Session::get('loginUser')){
            $email = $request->email;
            $password = $request->password;

            $user = Karyawan::where('email', $email)->first();

            if($user){
                if(Hash::check($password, $user->password)){
                    Session::put('loginUser', Hash::make($user->nip));
                    Session::put('nip', $user->nip);
                    Session::put('nama', $user->nama);
                    return redirect('/user/dashboard')->with('alert-success', 'Login berhasil!');
                }else{
                    return redirect()->back()->with('alert-danger', 'Password salah!');
                }
            }else{
                return redirect()->back()->with('alert-danger', 'Email salah!');
            }
        }else{
            return redirect('/user/dashboard')->with('alert-warning', 'Sesi anda belum berakhir!');
        }
    }

    public function dashboard(){
        if(! Session::get('loginUser')){
            return redirect('/user/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $nip = Session::get('nip');
            $nama = Session::get('nama');
            $today = Carbon::now()->format('Y-m-d');
            $absensi = Absensi::where('nip', $nip)->where('tgl', $today)->orderBy('created_at','desc')->get();
            $hadir = Absensi::where('tgl', $today)->where('in_out', 'IN')->get();

            $pulang = Absensi::where('tgl', $today)->where('in_out', 'OUT')->get();

            $masuk_state = Absensi::where('nip', $nip)->where('tgl', $today)->where('in_out', "IN")->get()->count();
            $pulang_state = Absensi::where('nip', $nip)->where('tgl', $today)->where('in_out', "OUT")->get()->count();

            $cuti = Cuti::where('nip', $nip)->get();

            if($cuti->count()<1){
                $cuti_state = false;
            }else{
                $cuti_mulai = Carbon::createFromFormat('Y-m-d',Cuti::where('nip', $nip)->orderBy('tgl_pengajuan', 'desc')->value('mulai'));
                $cuti_selesai = Carbon::createFromFormat('Y-m-d', Cuti::where('nip', $nip)->orderBy('tgl_pengajuan', 'desc')->value('hingga'));
                $cuti_state = Carbon::now()->between($cuti_mulai, $cuti_selesai);
            }

            return view('user/dashboard', compact('absensi', 'hadir', 'pulang', 'nama', 'nip', 'masuk_state', 'pulang_state', 'cuti_state'));
        }
    }

    public function logout(){
        if(! Session::get('loginUser')){
            return redirect('/user/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            Session::forget('loginUser');
            Session::forget('nip');
            Session::forget('nama');

            return redirect('/user/login')->with('alert-danger', 'Anda telah logout!');
        }
    }

    public function gantiPassword(){
        if(! Session::get('loginUser')){
            return redirect('/user/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            return view('user/gantiPassword');
        }
    }

    public function gantiPasswordProses(Request $request){
        if(! Session::get('loginUser')){
            return redirect('/user/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $this->validate($request, [
                'pass_baru' => '|required|min:7',
            ]);

            $pass_lama = $request->pass_lama;
            $pass_baru = $request->pass_baru;
            $pass_baru_konf = $request->pass_baru_konf;

            $nip = Session::get('nip');
            $karyawan = Karyawan::findOrFail($nip);

            if(Hash::check($pass_lama, $karyawan->password)){
                if($pass_baru_konf == $pass_baru){
                    $karyawan->password = $pass_baru;
                    $karyawan->save();
                    return redirect()->back()->with('alert-success', 'Password telah diganti!');
                }else{
                    return redirect()->back()->with('alert-danger', 'Konfirmasi password baru salah!');
                }
            }else{
                return redirect()->back()->with('alert-danger', 'Password lama salah!');
            }
        }
    }

    public function profil(){
        if(! Session::get('loginUser')){
            return redirect('/user/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $nip = Session::get('nip');
            $nama = Session::get('nama');
            $tgl = Carbon::parse(Karyawan::findOrFail($nip)->tgl_daftar)->format('d-m-Y');
            $foto_profil = Karyawan::findOrFail($nip)->foto_profil;
            $url_foto = Storage::url($foto_profil);
            $saya = Karyawan::findOrFail($nip);

            return view('user/profil', compact('nip', 'nama', 'tgl', 'url_foto', 'foto_profil', 'saya'));
        }
    }

    public function gantiFoto(Request $request){
        if(! Session::get('loginUser')){
            return redirect('/user/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $this->validate($request, [
                'foto_profil' => '|required',
            ]);

            $foto_profil = $request->foto_profil;
            $nip = Session::get('nip');
            $karyawan = Karyawan::findOrFail($nip);
            $path = Storage::putFile('public/foto_profil', $foto_profil);
            $karyawan->foto_profil = $path;

            if($karyawan->save()){
                return redirect()->back()->with('alert-success', 'Foto profil telah diganti!');
            }else{
                return redirect()->back()->with('alert-danger', 'Terjadi kesalahan!');
            }
        }
    }

    public function absensi($in_out){
        if(! Session::get('loginUser')){
            return redirect('/user/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $date_now = Carbon::now()->format('Y-m-d');
            $nip = Session::get('nip');
            $absensi = Absensi::where('tgl', $date_now)->where('nip', $nip)->where('in_out', $in_out)->get();

            if($in_out == 'IN' || $in_out == 'OUT'){
                if($absensi->count() < 1){
                    $shift = Shift::get();
                    return view('user/absensi', compact('nip', 'in_out', 'shift'));
                }else{
                    return redirect('/user/dashboard')->with('alert-danger', 'Absensi sudah dilakukan!');
                }
            }else{
                return redirect('/user/dashboard');
            }
        }
    }

    public function absensiProses(Request $request){
        if(! Session::get('loginUser')){
            return redirect('/user/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $nip = $request->nip;
            $id_shift = $request->shift;
            $shift = Shift::findOrFail($id_shift);
            $in_out = $request->in_out;
            $lokasi = $request->lokasi;
            $deskripsi = $request->deskripsi;
            $foto = $request->foto;
            $time_now = Carbon::now()->format('H:i:s');
            $waktu = Carbon::parse($time_now);
            $clock_in = Carbon::parse($shift->clock_in);
            $clock_out = Carbon::parse($shift->clock_out);
            $clock_out_state = Carbon::createFromFormat('H:i:s', '06:00:00');

            $diff = 0;

            $ketepatan = "";

            if($in_out == "IN"){
                $diff = $waktu->diff($clock_in);

                if($diff->invert == 0){
                    $ketepatan = "Ya (" . $diff->format("- %H.%i.%s") . ")";
                }else if($diff->invert == 1){
                    $ketepatan = "Tidak (" . $diff->format("+ %H.%i.%s") . ")";
                }

            }else if($in_out == "OUT"){

                if($clock_out <= $clock_out_state ){
                    $clock_out = $clock_out->addDay(1);
                }

                $diff = $clock_out->diff($waktu);

                if($diff->invert == 0){
                    $ketepatan = "Ya (" . $diff->format("%R %H.%i.%s") . ")";
                }else if($diff->invert == 1){
                    $ketepatan = "Tidak (" . $diff->format("%R %H.%i.%s") . ")";
                }
            }

            // dd($clock_out);

            $absensi = new Absensi;
            $absensi->nip = $nip;
            $absensi->tgl = Carbon::now()->format('Y-m-d');
            $absensi->in_out = $in_out;
            $absensi->waktu = Carbon::now()->format('H:i:s');
            $absensi->id_shift = $id_shift;
            $absensi->ketepatan = $ketepatan;
            $absensi->lokasi = $lokasi;
            $absensi->deskripsi = $deskripsi;
            $absensi->foto = $foto;

            if($absensi->save()){
                if($in_out == "IN"){
                    if($diff->invert == 0){
                        return redirect('/user/dashboard')->with('alert-success', 'Anda telah melakukan absensi masuk dengan tepat waktu!');
                    }else if($diff->invert == 1){
                        return redirect('/user/dashboard')->with('alert-warning', 'Anda telah melakukan absensi masuk dengan tidak tepat waktu!');
                    }
                }else if($in_out == "OUT"){
                    if($diff->invert == 0){
                        return redirect('/user/dashboard')->with('alert-success', 'Anda telah melakukan absensi pulang dengan tepat waktu!');
                    }else if($diff->invert == 1){
                        return redirect('/user/dashboard')->with('alert-warning', 'Anda telah melakukan absensi pulang tidak tepat waktu!');
                    }
                }
            }else{
                return redirect('/user/dashboard')->with('alert-danger', 'Terjadi kesalahan!');
            }
        }
    }

    public function getFoto(Request $request){
        if(! Session::get('loginUser')){
            return redirect('/user/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $image_64 = $request->input('foto'); //your base64 encoded data
            $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf
            $replace = substr($image_64, 0, strpos($image_64, ',')+1);

            // find substring fro replace here eg: data:image/png;base64,

            $image = str_replace($replace, '', $image_64);
            $image = str_replace(' ', '+', $image);
            $imageName = 'foto_absensi/' . Str::random(10) . '.' . $extension;

            Storage::disk('public')->put($imageName, base64_decode($image));

            return response()->json([
                'url' => $imageName,
            ], 200);
        }
    }

    public function tentang(){
        if(! Session::get('loginUser')){
            return redirect('/user/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            return view('user/tentang');
        }
    }

    public function lupaPassword(){
        if(! Session::get('loginUser')){
            return view('user/lupaPassword');
        }else{
            return redirect('/user/dashboard')->with('alert-warning', 'Sesi anda belum berakhir!');
        }
    }

    public function lupaPasswordProses(Request $request){
        if(! Session::get('loginUser')){
            $this->validate($request, [
                'email' => '|required|email',
            ]);

            $email = $request->email;
            $karyawan = Karyawan::where('email', $email)->first();

            if($karyawan){
                $nama = $karyawan->nama;
                $crypt_nip = Crypt::encryptString($karyawan->nip);
                $crypt_email = Crypt::encryptString($karyawan->email);
                $link = url('/user/lupaPassword/' . $crypt_nip . '/' . $crypt_email . '');

                Mail::send('user/email/emailLupaPassword', ['nama' => $nama, 'link' => $link], function ($message) use ($email)
                {
                    $message->subject('Email Konfirmasi Lupa Password Akun Absen Dulu (Abdul)');
                    $message->from('harsoftdev@gmail.com', 'Absen Dulu (Abdul)');
                    $message->to($email);
                });

                return redirect('/user/login')->with('alert-warning', 'Cek email untuk konfirmasi penggantian password!');
            }else{
                return redirect()->back()->with('alert-danger', 'Email tidak valid!');
            }
        }else{
            return redirect('/user/dashboard')->with('alert-warning', 'Sesi anda belum berakhir!');
        }
    }

    public function gantiLupaPassword($nip, $email){
        if(! Session::get('loginUser')){
            $nip = Crypt::decryptString($nip);
            $email = Crypt::decryptString($email);
            return view('user/gantiLupaPassword', compact('nip', 'email'));
        }else{
            return redirect('/user/dashboard')->with('alert-warning', 'Sesi anda belum berakhir!');
        }
    }

    public function gantiLupaPasswordProses(Request $request){
        if(! Session::get('loginUser')){
            $nip = $request->nip;
            $email = $request->email;
            $pass_baru = $request->pass_baru;
            $pass_baru_konf = $request->pass_baru_konf;
            $karyawan = Karyawan::where('nip', $nip)->where('email', $email)->first();

            if($karyawan){
                if($pass_baru == $pass_baru_konf){
                    $karyawan->password = $pass_baru;
                    if($karyawan->save()){
                        return redirect('/user/login')->with('alert-success', 'Password berhasil diganti, lanjutkan untuk login!');
                    }
                }else{
                    return redirect()->back()->with('alert-danger', 'Konfirmasi password baru salah!');
                }
            }else{
                return redirect()->back()->with('alert-danger', 'Tidak valid!');
            }
        }else{
            return redirect('/user/dashboard')->with('alert-warning', 'Sesi anda belum berakhir!');
        }
    }

    public function catatanKehadiran(){
        if(! Session::get('loginUser')){
            return redirect('/user/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $nip = Session::get('nip');
            $absensi = Absensi::where('nip', $nip)->orderBy('created_at', 'desc')->get();
            return view('user/catatanKehadiran', compact('absensi'));
        }
    }

    public function riwayatPinjaman(){
        if(! Session::get('loginUser')){
            return redirect('/user/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $nip = Session::get('nip');
            $pinjaman = Pinjaman::where('nip', $nip)->orderBy('created_at', 'desc')->get();
            return view('user/riwayatPinjaman', compact('pinjaman'));
        }
    }

    public function riwayatCuti(){
        if(! Session::get('loginUser')){
            return redirect('/user/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $nip = Session::get('nip');
            $cuti = Cuti::where('nip', $nip)->orderBy('created_at', 'desc')->get();
            return view('user/riwayatCuti', compact('cuti'));
        }
    }
}
