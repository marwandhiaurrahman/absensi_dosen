<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fakulta extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'kode'
    ];
    /**
     * Get all of the comments for the Fakulta
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prodi()
    {
        return $this->hasMany(Prodi::class, 'fakultas_id', 'id');
    }
    public function kelas()
    {
        return $this->hasManyThrough(
            Kelas::class,
            Prodi::class,
            'prodi_id',
            'fakultas_id',
            'id',
            'id'
        );
    }
}
