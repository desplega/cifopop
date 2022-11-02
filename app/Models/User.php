<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'city',
        'phone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function noRoles(): Collection
    {
        return Role::all()->diff($this->roles);
    }

    /**
     * Checks if user has one of the provided roles
     *
     * @param  string|array  $roles
     * @return boolean
     */
    public function hasRole(string|array $roles): bool
    {
        if (!is_array($roles))
            $roles = [$roles];

        foreach ($roles as $role) {
            if ($this->roles->pluck('role')->contains($role))
                return true;
        }

        return false;
    }

    public function adverts()
    {
        return $this->hasMany(Advert::class);
    }

    public function isAdmin()
    {
        return $this->hasRole('Administrator');
    }

    public function isEditor()
    {
        return $this->hasRole('Editor');
    }

    public function isBlocked()
    {
        return $this->hasRole('Blocked');
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    public function getOffer(int $advert_id): ?int
    {
        return $this->offers
            ->where('advert_id', $advert_id)
            ->first()
            ?->id;
    }
}
