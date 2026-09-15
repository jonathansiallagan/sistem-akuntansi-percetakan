<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cabang extends Model
{
    use HasFactory;

    // Mendaftarkan kolom apa saja yang boleh diisi secara langsung
    protected $fillable = [
        'nama',
        'alamat',
        'no_hp',
        'status',
    ];
}
