<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Auth\MustVerifyEmail; // <-- Email verification mate jaroori

class User extends Authenticatable implements MustVerifyEmail // <-- MustVerifyEmail interface add karyo
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo_path',
        'role', // Role pan fillable hovo jaroori chhe
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be appended to the model's array form.
     * *** MUKHYA SUDHARO AHIYA CHHE ***
     * Aa line tamara profile_photo_url ne hamesha available rakhe chhe.
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * The attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Accessor: Get the full URL of the user's profile photo.
     */
    public function getProfilePhotoUrlAttribute(): string
    {
        if ($this->profile_photo_path && Storage::disk('public')->exists($this->profile_photo_path)) {
            // Returns /storage/profile-photos/....
            return Storage::url($this->profile_photo_path);
        }

        // Default avatar jo photo na hoy to
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=22c55e&color=fff&size=128';
    }
}