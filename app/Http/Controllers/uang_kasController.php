<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\m_bulan_pembayaran;
use App\Models\m_uang_kas;
use App\Models\anggota;
use App\Models\m_riwayat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use DB;


class uang_kasController extends Controller
{
    public function tambahBulan() //mengarahkan ke view tambah_bulan
    { 
        $this->m_uang_kas   = new m_uang_kas();
        $data['contoh']     = $this->m_uang_kas->getSum(); //Get function from m_uang_kas
        $data['substract']  = $this->m_uang_kas->sumPengeluaran();
        $data['dropdown']   = ['januari','februari','maret','april','mei','juni','juli','agustus','september','oktober','november','desember'];
        $data['title']      = 'Tambah';
        if (Auth::check()) {
        //check the user has login
        return view('tambah_bulan',$data);
        }
        else return
        redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
    }
    public function showDetails($id_bulan_pembayaran) //
    {
        $this->m_uang_kas = new m_uang_kas();

        $data['contoh'] = $this->m_uang_kas->getSum(); //Get function from m_uang_kas
        $data['substract'] = $this->m_uang_kas->sumPengeluaran();
        $data['title'] = 'Detail Uang Kas';
       
        //Check user has login
        if (Auth::check()){
            $decrypt = Crypt::decryptString($id_bulan_pembayaran);
            $query   = m_uang_kas::where('id_bulan_pembayaran',$decrypt)->orderBy('id_anggota','ASC')->get();
            //get title for Header selected month
            $judul   = m_uang_kas::join('bulan_pembayaran','bulan_pembayaran.id_bulan_pembayaran','=','uang_kas.id_bulan_pembayaran')
                    ->join('anggota','anggota.id_anggota','=','uang_kas.id_anggota')
                    ->where('uang_kas.id_bulan_pembayaran',$decrypt)->get()->take(1); 
            $data['newAnggota'] = DB::table('anggota')->leftJoin('tb_user','tb_user.nim','=','anggota.nim')
                                ->whereNotIn('id_anggota', function($q) use($decrypt){
                                    $q->select('id_anggota')
                                    ->from('uang_kas')
                                    ->leftJoin('bulan_pembayaran','bulan_pembayaran.id_bulan_pembayaran','=','uang_kas.id_bulan_pembayaran')
                                    ->where('uang_kas.id_bulan_pembayaran', $decrypt);
                                })->get();
                        /****************SQL QUERY****************/
            /*SELECT * from anggota LEFT JOIN tb_user ON tb_user.nim = anggota.nim WHERE id_anggota NOT IN (SELECT uang_kas.id_anggota from uang_kas LEFT JOIN tb_user ON tb_user.nim = anggota.nim LEFT JOIN bulan_pembayaran ON bulan_pembayaran.id_bulan_pembayaran = uang_kas.id_bulan_pembayaran WHERE uang_kas.id_bulan_pembayaran = $decrypt); */

            $DBuangKas = m_uang_kas::leftjoin('bulan_pembayaran','bulan_pembayaran.id_bulan_pembayaran','=','uang_kas.id_bulan_pembayaran')
                                    ->leftjoin('anggota','anggota.id_anggota','=','uang_kas.id_anggota')
                                    ->where([
                                        ['uang_kas.id_bulan_pembayaran',$decrypt],
                                        ['anggota.nim','<>','11111111']
                                        ])->get();
            //
            return view('detail_uang_kas',$data, compact('query','judul','DBuangKas'));
            }
            else return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');

    }
    public function insert_anggota( Request $request, $id_bulan_pembayaran)
    {
        $decrypt = Crypt::decryptString($id_bulan_pembayaran);
        $data = DB::table('anggota')->leftJoin('tb_user','tb_user.nim','=','anggota.nim')
            ->whereNotIn('id_anggota', function($q) use($decrypt){
                $q->select('id_anggota')->from('uang_kas')->leftJoin('bulan_pembayaran','bulan_pembayaran.id_bulan_pembayaran','=','bulan_pembayaran.id_bulan_pembayaran')->where('uang_kas.id_bulan_pembayaran', $decrypt);
            })->get();
            $data = m_uang_kas::insertUsing(['id_anggota','id_bulan_pembayaran','created_at','updated_at'],$data);
        // return $request->except('_token');
        // $insert->nim = $request->nim;
        // $insert->id_anggota = $data->anggota;
        // $insert->name = $data->name;
        // $insert->id_bulan_pembayaran = $decrypt;
        // $insert->save();
                /*
                SQL UPDATE TABLE '0' prevent NULL m
                */
            // m_uang_kas::query()->where('id_anggota',$insert->id_anggota)->update([
            //     'terbayar' => "0",
            //     'status_lunas' => "0",
            // ]);
    }
    public function index() //mengarahkan ke view uang_kas
    {
        $query = DB::table('bulan_pembayaran')
                ->select('id_bulan_pembayaran','nama_bulan','tahun','nominal_bulanan')
                ->get();
        return view('uang_kas', compact('query'));
    }
    
