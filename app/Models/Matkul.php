<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matkul extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','kode','user_id'
    ];
    /**
     * Get the user that owns the Matkul
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dosen()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    /**
     * Get all of the jadwal for the Matkul
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }
}
