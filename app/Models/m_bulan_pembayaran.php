<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class m_bulan_pembayaran extends Model
{
    use HasFactory;
    protected $table = 'bulan_pembayaran';
    protected $primaryKey = 'id_bulan_pembayaran';


    protected $fillable = [
        'nama_bulan',
        'tahun',
        'nominal_bulanan',
    ];
    // public function get_bulan_by()
    // {
    //     $query = DB::table('bulan_pembayaran');
    //     return $query;
    // }
}
