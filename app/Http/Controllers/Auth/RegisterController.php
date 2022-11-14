<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    public function index()
    {
        return view('/user/register');
    }

    public function handle()
    {
        $request->validate([
            'name' => 'required|regex:/^[\pL\s\-]+$/u|max:200',
            'username' => 'required|alpha_num|unique:tb_user',
            'nim' => 'required|min:8|max:14|unique:tb_user',
            'password' => 'required|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/', 
            'password_confirm' => 'required|min:8|same:password|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'email'=> 'required|unique:anggota',
            'no_telepon' => 'required|unique:anggota|min:11',
            'id_jabatan|integer|min:1', //hiden pada views dengan default value = 2

        ],[ 
            'name.required' => 'Nama wajib diisi',
            'name.regex' => 'Nama hanya boleh diisi karakter A-Z dan a-z',
            'name.max' => 'Nama maksimal 200 karakter',
            'username.unique' => 'Username tersebut sudah terdaftar',
            'username.required' => 'Username wajib diisi',
            'username.alpha_num' => 'Username hanya boleh diisi alfanumerik a-z, A-Z, 0-9',
            'username.unique' => 'Username tersebut sudah terdaftar',
            'nim.required' => 'NIM wajib diisi',
            'nim.min' => 'NIM minimal 8 karakter',
            'nim.max' => 'NIM maksimal 14 karakter',
            'nim.unique' => 'NIM tersebut sudah terdaftar',

            'password.required' => 'Password wajib diisi', 
            'password.min' => 'Password minimal 8 karakter',
            'password.regex' => "Password gabungan dari huruf A-z, angka 0-9 dan setidaknya memiliki salah satu karakter # ? ! @ $ % ^ & * - _ + = : ; } {  ] [ \ /> < , . | ` ~",
            'password_confirm.required' => 'Konfirmasi Password wajib diisi',
            'password_confirm.same' => 'Password atau Konfirmasi Password salah',
            'password_confirm.min' => 'Konfirmasi Password minimal 8 karakter',
            'password_confirm.regex' => "Konfirmasi Password gabungan dari huruf A-z, angka 0-9 dan setidaknya memiliki salah satu karakter # ? ! @ $ % ^ & * - _ + = : ; } {  ] [ \ /> < , . | ` ~",
            'email.required' => 'Email wajib diisi',
            'email.unique' => 'Email telah terdaftar',
            'no_telepon.required' => 'No Telepon Seluler wajib diisi',
            'no_telepon.unique' => 'No Telepon Seluler telah terdaftar',
            'no_telepon.min' => 'No Telepon Seluler minimal 11 angka',

        ]);
        $user = new User([
            'name' => $request->name,   
            'username' => $request->username,
            'nim' => $request->nim,
            'password' => Hash::make($request->password),
            'id_jabatan' => $request->id_jabatan,
        ]);
        $anggota = new anggota([
                'no_telepon' => $request->no_telepon,
                'email' => $request->email,
                'nim' => $request->nim,
                'name' =>$request->name,
            ]);

        $id=$request->id_jabatan; //hidden pada view dengan default value = 2
        $user->save();
        $anggota->save();

        return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan Login!');

        event(new Registered($user));
    }
}
