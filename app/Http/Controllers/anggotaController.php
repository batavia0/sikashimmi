<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\anggota;
use App\Models\m_uang_kas;
use App\Models\User;


class anggotaController extends Controller
{

    public function index() //mengarahkan ke view tambah_anggota
    {
        $this->m_uang_kas = new m_uang_kas();

        $data['contoh'] = $this->m_uang_kas->getSum(); //Get function from m_uang_kas
        $data['substract'] = $this->m_uang_kas->sumPengeluaran();
        $data['title'] = 'Tambah Anggota';
        return view('tambah_anggota', $data); 
    }

    public function store(Request $request){
        $request->validate([
            'name'                  => 'required|regex:/^[\pL\s\-]+$/u|max:200',
            'nim'                   => 'required|min:8|max:14|unique:anggota',
            'no_telepon'            => 'required|min:11',
            'email'                 => 'required|unique:anggota',

        ],[
            'name.required'         => 'Nama wajib diisi',
            'name.regex'            => 'Nama hanya boleh diisi karakter A-Z dan a-z',
            'name.max'              => 'Nama maksimal 200 karakter',
            'email.required'        => 'Email wajib diisi',
            'email.unique'          => 'Email telah terdaftar',
            'nim.required'          => 'NIM wajib diisi',
            'nim.numeric'           => 'NIM hanya boleh diisi angka 0-9',
            'nim.min'               => 'NIM minimal 8 angka',
            'nim.max'               => 'NIM maksimal 14 angka',
            'nim.unique'            => 'NIM telah terdaftar',
            'no_telepon.required'   => 'No telepon wajib diisi',
            'no_telepon.min'        => 'Nomor telepon minimal 11 angka',
        ]);
        //Insert to model anggota
        anggota::create($request->all());
        return redirect()->route('anggota')
        ->with('success','Anggota berhasil ditambahkan');;
    }

    public function update(Request $request, $id_anggota){
        
        $request->validate([
            'email'               => 'required|email|unique:anggota,email,'.$id_anggota.',id_anggota',
            'no_telepon'          => 'required|min:11|unique:anggota,no_telepon,'.$id_anggota.',id_anggota',
            'nim'                 => 'required|min:8|max:14|unique:anggota,nim,'.$id_anggota.',id_anggota',
        ],[
            'email.required'      => 'Email wajib diisi',
            'email.unique'        => 'Email telah terdaftar',
            'nim.required'        => 'NIM wajib diisi',
            'nim.unique'          => 'NIM telah terdaftar',
            'nim.min'             => 'NIM minimal 8 angka',
            'nim.max'             => 'NIM maksimal 14 angka',
            'no_telepon.required' => 'No telepon wajib diisi',
            'no_telepon.min'      => 'Nomor telepon minimal 11 angka',
        ]);
        $model = anggota::query()->where('id_anggota',$id_anggota)->update([
            'name'          => $request->name,
            'email'         => $request->email,
            'no_telepon'    => $request->no_telepon,
            'nim'           => $request->nim,
        ]);
        $model = User::query()->where('nim',$request->nim)->update([
            'name'  => $request->name,
            'nim'   => $request->nim,
        ]);
        return redirect()->route('anggota')
                                ->with('success','Anggota berhasil diubah');
    }

    public function destroy($id_anggota)
    {
        $anggota = anggota::find($id_anggota);
        $anggota->delete();
        return redirect()->route('anggota')
                        ->with('success','Anggota berhasil terhapus');
    }
}
