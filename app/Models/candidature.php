<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class candidature extends Model
{
    use HasFactory;
    protected $fiilable=[
        'cv',
        'lettre_motivation',
        'annonce_id',
    ];
}
