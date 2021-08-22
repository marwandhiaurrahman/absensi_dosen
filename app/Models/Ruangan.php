<?php

namespace App\Models;

use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;
    use SpatialTrait;

    protected $fillable = [
        'name',
        'lantai',
        'kode',
        'gedung_id',
    ];
    protected $spatialFields = [
        'location',
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
