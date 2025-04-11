<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Karyawan;
use App\Models\Organisasi;
use Carbon\Carbon;
use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\DNSCheckValidation;
use Egulias\EmailValidator\Validation\MultipleValidationWithAnd;
use Egulias\EmailValidator\Validation\RFCValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Ixudra\Curl\Facades\Curl;

class KaryawanController extends Controller
{
    public function karyawan(){
        if(! Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $i = 0;
            $karyawan = Karyawan::orderBy('created_at', 'desc')->get();
            $ac = Curl::to('https://api.rajaongkir.com/starter/city')
            ->withData( array( 'key' => '37eaa119bd2711119af3fd2ab3261030') )
            ->asJson()
            ->get();
            $tempat_lahir = $ac->rajaongkir->results;

            $organisasi = Organisasi::get();

            return view('admin/karyawan', compact('i', 'karyawan', 'tempat_lahir', 'organisasi'));
        }
    }

    public function validasiEmail(Request $request){
        if(! Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $validator = new EmailValidator;
            $multipleValidations = new MultipleValidationWithAnd([
                new RFCValidation,
                new DNSCheckValidation,
            ]);

            $validator = $validator->isValid($request->email, $multipleValidations);

            return response()->json([
                'valid' => $validator,
            ]);
        }
    }

    public function tambahKaryawan(Request $request){
        if(! Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $this->validate($request, [
                'nip' => '|required|unique:karyawan',
                'email' => '|required|email|unique:karyawan',
                'nama' => '|required|max:50|unique:karyawan',
            ]);

            $validator = new EmailValidator;
            $multipleValidations = new MultipleValidationWithAnd([
                new RFCValidation,
                new DNSCheckValidation,
            ]);

            $validator = $validator->isValid($request->email, $multipleValidations);

            if($validator == false){
                return redirect()->back()->with('alert-danger', 'Email tidak valid!');
            }

            $nip = $request->nip;
            $nama = $request->nama;
            $email = $request->email;
            $tempat_lahir = $request->tempat_lahir;
            $tanggal_lahir = Carbon::parse($request->tanggal_lahir)->format('Y-m-d');
            $status = $request->status;
            $kontak_darurat = $request->kontak_darurat;
            $facebook = $request->facebook;
            $linkedin = $request->linkedin;
            $instagram = $request->instagram;
            $youtube = $request->youtube;
            $id_organisasi = $request->organisasi;
            $jabatan = $request->jabatan;
            $tanggal_gabung = Carbon::parse($request->tanggal_gabung)->format('Y-m-d');
            $password = Str::random(7);

            $karyawan = new Karyawan;
            $karyawan->nip = $nip;
            $karyawan->nama = $nama;
            $karyawan->email = $email;
            $karyawan->password = $password;
            $karyawan->tgl_daftar = $tanggal_gabung;
            $karyawan->tempat_lahir = $tempat_lahir;
            $karyawan->tanggal_lahir = $tanggal_lahir;
            $karyawan->status = $status;
            $karyawan->kontak_darurat = $kontak_darurat;
            $karyawan->facebook = $facebook;
            $karyawan->linkedin = $linkedin;
            $karyawan->instagram = $instagram;
            $karyawan->youtube = $youtube;
            $karyawan->id_organisasi = $id_organisasi;
            $karyawan->jabatan = $jabatan;

            if($karyawan->save()){
                Mail::send('admin/email/emailPemberitahuanAkun', ['nama' => $nama, 'email' => $email, 'password' => $password], function ($message) use ($request)
                {
                    $message->subject('Email Informasi Akun Absen Dulu (Abdul)');
                    $message->from('samsulaculhadi@gmail.com', 'Absen Dulu (Abdul)');
                    $message->to($request->email);
                });

                return redirect()->back()->with('alert-success', 'Karyawan berhasil ditambahkan!');
            }else{
                return redirect()->back()->with('alert-success', 'Terjadi kesalahan!');
            }
        }
    }

    public function ubahKaryawan(Request $request){
        if(! Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $this->validate($request, [
                'nama' => '|required|max:50',
            ]);

            $nama = $request->nama;
            $nip = $request->nip;
            $tempat_lahir = $request->tempat_lahir;
            $tanggal_lahir = Carbon::parse($request->tanggal_lahir)->format('Y-m-d');
            $status = $request->status;
            $kontak_darurat = $request->kontak_darurat;
            $facebook = $request->facebook;
            $linkedin = $request->linkedin;
            $instagram = $request->instagram;
            $youtube = $request->youtube;
            $id_organisasi = $request->organisasi;
            $jabatan = $request->jabatan;
            $tanggal_gabung = Carbon::parse($request->tanggal_gabung)->format('Y-m-d');

            $karyawan = Karyawan::findOrFail($nip);
            $karyawan->nama = $nama;
            $karyawan->tempat_lahir = $tempat_lahir;
            $karyawan->tanggal_lahir = $tanggal_lahir;
            $karyawan->status = $status;
            $karyawan->kontak_darurat = $kontak_darurat;
            $karyawan->facebook = $facebook;
            $karyawan->linkedin = $linkedin;
            $karyawan->instagram = $instagram;
            $karyawan->youtube = $youtube;
            $karyawan->id_organisasi = $id_organisasi;
            $karyawan->jabatan = $jabatan;
            $karyawan->tgl_daftar = $tanggal_gabung;

            if($karyawan->save()){
                return redirect()->back()->with('alert-success', 'Karyawan berhasil diubah!');
            }else{
                return redirect()->back()->with('alert-success', 'Terjadi kesalahan!');
            }
        }
    }

    public function hapusKaryawan(Request $request){
        if(! Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{

            $nip = $request->nip;

            $absensi = Absensi::where('nip', $nip)->get();

            if($absensi->count() > 0){
                return redirect()->back()->with('alert-warning', 'Data karyawan sedang dipakai!');
            }else{
                $karyawan = Karyawan::findOrFail($nip);
                $nama = $karyawan->nama;
                $email = $karyawan->email;

                if($karyawan->delete($karyawan)){

                    Mail::send('admin/email/emailPemberitahuanHapusAkun', ['nama' => $nama], function ($message) use ($email)
                    {
                        $message->subject('Email Informasi Akun Absen Dulu (Abdul)');
                        $message->from('harsoftdev@gmail.com', 'Absen Dulu (Abdul)');
                        $message->to($email);
                    });

                    return redirect()->back()->with('alert-success', 'Karyawan berhasil dihapus!');
                }else{
                    return redirect()->back()->with('alert-success', 'Terjadi kesalahan!');
                }
            }
        }
    }
}
