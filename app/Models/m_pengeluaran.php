<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use DB;

class m_pengeluaran extends Model
{
    
    use HasFactory;

    protected $table = 'pengeluaran';
    protected $primaryKey = 'id_pengeluaran';
    public $timestamps = false;

    protected $fillable = [
        'jumlah_pengeluaran',
        'tanggal_pengeluaran',
        'keterangan',
        'user_id',
    ];

    public function index(){
        return DB::table('pengeluaran')->leftJoin('tb_user','tb_user.user_id','=','pengeluaran.user_id')->get(); 
    }
    public function show($id_pengeluaran){
        return DB::table('pengeluaran')
                ->where('id_pengeluaran',$id_pengeluaran)->first();
    }

    public function store($data){
        DB::table('pengeluaran')->create($data);
    }
    
    // public function update($id_pengeluaran,$data){
    //     DB::table('pengeluaran')->where('id_pengeluaran',$id_pengeluaran)->update($data);
    // }

    /*
    public function destroy($id_pengeluaran){
        DB::table('pengeluaran')
            ->where('id_pengeluaran',$id_pengeluaran)
            ->delete();
    }
    */
}
