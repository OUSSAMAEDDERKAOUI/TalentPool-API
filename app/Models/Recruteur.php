<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recruteur extends Model
{
    use HasFactory;
    protected  $fillable=[
        'user_id',
        'company',
        'poste',
        'sector',
        'city'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
