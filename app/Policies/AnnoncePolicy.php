<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Annonce;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnnoncePolicy
{
    use HandlesAuthorization;

    /**
     * Détermine si un utilisateur peut mettre à jour une Annonce.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Annonce  $Annonce
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Annonce $Annonce)
    {
        return $user->id === $Annonce->user_id;
    }

    /**
     * Détermine si un utilisateur peut supprimer une Annonce.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Annonce  $Annonce
     * @return \Illuminate\Auth\Access\Response|bool
     */


    public function delete(User $user, Annonce $Annonce)
    {
        return $user->id === $Annonce->user_id;
    }

    
    public function index(User $user, Annonce $annonce){
        return true;
    }


    public function show(User $user, Annonce $annonce){
        return $user->id=== $annonce->user_id;
    }



    public function create(User $user)
    {
        
        return $user->status==='actif'; 
    }
}

