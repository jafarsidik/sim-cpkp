<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class ProfilPerawat extends Model
{
    use HasFactory;
    use HasRoles;
    protected $casts = [
        'orientasi' => 'array',
        'cpd' => 'array',
        'cpd_pk_1' => 'array',
        'cpd_pk_2' => 'array',
        'cpd_pk_3' => 'array',
        'cpd_pk_4' => 'array',
        'cpd_pk_5' => 'array',
        'setuju' => 'boolean',
    ];
}
