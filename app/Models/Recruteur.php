<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class recruteur extends Model
{
    use HasFactory;
    protected  $fillable=[
        'user_id',
        'company ',
        'poste ',
        'sector ',
        'city '
    ];
}
