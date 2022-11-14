$getId = DB::table('anggota')
->select('id_anggota')
->get();
$uang_kas = new m_uang_kas;
m_uang_kas::create([
'id_bulan_pembayaran' => $request->id_bulan_pembayaran,
'id_anggota' => $getId->id_anggota,
]);


//duplicate id_bulan_pembayaran
$uang_kas = new m_uang_kas;
m_uang_kas::create([
'id_bulan_pembayaran' => $request->id_bulan_pembayaran
]);
//Get Id_Anggota
$getId = anggota::get();
foreach ($getId as $key => $value)
{
m_uang_kas::create([
'id_anggota' =>$value->id_anggota,
]);
}

$query = DB::table('bulan_pembayaran')
                            ->select('id_bulan_pembayaran')
                            ->get();
                            $tables = new m_uang_kas([
                                'id_bulan_pembayaran' => $query->id_bulan_pembayaran
                            ]);
                            $tables->save();
$status_lunas = 0; //Merge with new value '0' for preventing null input
$terbayar = 0; //Merge with new value '0' for preventing null input
$uang_kas = new m_uang_kas([
'id_anggota' => $inputanggota->id_anggota,
'id_bulan_pembayaran' => $inputbulan_pembayaran->id_bulan_pembayaran,
'status_lunas' => $request->merge(['status_lunas' => $status_lunas]),
'terbayar' => $request->merge(['terbayar' => $terbayar]),
]);


$uang_kas = new m_uang_kas;
$uangkas = m_uang_kas::find($id_anggota,1);
$uang=$uangkas->replicate();
//$request->id_bulan_pembayaran
$uang_kas->save();

$uang_kas = m_uang_kas::insert([
'id_anggota' => $modelAnggota->id_anggota,
'id_bulan_pembayaran' => $modelBulan->id_bulan_pembayaran,
'terbayar' => "0",
'status_lunas' => "0",
]);

//Clipboard 11:56 08/05/2022
//shift id_anggota to m_uang_kas;
$modelAnggota = anggota::sortByDesc("id_anggota")->get()->first();
//shift id_bulan_pembayaran to m_uang_kas;
$modelBulan = m_bulan_pembayaran::sortByDesc("id_bulan_pembayaran")->get()->first();
$uang_kas = m_uang_kas::insert([
'id_anggota' => $modelAnggota->id_anggota,
'id_bulan_pembayaran' => $modelBulan->id_bulan_pembayaran,
'terbayar' => "0",
'status_lunas' => "0",
]);

Clipboard 0:22 11/05/2022
$select = anggota::leftjoin('bulan_pembayaran')
            ->select('anggota.id_anggota','bulan_pembayaran.id_bulan_pembayaran','bulan_pembayaran.created_at','bulan_pembayaran.updated_at')
            ->orderBy('id_anggota','DESC')
            ->orderBy('id_bulan_pembayaran','DESC')->get();
Clipboard 1:19 11/05/2022
$select = DB::table('anggota')->join('bulan_pembayaran','bulan_pembayaran.id_bulan_pembayaran','=','bulan_pembayaran.id_bulan_pembayaran')
->select('anggota.id_anggota','bulan_pembayaran.id_bulan_pembayaran')
->orderBy('id_anggota','DESC')
->orderBy('id_bulan_pembayaran','DESC');


->whereNotIn('id_anggota',function($q){
$q->select('id_anggota')->from('uang_kas');
})
//
$select = DB::table('anggota')
->join('bulan_pembayaran','bulan_pembayaran.id_bulan_pembayaran','=','bulan_pembayaran.id_bulan_pembayaran')
->select('anggota.id_anggota','bulan_pembayaran.id_bulan_pembayaran','bulan_pembayaran.created_at','bulan_pembayaran.updated_at')
->orderBy('id_anggota','DESC')
->orderBy('id_bulan_pembayaran','DESC');


$select = m_uang_kas::select('ag.id_anggota','bp.id_bulan_pembayaran','bp.created_at','bp.updated_at')->join('anggota AS ag','ag.id_anggota','=','uang_kas.id_anggota')->join('bulan_pembayaran AS bp','uang_kas.id_bulan_pembayaran','=','bp.id_bulan_pembayaran')->where('uang_kas.id_bulan_pembayaran','bp.id_bulan_pembayaran',$string)->get();

                    <!--<td><a href="{{--{{route('anggota')}}--}}" class="btn btn-secondary text-light">{{$row->terbayar}}</a></td>-->
                    Clipboard 2:29 17/05/2022
                    $user = User::find(Auth::id());
                    $users = DB::table('tb_user')
                        ->join('anggota', 'anggota.user_id', '=', 'tb_user.user_id')
                        ->get();

SELECT * from anggota WHERE id_anggota NOT IN (SELECT uang_kas.id_anggota from uang_kas LEFT JOIN tb_user ON tb_user.nim = anggota.nim LEFT JOIN bulan_pembayaran ON bulan_pembayaran.id_bulan_pembayaran = uang_kas.id_bulan_pembayaran WHERE uang_kas.id_bulan_pembayaran = 2);