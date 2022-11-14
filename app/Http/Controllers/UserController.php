<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\anggota;
use App\Models\m_jabatan;
use App\Models\m_uang_kas;
use App\Models\m_bulan_pembayaran;
use App\Models\m_riwayat;
use App\Models\m_riwayat_pengeluaran;
use App\Models\order;
use Illuminate\Http\Request;    
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use DB;

class UserController extends Controller
{
    public function __construct()
{
    $this->m_uang_kas=new m_uang_kas();
}
    public function register()
    {
        $data['title'] = 'Register';
        return view('user/register', $data);
    }

    public function register_action(Request $request)
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
    }


    public function login()
    {
        $data['title'] = 'Login';
        return view('user/login', $data); //mengarahkan ke view form login
    }

    public function login_action(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ],[
            'username.required' => 'Username tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
        ]);
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('/')->with('success','You are now logged in');
        }
        return back()->withErrors([
            'password' => 'Username atau Password salah',
        ]);
    }
    public function belajarphp(){
        // $user_nim = Auth()->user()->nim;
        // $sql = DB::table('uang_kas')->leftJoin('anggota','anggota.id_anggota','=','uang_kas.id_anggota')
        // ->leftJoin('bulan_pembayaran','bulan_pembayaran.id_bulan_pembayaran','=','uang_kas.id_bulan_pembayaran')
        // ->where('anggota.nim',$user_nim)->get();
        // print_r($sql);
       
        // // $order = DB::table('order')->leftJoin('bulan_pembayaran AS bp','bp.id_bulan_pembayaran','=','order.id_bulan_pembayaran')->leftJoin('uang_kas','uang_kas.id_uang_kas','=','order.id_uang_kas')->leftJoin('anggota','anggota.nim','=','order.nim')->where('order.order_id','=','1684373105')->first();
        // $order = DB::table('order')->leftJoin('bulan_pembayaran AS bp','bp.id_bulan_pembayaran','=','order.id_bulan_pembayaran')->leftJoin('uang_kas','uang_kas.id_uang_kas','=','order.id_uang_kas')->leftJoin('anggota','anggota.nim','=','order.nim')->where('order.order_id','=','1847027600')->first();




        $order = Order::where('order_id','=','1847027600')->leftJoin('bulan_pembayaran AS bp','bp.id_bulan_pembayaran','=','order.id_bulan_pembayaran')->leftJoin('uang_kas','uang_kas.id_uang_kas','=','order.id_uang_kas')->leftJoin('anggota','anggota.nim','=','order.nim')->first();
        $order2 = m_uang_kas::where('id_uang_kas',$order->id_uang_kas)->first();
        try {
            // Update data
            $order->update([
                'transaction_status' => 'pending',
            ]);
            $order2->update([
                'terbayar' => '0',
            ]);
          }
          catch (Exception $e) {
            echo $e->getMessage();
          }
    }
    public function anggota() //mengarahkan ke view anggota
    {
        $data['contoh'] = $this->m_uang_kas->getSum(); //Get function from m_uang_kas
        $data['substract'] = $this->m_uang_kas->sumPengeluaran();
        $data['title'] = 'Anggota';
        $query = DB::table('anggota')->get();
        //check the user has login
        if (Auth::check()) {
            //check the user visibillity
            if (Auth::user()->id_jabatan !== 1)
            {
                return back();
            }
        return view('anggota',$data, compact(['query']));
        }
        else return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
    }

    public function tambah_anggota() //mengarahkan ke view Uang Kas
    {
        $data['contoh'] = $this->m_uang_kas->getSum(); //Get function from m_uang_kas
        $data['substract'] = $this->m_uang_kas->sumPengeluaran();
        $data['title'] = 'Anggota';
        //check the user has login
        if (Auth::check()) {
            //check the user visibillity
            if (Auth::user()->id_jabatan !== 1)
            {
                return back();
            }
        return view('tambah_anggota',$data);
        }
        else return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
    }

    
    public function profile() //mengarahkan ke view Uang Kas
    {
        $this->m_uang_kas = new m_uang_kas();

        $data['contoh'] = $this->m_uang_kas->getSum(); //Get function from m_uang_kas
        $data['substract'] = $this->m_uang_kas->sumPengeluaran();
        $data['title'] = 'Profil';
        $user = Auth::user();
        $data['title'] = 'Profil';
        if (Auth::check()) {
            //check the user has login
        return view('user/profile',$data,compact(['user']));
        }
        else return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
    }

    public function profile_action(Request $request)
    {
        $atribut = $request->validate([
            'name' => 'string|min:3|max:100',
        ]);

        auth()->user()->update($atribut);
        return back()->with('success', 'Profil berhasil diubah');

    }

    public function pengeluaran() //mengarahkan ke view detail
    {
        $data['contoh'] = $this->m_uang_kas->getSum(); //Get function from m_uang_kas
        $data['title'] = 'Pengeluaran';
        if (Auth::check()) {
        return view('pengeluaran',$data);
        }
        else return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');

    }

    public function riwayatKasMasuk() //mengarahkan ke view detail
    {
        $data['contoh'] = $this->m_uang_kas->getSum(); //Get function from m_uang_kas
        $data['substract'] = $this->m_uang_kas->sumPengeluaran();
        $query = m_riwayat::leftjoin('tb_user','tb_user.user_id','=','riwayat.user_id')->leftjoin('uang_kas','uang_kas.id_uang_kas','=','riwayat.id_uang_kas')->leftjoin('bulan_pembayaran','bulan_pembayaran.id_bulan_pembayaran','=','uang_kas.id_bulan_pembayaran')->orderBy('id_riwayat','DESC')->get();
        $data['title'] = 'Riwayat Pemasukkan';
        if (Auth::check()) {
        return view('riwayat',$data,compact(['query']));
        }
        else return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
    }

    public function riwayatKasKeluar() //mengarahkan ke view detail
    {
        $data['contoh'] = $this->m_uang_kas->getSum(); //Get function from m_uang_kas
        $data['substract'] = $this->m_uang_kas->sumPengeluaran();
        $data['title'] = 'Riwayat Pengeluaran';
        $query = m_riwayat_pengeluaran::join('tb_user','tb_user.user_id','=','riwayat_pengeluaran.user_id')->orderBy('id_riwayat_pengeluaran','DESC')->get();
        if (Auth::check()) {
        return view('riwayat_pengeluaran',$data,compact(['query']));
        }
        else return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
    }

    public function laporan() //mengarahkan ke view detail
    {
        $data['contoh'] = $this->m_uang_kas->getSum(); //Get function from m_uang_kas
        $data['substract'] = $this->m_uang_kas->sumPengeluaran();
        $data['title'] = 'Laporan';
        if (Auth::check()) {
        return view('laporan',$data);
        }
        else return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
    }

    public function uang_kas() //mengarahkan ke view Uang Kas
    {
        $data['contoh'] = $this->m_uang_kas->getSum(); //Get function from m_uang_kas
        $data['substract'] = $this->m_uang_kas->sumPengeluaran();
        $data['title'] = 'Uang Kas';
        $query = DB::table('bulan_pembayaran')->get();
        // dd($query);
        if (Auth::check()) {
            //check the user has login
        return view('uang_kas',$data,compact('query'));
        }
        else return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
    }

    public function payment(Request $request)
    {
        // Set your Merchant Server Key
    \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
    // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
    \Midtrans\Config::$isProduction = false;
    // Set sanitization on (default)
    \Midtrans\Config::$isSanitized = true;
    // Set 3DS transaction for credit card to true
    \Midtrans\Config::$is3ds = true;
    
    $query = DB::table('bulan_pembayaran')->first();
    $user_nim = Auth::user()->nim;
    $sql = DB::table('tb_user')->leftJoin('anggota','anggota.nim','=','tb_user.nim')->where('tb_user.nim',$user_nim)->first();

    $params = array(
        'transaction_details' => array(
            'order_id' =>  rand(),
        ),
        'item_details' => array(
            [
                'id' => 'orderid001',
                'price' => $query->nominal_bulanan,
                'quantity' => '1',
                'name' => 'Pembayaran Periode '.ucwords($query->nama_bulan).' | '.$query->tahun,
            ]
        ),
        'customer_details' => array(
            'first_name' => $sql->name,
            'email' => $sql->email,
            'phone' => $sql->no_telepon,
        ),
    );
 
        // $snapToken = \Midtrans\Snap::getSnapToken($params);
        $data['contoh'] = $this->m_uang_kas->getSum(); //Get function from m_uang_kas
        $data['substract'] = $this->m_uang_kas->sumPengeluaran();
        $data['title'] = 'Payment';
        // $data['query'] = DB::table('bulan_pembayaran')->get();
        $data['snaptoken'] = \Midtrans\Snap::getSnapToken($params);
        $data['query'] = DB::table('bulan_pembayaran AS bp')
        ->JOIN('uang_kas AS uk','bp.id_bulan_pembayaran','=','uk.id_bulan_pembayaran')
        ->JOIN('anggota AS agg','agg.id_anggota','=','uk.id_anggota')
        ->JOIN('tb_user AS user','user.nim','=','agg.nim')
        ->where(
            [
                ['uk.status_lunas','=','0'],
                ['user.nim',Auth()->user()->nim]
            ])->get();

        if (Auth::check()) {
            //check the user has login
        return view('payment',$data);
        }
        else return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');

    }
    public function getpayment(Request $request,$id_bulan_pembayaran)
    {
    
    // Set your Merchant Server Key
    \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
    // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
    \Midtrans\Config::$isProduction = false;
    // Set sanitization on (default)
    \Midtrans\Config::$isSanitized = true;
    // Set 3DS transaction for credit card to true
    \Midtrans\Config::$is3ds = true;
    
    $query = DB::table('bulan_pembayaran')->where('id_bulan_pembayaran',$id_bulan_pembayaran)->first();
    $user_nim = Auth::user()->nim;
    $sql = DB::table('tb_user')->leftJoin('anggota','anggota.nim','=','tb_user.nim')->where('tb_user.nim',$user_nim)->first();
    $params = array(
        'transaction_details' => array(
            'order_id' =>  rand(),
            'gross_amount' => 10000,
        ),
        'item_details' => array(
            [
                'price' => $query->nominal_bulanan,
                'quantity' => '1',
                'name' => 'Pembayaran Periode '.ucwords($query->nama_bulan).' | '.$query->tahun,
            ]
        ),
        'customer_details' => array(
            'first_name' => $sql->name,
            'email' => $sql->email,
            'phone' => $sql->no_telepon,
        ),
    );
   
        // $snapToken = \Midtrans\Snap::getSnapToken($params);
        $data['contoh'] = $this->m_uang_kas->getSum(); //Get function from m_uang_kas
        $data['substract'] = $this->m_uang_kas->sumPengeluaran();
        $data['title'] = 'Payment';
        $data['query'] = DB::table('bulan_pembayaran')->get();
        $data['snaptoken'] = \Midtrans\Snap::getSnapToken($params);
        // dd($query);
        if (Auth::check()) {
            //check the user has login
            try {
                // Get Snap Payment Page URL
                //$paymentUrl = \Midtrans\Snap::createTransaction($params);
                
                // Redirect to Snap Payment Page
                return view('payment',$data);
              }
              catch (Exception $e) {
                echo $e->getMessage();
              }
              $query = DB::table('bulan_pembayaran')->where('id_bulan_pembayaran',$id_bulan_pembayaran)->first();
        }
        else return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');

    }

    public function payment_post(Request $request)
    {
        $json = json_decode($request->json);
        $user_nim = Auth()->user()->nim;
        $sql = DB::table('uang_kas')->leftJoin('anggota','anggota.id_anggota','=','uang_kas.id_anggota')
        ->leftJoin('bulan_pembayaran','bulan_pembayaran.id_bulan_pembayaran','=','uang_kas.id_bulan_pembayaran')
        ->where('anggota.nim',$user_nim)->first();
        $order = new Order();
        $order->transaction_status = $json->transaction_status;
        $order->name = $sql->name;
        $order->email = $sql->email;
        $order->nim = $sql->nim;
        $order->id_bulan_pembayaran = $request->id_bulan_pembayaran;
        $order->id_uang_kas = $sql->id_uang_kas;
        $order->no_telepon = $sql->no_telepon;
        $order->status_code =$json->status_code;
        $order->transaction_id = $json->transaction_id;
        $order->transaction_time = $json->transaction_time;
        $order->order_id = $json->order_id; 
        $order->gross_amount = $json->gross_amount;
        $order->payment_type = $json->payment_type;
        $order->payment_code = isset($json->payment_code) ? $json->payment_code : null;
        $order->pdf_url = isset($json->pdf_url) ? $json->pdf_url : null;
        return $order->save() ? redirect(url('/payment'))->with('success', 'Order berhasil dibuat') : redirect(url('/payment'))->with('error', 'Terjadi kesalahan');
    }

    public function password()
    {
        $this->m_uang_kas = new m_uang_kas();

        $data['contoh'] = $this->m_uang_kas->getSum(); //Get function from m_uang_kas
        $data['substract'] = $this->m_uang_kas->sumPengeluaran();
        $data['title'] = 'Ubah Password';
        if (Auth::check()) {
            return view('user/password', $data);
        }
        else return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
    }

    public function password_action(Request $request)
    {
        $request->validate([
            'old_password' => 'required|current_password',
            'new_password' => 'required|confirmed|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            
        ],[
            'old_password.required' => 'Masukkan Password Lama',
            'old_password.current_password' => 'Password lama salah',
            'new_password.required' => 'Password dan Konfirmasi Password wajib diisi',
            'new_password.confirmed' => 'Password atau Konfirmasi Password salah',
            'new_password.min' => 'Password atau Konfirmasi Password minimal 8 karakter',
            'new_password.regex' => "Konfirmasi Password gabungan dari huruf A-z, angka 0-9 dan setidaknya memiliki salah satu karakter # ? ! @ $ % ^ & * - _ + = : ; } {  ] [ \ /> < , . | ` ~",
        ]);
        $user = User::find(Auth::id());
        $user->password = Hash::make($request->new_password);
        $user->save();
        $request->session()->regenerate();
        return back()->with('success', 'Password changed!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
