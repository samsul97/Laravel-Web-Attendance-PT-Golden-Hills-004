<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Organisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrganisasiController extends Controller
{
    public function organisasi(){
        if(! Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        } else {
            $organisasi = Organisasi::orderBy('created_at', 'desc')->get();

            return view('admin/organisasi', compact('organisasi'));
        }
    }

    public function tambahOrganisasi(Request $request){
        if(! Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $id = uniqid('org-', false);

            $org = new Organisasi;
            $org->id_organisasi = $id;
            $org->nama = $request->nama;
            $org->deskripsi = $request->deskripsi;

            if($org->save()){
                return redirect()->back()->with('alert-success', 'Organisasi berhasil ditambahkan!');
            }else{
                return redirect()->back()->with('alert-danger', 'Terjadi kesalahan!');
            }
        }

    }

    public function ubahOrganisasi(Request $request){
        if(! Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $org = Organisasi::findOrFail($request->id_organisasi);
            $org->nama = $request->nama;
            $org->deskripsi = $request->deskripsi;

            if($org->save()){
                return redirect()->back()->with('alert-success', 'Organisasi berhasil diubah!');
            }else{
                return redirect()->back()->with('alert-danger', 'Terjadi kesalahan!');
            }
        }

    }

    public function hapusOrganisasi(Request $request){
        if(! Session::get('loginAdmin')){
            return redirect('/admin/login')->with('alert-danger', 'Anda harus login terlebih dahulu!');
        }else{
            $id = $request->id_organisasi;
            $karyawan = Karyawan::where('id_organisasi', $id)->get();

            if($karyawan->count() > 0){
                return redirect()->back()->with('alert-warning', 'Data Organisasi sedang dipakai!');
            } else {
                $org = Organisasi::findOrFail($id);
                if($org->delete($org)){
                    return redirect()->back()->with('alert-success', 'Organisasi berhasil dihapus!');
                }else{
                    return redirect()->back()->with('alert-danger', 'Terjadi kesalahan!');
                }
            }
        }

    }

}
