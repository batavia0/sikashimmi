<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\m_uang_kas;
use App\Models\m_riwayat;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function payment_handler(Request $request){
        $json = json_decode($request->getContent());
        $signature_key = hash('sha512',$json->order_id . $json->status_code . $json->gross_amount . env('MIDTRANS_SERVER_KEY'));
        
        if($signature_key != $json->signature_key)
        {
            return abort(404);
        }
        //status berhasil
        // $user_nim = Auth()->user()->nim;
        // $order = Order::where('order_id', $json->order_id)->first();
        // $order = DB::table('order')->leftJoin('bulan_pembayaran AS bp','bp.id_bulan_pembayaran','=','order.id_bulan_pembayaran')->leftJoin('uang_kas','uang_kas.id_uang_kas','=','order.id_uang_kas')->leftJoin('anggota','anggota.nim','=','order.nim')->where('order.order_id',$json->order_id)->first();
        // return $order->update([
        //     'transaction_status'=> $json->transaction_status,
        //     'terbayar' => $json->gross_amount,
        // ])? redirect(url('/payment'))->with('success', 'Transaksi selesai') : redirect(url('/payment'))->with('error', 'Terjadi kesalahan');
        $order = Order::where('order_id',$json->order_id)->leftJoin('bulan_pembayaran AS bp','bp.id_bulan_pembayaran','=','order.id_bulan_pembayaran')
        ->leftJoin('uang_kas','uang_kas.id_uang_kas','=','order.id_uang_kas')
        ->leftJoin('anggota','anggota.nim','=','order.nim')->first();
        $order2 = m_uang_kas::where('id_uang_kas',$order->id_uang_kas)->first();
        try {
            
            // Update data
            $order->update([
                'transaction_status' => $json->transaction_status,
            ])? redirect(url('/payment'))->with('success', 'Transaksi selesai') : redirect(url('/payment'))->with('error', 'Terjadi kesalahan');
            $order2->update([
                'terbayar' => $json->gross_amount,
            ])? redirect(url('/payment'))->with('success', 'Transaksi selesai') : redirect(url('/payment'))->with('error', 'Terjadi kesalahan');

            $riwayat = m_uang_kas::where('id_uang_kas',$order->id_uang_kas)->update([
                'status_lunas' => 1,
                                    ]);
            //Also insert relationship to m_riwayat
            //Get date format
            $datetime = date("Y-m-d H:i:s");
            $riwayat = m_riwayat::create([
                'user_id' => Auth::user()->user_id,
                // 'aksi'    => 'LUNAS Transaksi masuk sebesar Rp'.number_format(Request()->terbayar),
                'aksi'    => 'HOREEE '.$order->name. ' pada bulan ini sudah LUNAS!',
                'id_uang_kas' => order->id_uang_kas,
                'tanggal' => $datetime,
                                        ]);
          }
          catch (Exception $e) {
            echo $e->getMessage();
          }
    }
}
