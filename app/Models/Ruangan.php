<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'lantai',
        'kode',
        'gedung_id',
    ];
    public function gedung()
    {
        return $this->belongsTo(Gedung::class);
    }
    public function jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }
}
