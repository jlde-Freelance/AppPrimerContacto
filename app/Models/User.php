<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Types\UserProfile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property string name
 * @property string phone
 * @property string email
 * @property UserProfile profile
 * @property string password
 */
class User extends Authenticatable {

    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'profile',
        'password',
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
        'password' => 'hashed',
        'profile' => UserProfile::class
    ];

    /**
     * check if current user is admin
     * @return bool
     */
    public function isAdmin(): bool {
        return $this->profile === UserProfile::ADMIN;
    }

    /**
     * check if current user is a Vigilant
     * @return bool
     */
    public function isVigilant(): bool {
        return $this->profile === UserProfile::VIGILANT;
    }
}
