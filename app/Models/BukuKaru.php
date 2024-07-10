<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class BukuKaru extends Model
{
    use HasFactory;
    use HasRoles;
    protected $casts = [
        'sub_kompetensi_dan_kode' => 'array'
    ];
}
