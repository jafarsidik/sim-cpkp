<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Rekomendasi extends Model
{
    use HasFactory;
    protected $casts = [
        'penilaian_rekomendasi' => 'array'
    ];
}
