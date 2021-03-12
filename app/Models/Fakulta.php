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
        return $this->hasMany(Prodi::class);
    }
}
