<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\m_pengeluaran;
use App\Models\m_riwayat_pengeluaran;
use App\Models\m_uang_kas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use DB;

class pengeluaranController extends Controller
{
    public function __construct()
    {
        $this->m_pengeluaran = new m_pengeluaran();
    }


    public function pengeluaran() //mengarahkan ke view detail
    {   $this->m_uang_kas = new m_uang_kas();
        $data['contoh'] = $this->m_uang_kas->getSum(); //Get function from m_uang_kas
        $data['substract'] = $this->m_uang_kas->sumPengeluaran();
        $data['title'] = 'Pengeluaran';
        $query = ['query' => $this->m_pengeluaran->index()]; //Membawa variabel 'query' ke view V-pengeluaran
        return view('v_pengeluaran',$data,$query);

    }

    // public function show($id_pengeluaran)
    // {
    //     /*if(!this->m_pengeluaran->detailData($id_pengeluaran))
    //         {abort(404);
    //         }*/
    //     $query = ['query' => $this->m_pengeluaran->show($id_pengeluaran)];
    //     return view ('v_detailpengeluaran', $data);
    // }

    public function tambah_pengeluaran() //Mengarahkan ke view v_tambahpengeluaran
    {
        $this->m_uang_kas = new m_uang_kas();
        $data['contoh'] = $this->m_uang_kas->getSum(); //Get function from m_uang_kas
        $data['substract'] = $this->m_uang_kas->sumPengeluaran();
        $data['title'] = 'Pengeluaran';
        return view('v_tambahpengeluaran',$data);
    }

    public function store()
    {
        Request()->validate([
            'keterangan' => 'required|string|max:255',
            'jumlah_pengeluaran' => 'required|integer|gt:0|max:9999999999',
        ], [
            'jumlah_pengeluaran.required' => 'Jumlah Pengeluaran wajib diisi',
            'jumlah_pengeluaran.integer' => 'Jumlah Pengeluaran hanya bilangan bulat 1,2,3,4..dst!',
            'jumlah_pengeluaran.max' => 'Jumlah Pengeluaran melewati batasan!',
            'jumlah_pengeluaran.gt' =>'Jumlah pengeluaran tidak valid',
            'keterangan.max' => 'Keterangan tidak lebih dari 255 karakter',
            'keterangan.required' => 'Keterangan Pengeluaran wajib diisi !',
            'jumlah_pengeluaran.required' => 'Jumlah Pengeluaran wajib diisi !' ,
        ]);
        //Get Date format
        $epoch      = round(microtime(true)*1000);
        $datetime   = date("Y-m-d H:i:s", substr($epoch,0,10)); 
        $data = ([
            'tanggal_pengeluaran' => $datetime,
            'keterangan' => Request()->keterangan,
            'jumlah_pengeluaran' =>Request()->jumlah_pengeluaran,
            'user_id' => Auth::user()->user_id,
        ]);
        //Also insert relationship to m_riwayat 
        $data2 = ([
            'user_id' => Auth::user()->user_id,
            'aksi'    => 'Sukses menambahkan transaksi pengeluaran sebesar Rp'.number_format(Request()->jumlah_pengeluaran),
            'tanggal' => $datetime,
        ]);
        // $this->m_pengeluaran->store(Request()->$data);
        $insert = m_pengeluaran::create($data);
        $insert = m_riwayat_pengeluaran::create($data2);
        //Insert Relationship
        return redirect()->route('pengeluaran')->with('success', 'Data berhasil ditambahkan !');  
    }
    /*
    public function ubah_pengeluaran($id_pengeluaran)
    {
        if (!$this->m_pengeluaran->detailData($id_pengeluaran)) {
            abort(404);
        }

        $data = [
            'pengeluaran' => $this->m_pengeluaran->detailData($id_pengeluaran)
        ];
        return view('v_ubahpengeluaran', $data);
    }  
    */  

    public function update(Request $request,$id_pengeluaran){
            $request->validate([
            'keterangan' => 'required|string|max:255',
            'jumlah_pengeluaran' => 'integer|gte:0|max:9999999999',
        ], [
            'jumlah_pengeluaran.max' => 'Jumlah Pengeluaran melewati batasan!',
            'jumlah_pengeluaran.gte' => 'Jumlah pengeluaran tidak valid',


            'keterangan.required' => 'Keterangan Pengeluaran wajib diisi !',            'jumlah_pengeluaran.required' => 'Jumlah Pengeluaran wajib diisi !' ,
            'keterangan.max' => 'Keterangan terbatas hingga 255 karakter'
        ]);
        $model = m_pengeluaran::query()->where('id_pengeluaran',$id_pengeluaran)->update([
            'jumlah_pengeluaran' => $request->jumlah_pengeluaran,
            'keterangan' => $request->keterangan,
        ]);
        //riwayat pengeluaran
        $epoch      = round(microtime(true)*1000);
        $datetime   = date("Y-m-d H:i:s", substr($epoch,0,10)); 
        $data = ([
            'user_id' => Auth::user()->user_id,
            'aksi'    => 'Perubahan transaksi pengeluaran sebesar Rp'.number_format($request->jumlah_pengeluaran),
            'tanggal' => $datetime,
                                    ]);
        $insert = m_riwayat_pengeluaran::create($data);

        return redirect()->route('pengeluaran')->with('pesan', 'Data berhasil diupdate !');  
    }
    // public function ubah($id_pengeluaran,$data)
    // {
    //     Request()->validate([
    //         //   'user_id' => 'required',
    //            'tanggal_pengeluaran' => 'required',
    //            'keterangan' => 'required',
    //            'jumlah_pengeluaran' => 'required'
    //        ], [
    //           // 'user.id' =>
    //           'tanggal_pengeluaran.required' => 'ass',
    //            'keterangan.required' => 'Keterangan Pengeluaran wajib diisi !',
    //            'jumlah_pengeluaran.required' => 'Jumlah Pengeluaran wajib diisi !' 
    //        ]);
    //        $data= new m_pengeluaran([
    //            //'user_id' => Request()-> user_id,
    //            'tanggal_pengeluaran' => Request()->tanggal_pengeluaran,
    //            'keterangan' => Request()->keterangan,
    //            'jumlah_pengeluaran' => Request()->jumlah_pengeluaran
    //        ]);
    //        $this->m_pengeluaran->update($id_pengeluaran, $data);
    //        return redirect()->route('pengeluaran')->with('pesan', 'Data berhasil diupdate !');  
    // }


    public function destroy($id_pengeluaran)
    {
        $id = m_pengeluaran::find($id_pengeluaran);
        $id->delete();
        return redirect()->route('pengeluaran')->with('success', 'Data berhasil dihapus!');
    }
    
}
