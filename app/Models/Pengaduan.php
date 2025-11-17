<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduans';

    protected $fillable = [
        'name',
        'email',
        'telp',
        'judul',
        'isi',
        'tanggal_pengaduan',
        'lokasi',
        'instansi',
        'lampiran',
        'is_anonymous',
        'is_secret',
        'status',
    ];
}
