<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $table = 'ruangans';
    protected $fillable = ['name', 'image'];

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }
}