    public function action_bulan_pembayaran(Request $request)
    {
        $this->m_bulan_pembayaran = new m_bulan_pembayaran;

        $bulanbayar = strtolower($request->nama_bulan);
        $anggota = $request->id_anggota;
        $bulan_pembayaran = DB::table('bulan_pembayaran')->where('nama_bulan', $bulanbayar)->first();        
        $tahun_pembayaran = DB::table('bulan_pembayaran')->where('nama_bulan', $bulanbayar)->where('tahun',$request->tahun)->first();
        // $uang_kas = DB::table('anggota')->where('id_anggota',$anggota)->first();       

        // $data = $bulan_pembayaran[0]->nama_bulan;
            if($bulan_pembayaran == null )
            {
                $validator = Validator::make($request->all(),[
                    'nama_bulan' => 'required',
                    'tahun' => 'integer|min:1000',
                    'nominal_bulanan' => 'integer|min:1000',
                ]); 
            m_bulan_pembayaran::create($validator->validated());
            //-----SQL Query------
            $DBbulanPembayaran = m_bulan_pembayaran::select('id_bulan_pembayaran')->orderBy('id_bulan_pembayaran','DESC')->get()->first();
            $string= array($DBbulanPembayaran->id_bulan_pembayaran);
            $select = DB::table('anggota')
            ->select('anggota.id_anggota','bulan_pembayaran.id_bulan_pembayaran','bulan_pembayaran.created_at','bulan_pembayaran.updated_at')
            ->leftJoin('bulan_pembayaran','bulan_pembayaran.id_bulan_pembayaran','=','bulan_pembayaran.id_bulan_pembayaran')
            ->where('bulan_pembayaran.id_bulan_pembayaran', $string);
            /*
            SQL INSERT INTO SELECT
            */
            m_uang_kas::insertUsing(['id_anggota','id_bulan_pembayaran','created_at','updated_at'],$select);
            /*
            SQL UPDATE TABLE '0' to prevent NULL 
            */
            m_uang_kas::query()->where('id_bulan_pembayaran',$string)->update([
             'terbayar' => "0",
             'status_lunas' => "0",
            ]);
            
                return redirect()->route('uang_kas')->with('success','Bulan pembayaran berhasil ditambahkan');
                }    
/* ELSE IF*/else if($tahun_pembayaran == null )
            {   
                $validator = Validator::make($request->all(),[
                    'nama_bulan' => 'required',
                    'tahun' => 'integer|min:1000',
                    'nominal_bulanan' => 'integer|min:1000',
                ]); 
            m_bulan_pembayaran::create($validator->validated());
            //-----SQL Query------
            $DBbulanPembayaran = m_bulan_pembayaran::select('id_bulan_pembayaran')->orderBy('id_bulan_pembayaran','DESC')->get()->first();
            $string= array($DBbulanPembayaran->id_bulan_pembayaran);
            $select = DB::table('anggota')
            ->select('anggota.id_anggota','bulan_pembayaran.id_bulan_pembayaran','bulan_pembayaran.created_at','bulan_pembayaran.updated_at')
            ->leftJoin('bulan_pembayaran','bulan_pembayaran.id_bulan_pembayaran','=','bulan_pembayaran.id_bulan_pembayaran')
            ->where('bulan_pembayaran.id_bulan_pembayaran', $string);
            /*
            SQL INSERT INTO SELECT
            */
            m_uang_kas::insertUsing(['id_anggota','id_bulan_pembayaran','created_at','updated_at'],$select);
            /*
            SQL UPDATE TABLE '0' prevent NULL m
            */
            m_uang_kas::query()->where('id_bulan_pembayaran',$string)->update([
             'terbayar' => "0",
             'status_lunas' => "0",
            ]);
                return redirect()->route('uang_kas')->with('success','Bulan pembayaran berhasil ditambahkan');
            }else
                return redirect()->route('tambah_bulan')->with('error','Bulan tidak boleh sama');
    }
    public function uang_kas_action($id_uang_kas) //Update detail_uang_kas
    {
        $sql = DB::table('bulan_pembayaran')
                    ->join('uang_kas','uang_kas.id_bulan_pembayaran','=','bulan_pembayaran.id_bulan_pembayaran')
                    ->join('anggota','anggota.id_anggota','=','uang_kas.id_anggota')
                    ->where('uang_kas.id_uang_kas',$id_uang_kas)->first();
        Request()->validate([
            'terbayar' => 'integer',
        ]);
        $input = Request()->terbayar;
        //Condition if request <= value
        if($input <= $sql->nominal_bulanan){
        //Insert to database
            m_uang_kas::where('id_uang_kas',$id_uang_kas)->update([
                'terbayar' => $input,
                'status_lunas' => '0',
            ]);
        //Also insert relationship to m_riwayat
        //Get date format
        $epoch      = round(microtime(true)*1000);
        $datetime   = date("Y-m-d H:i:s", substr($epoch,0,10)); 
        $riwayat    = m_riwayat::create([
            'user_id'     => Auth::user()->user_id,
            'aksi'        => 'Transaksi masuk sebesar Rp'.number_format(Request()->terbayar). '/'.$sql->nominal_bulanan .' dari '. $sql->name,
            'id_uang_kas' => Request()->id_uang_kas,
            'tanggal'     => $datetime,
                                    ]);
            //Condition if request == value
            if($input == $sql->nominal_bulanan){
                m_uang_kas::where('id_uang_kas',$id_uang_kas)->update([
                    'terbayar' => $input,                    
                    'status_lunas'  => 1,
                ]);
                //Also insert relationship to m_riwayat
                //Get date format
                $riwayat = m_riwayat::create([
                    'user_id'       => Auth::user()->user_id,
                    'aksi'          => 'HOREEE '.$sql->name. ' pada bulan ini sudah LUNAS!',
                    'id_uang_kas'   => Request()->id_uang_kas,
                    'tanggal'       => $datetime,
                ]);
                }
            return redirect()->route('detail_uang_kas',Request()->id_bulan_pembayaran)->with('success','Input berhasil ditambahkan sebesar Rp'.number_format($input));
        }
        else
            return redirect()->route('detail_uang_kas',Request()->id_bulan_pembayaran)->with('error',
            'Input melebihi batas nominal yang telah ditentukan'); 
        /*
        //Get date format
        $datetime = date("Y-m-d H:i:s");
        //Also insert relationship to m_riwayat 
        $riwayat = m_riwayat::create([
            'user_id' => Auth::user()->user_id,
            'aksi'    => 'Sukses merubah transaksi sebesar Rp'.number_format($request->terbayar),
            'id_uang_kas' => $request->id_uang_kas,
            'tanggal' => $datetime,
        ]);
        return redirect()->route('detail_uang_kas',$request->id_bulan_pembayaran)->with('success','Input berhasil ditambahkan');
        */
    }
    public function destroy($id_bulan_pembayaran)
    {
        $bulan = m_bulan_pembayaran::find($id_bulan_pembayaran)
                                    ->leftjoin('uang_kas', 'uang_kas.id_bulan_pembayaran','=','bulan_pembayaran.id_bulan_pembayaran')
                                    ->where('bulan_pembayaran.id_bulan_pembayaran',$id_bulan_pembayaran);
        m_uang_kas::where('id_bulan_pembayaran', $id_bulan_pembayaran)->delete();
        
        $bulan->delete();
        return redirect()->route('uang_kas')
                        ->with('success','Bulan pembayaran berhasil dihapus');
    }
}