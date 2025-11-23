<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Berita extends Model
{

    protected $table = 'beritas';
    protected $fillable = [
        'title',
        'thumbnail',
        'content'
    ];


protected static function booted()
{
    static::creating(function ($berita) {
        $berita->slug = Str::slug($berita->title) . '-' . uniqid();
    });

    static::updating(function ($berita) {
        $berita->slug = Str::slug($berita->title) . '-' . uniqid();
    });
}

}
