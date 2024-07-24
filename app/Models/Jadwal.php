<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwal';

    protected $fillable = [
        'nama_acara', 
        'nama_organisasi', 
        'tanggal_mulai', 
        'tanggal_selesai', 
        'surat', 
        'ruangan_id', 
        'user_id', 
        'status,'
    ];

    public function ruangan()
    {
        return $this->belongsTo(Room::class);
    }
}
