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
}
