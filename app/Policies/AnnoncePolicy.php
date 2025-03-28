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
}
