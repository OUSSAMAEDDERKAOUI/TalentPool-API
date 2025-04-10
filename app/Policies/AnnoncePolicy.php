<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Annonce;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Log;

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


    // app/Policies/AnnoncePolicy.php
public function delete(User $user, Annonce $annonce)
{
    // Vérifie si l'utilisateur connecté est celui qui a créé l'annonce
    return $user->id === $annonce->user_id;
}


    
    public function index(User $user){
        return true;
    }


    public function show(User $user, Annonce $annonce){
        return $user->id=== $annonce->user_id;
    }




}