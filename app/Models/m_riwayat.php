<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class m_riwayat extends Model
{
    use HasFactory;
    protected $table = 'riwayat';
    protected $primaryKey = 'id_riwayat';

    protected $fillable = [
        'user_id',
        'id_uang_kas',
        'aksi',
        'tanggal',
    ];

}
