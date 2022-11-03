<?php

namespace App\Policies;

use App\Models\Offer;
use App\Models\User;
use App\Models\Advert;
use Illuminate\Auth\Access\HandlesAuthorization;

class OfferPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Offer $offer)
    {
        return $user->isAdmin() || $user->isEditor() || $user->id === $offer->advert->user->id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user, Advert $advert)
    {
        return $user->id != $advert->user_id;
    }

    /**
     * Determine whether the user can cancel the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function cancel(User $user, Offer $offer)
    {
        return $user->id == $offer->user_id;
    }

    /**
     * Determine whether the user can accept the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function accept(User $user, Offer $offer)
    {
        return $user->id === $offer->advert->user->id;
    }

    /**
     * Determine whether the user can reject the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function reject(User $user, Offer $offer)
    {
        return $user->id ===  $offer->advert->user->id;
    }
}
