<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;

class Location extends Model
{
    use HasFactory;
    use SpatialTrait;

    protected $fillable = [
        'name','validasi'
    ];

    protected $spatialFields = [
        'location',
    ];
}
