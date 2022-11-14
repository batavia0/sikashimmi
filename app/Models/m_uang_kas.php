<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\m_pengeluaran;
use DB;

class m_uang_kas extends Model
{
    use HasFactory;
    protected $table = 'uang_kas';
    protected $primaryKey = 'id_uang_kas';

    protected $fillable = [
        'id_anggota',
        'id_bulan_pembayaran',
        'terbayar',
        'status_lunas',
    ];
    public function getSum(){
        return DB::table('uang_kas')->sum('terbayar'); //Menghitung jumlah semua field TErbayar
    }
    public function SumPengeluaran(){
        return DB::table('pengeluaran')->sum('jumlah_pengeluaran'); //Menghitung jumlah semua field jumlah pengeluaran
    }
}
