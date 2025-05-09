<?php

namespace App\Policies;

use App\Models\Dog;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DogPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Laat alleen zien als de gebruiker is ingelogd
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Dog $dog): bool
    {
        // Alleen de eigenaar kan de hond bekijken
        return $user->id === $dog->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Iedere ingelogde gebruiker mag een hond toevoegen
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Dog $dog): bool
    {
        // Alleen de eigenaar kan de hond bewerken
        return $user->id === $dog->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Dog $dog): bool
    {
        // Alleen de eigenaar kan de hond verwijderen
        return $user->id === $dog->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Dog $dog): bool
    {
        // Alleen de eigenaar kan de hond herstellen
        return $user->id === $dog->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Dog $dog): bool
    {
        // Alleen de eigenaar kan de hond permanent verwijderen
        return $user->id === $dog->user_id;
    }
}
