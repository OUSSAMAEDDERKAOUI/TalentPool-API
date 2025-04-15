<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Candidature extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'cv',
        'lettre_motivation',
        'annonce_id',
        'status',
    ];

    public function candidat()
    {
        return $this->belongsTo(User::class, 'user_id'); 
    }
    
    public function annonce()
    {
        return $this->belongsTo(Annonce::class);
    }
    

    
    
   
}
