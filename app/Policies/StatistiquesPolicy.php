<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StatistiquesPolicy
{
    use HandlesAuthorization;
  
   
    public function index(User $user)
    {
        
        return $user->role==='admin'; 
    }
}


