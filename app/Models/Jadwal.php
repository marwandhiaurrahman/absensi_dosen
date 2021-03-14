<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;
    protected $fillable = [
        'hari','jam','kelas_id','matkul_id','ruangan_id',
    ];

    /**
     * Get the matkul that owns the Jadwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function matkul()
    {
        return $this->belongsTo(Matkul::class);
    }
}
