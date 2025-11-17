<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permintaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'telp',
        'judul', 
        'isi', 
        'asal', 
        'instansi',
        'lampiran',
        'is_anonymous',
        'is_secret',
        'status',
    ];
}
