<?php

namespace App\Models;

use App\Models\Candidature;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
    public function candidatures()
    {
        return $this->hasMany(Candidature::class);
    }
}
