<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class m_riwayat_pengeluaran extends Model
{
    use HasFactory;
    protected $table = 'riwayat_pengeluaran';
    protected $primaryKey = 'id_riwayat_pengeluaran';

    protected $fillable = [
        'user_id',
        'aksi',
        'tanggal',
    ];
}
