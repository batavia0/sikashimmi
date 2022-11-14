<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\m_uang_kas;
use App\Models\m_bulan_pembayaran;
use App\Models\m_pengeluaran;
use Illuminate\Support\Facades\Auth;
use DB;


class laporanController extends Controller
{
    public function pemasukkan()
    {
        $query = DB::table('bulan_pembayaran')->get();
        return view('laporan',compact(['query']));
    }
    public function laporan(Request $request) //mengarahkan ke view laporan
    {
        $this->m_uang_kas = new m_uang_kas();
        $data['contoh'] = $this->m_uang_kas->getSum(); //Get function from m_uang_kas
        $data['substract'] = $this->m_uang_kas->sumPengeluaran();
        $query = DB::table('bulan_pembayaran')->get();
        $data['title'] = 'Laporan';
        if (Auth::check()) {
        return view('laporan',$data,compact(['query']));
        }
        else return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
    }

    public function laporanPemasukkan(Request $request) //Mengarahkan ke view print_laporan_pemasukkan
    { 
        $id = $request->id_bulan_pembayaran;
        $query['query'] = m_uang_kas::leftjoin('bulan_pembayaran','bulan_pembayaran.id_bulan_pembayaran','=','uang_kas.id_bulan_pembayaran')
                                    ->leftjoin('anggota','anggota.id_anggota','=','uang_kas.id_anggota')
                                    ->where('uang_kas.id_bulan_pembayaran',$id)->get();
        $query['sum'] = DB::table('uang_kas')->where('id_bulan_pembayaran',$id)->sum('terbayar');
        return view('print_laporan_pemasukkan',$query);
    }
        public function getSum(){
            return DB::table('uang_kas')->sum('terbayar');
        }
        public function SumPengeluaran(){
            return DB::table('pengeluaran')->sum('jumlah_pengeluaran');
        }
    public function laporanPengeluaran (Request $request) //Mengarahkan ke view print_laporan_pengeluaran
    { 
        
        // DATETIME
        $date['datefrom'] = ($request->dari_tanggal. ' 00:00:00');
        $date['datecurrent'] = ($request->sampai_tanggal. ' 23:59:59');

        $query['query'] = DB::table('pengeluaran')->whereBetween('tanggal_pengeluaran', [$date['datefrom'], $date['datecurrent']])->get();
        $query['sum'] = DB::table('pengeluaran')->whereBetween('tanggal_pengeluaran', [$date['datefrom'], $date['datecurrent']])->sum('jumlah_pengeluaran');
        $query['total'] = DB::table('uang_kas')->sum('terbayar');
        $query['substract'] = DB::table('pengeluaran')->sum('jumlah_pengeluaran');

        return view('print_laporan_pengeluaran',$query,$date);
    }   
}
