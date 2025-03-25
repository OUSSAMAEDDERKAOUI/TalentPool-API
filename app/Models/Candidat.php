<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidat extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'bio',
        'fonction',
        'niveau',
        'experience'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
