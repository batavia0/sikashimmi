<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\m_uang_kas;
use App\Models\m_bulan_pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class paymentController extends Controller
{
    public function __construct()
{
    $this->m_uang_kas=new m_uang_kas();
}
    public function index()
    {
        $data['contoh'] = $this->m_uang_kas->getSum(); //Get function from m_uang_kas
        $data['substract'] = $this->m_uang_kas->sumPengeluaran();
        $data['title'] = 'Payment';
        $query = DB::table('bulan_pembayaran')->get();
        $query2 = DB::table('bulan_pembayaran AS bp')->innerJoin('uang_kas AS uk','bp.id_bulan_pembayaran','=','uk.id_bulan_pembayaran')->innerJoin('anggota AS agg','agg.id_anggota','=','uk.id_anggota')->innerJoin('tb_user AS user','user.nim','=','agg.nim')->where('user.nim',Auth()->user()->nim)->first();

        // select * from bulan_pembayaran INNER JOIN uang_kas ON bulan_pembayaran.id_bulan_pembayaran = uang_kas.id_bulan_pembayaran INNER JOIN anggota ON uang_kas.id_anggota = anggota.id_anggota INNER JOIN tb_user ON anggota.nim = tb_user.nim WHERE tb_user.nim = '10107010'
        // dd($query);
        if (Auth::check()) {
        //check the user has login
        return view('payment',$data,compact('query'));
        }
        else return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
    }
    public function payment (Request $request)
    {
    // Set your Merchant Server Key
    \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
    // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
    \Midtrans\Config::$isProduction = false;
    // Set sanitization on (default)
    \Midtrans\Config::$isSanitized = true;
    // Set 3DS transaction for credit card to true
    \Midtrans\Config::$is3ds = true;
    
    $params = array(
        'transaction_details' => array(
            'order_id' => rand(),
            'gross_amount' => 10000,
        ),
        'item_details' => array(
            [
                'id' => 'orderid001',
                'price' => '9000',
                'quantity' => '9',
                'name' => 'Bolpoin'
            ]
        ),
        'customer_details' => array(
            'first_name' => $request->nama,
            'email' => $request->email,
            'phone' => $request->telp,
        ),
    );
 
$snapToken = \Midtrans\Snap::getSnapToken($params);
return view('payment',['snaptoken' => $snapToken]);
    }

    public function getpayment(Request $request, $id_bulan_pembayaran)
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
    $user_nim = Auth()->user()->nim;
    $sql = DB::table('tb_user')->leftJoin('anggota','anggota.nim','=','tb_user.nim')->where('tb_user.nim',$user_nim)->first();
    $params = array(
        'transaction_details' => array(
            'order_id' =>  rand(),
            'gross_amount' => 10000,
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
        $data['query'] = DB::table('bulan_pembayaran')->get();
        $data['snaptoken'] = \Midtrans\Snap::getSnapToken($params);
        // dd($query);
        if (Auth::check()) {
            //check the user has login
            try {
                // Get Snap Payment Page URL
                //$paymentUrl = \Midtrans\Snap::createTransaction($params)->redirect_url;
                
                // Redirect to Snap Payment Page
                return view('payment',$data);
              }
              catch (Exception $e) {
                echo $e->getMessage();
              }
        }
        else return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');

    }

    public function payment_post(Request $request,$id_bulan_pembayaran)
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
}
