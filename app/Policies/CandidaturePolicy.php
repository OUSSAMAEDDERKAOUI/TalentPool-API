<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Candidature;
use Illuminate\Auth\Access\HandlesAuthorization;

class CandidaturePolicy
{
    use HandlesAuthorization;

    /**
     * Détermine si un utilisateur peut mettre à jour une candidature.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Candidature  $candidature
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Candidature $candidature)
    {
        return $user->id === $candidature->user_id;
    }

    /**
     * Détermine si un utilisateur peut supprimer une candidature.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Candidature  $candidature
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Candidature $candidature)
    {
        return $user->id === $candidature->user_id;
    }


    public function index(User $user){
        return true;
    }
    public function show(User $user, Candidature $candidature){
        return $user->id=== $candidature->user_id;
    }



    public function create(User $user)
    {
        
        return $user->status==='actif'; 
    }
}
