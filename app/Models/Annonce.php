<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
      'title'  ,
      'description',
    ];
    public function recruteur(){
        return $this->belongsTo(User::class,'user_id');
    }
}
