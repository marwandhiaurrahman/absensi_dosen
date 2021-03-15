<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JamKuliah extends Model
{
    use HasFactory;
    protected $fillable = [
        'masuk', 'keluar', 'sks',
    ];
    /**
     * Get all of the comments for the JamKuliah
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'jam', 'id');
    }
}
