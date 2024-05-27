<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Absen extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'jam_masuk',
        'jam_telat',
        'jam_keluar',
    ];
}
