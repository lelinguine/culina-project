<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use \Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'auth',
        'email',
        'password',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
    * The "booted" method of the model.
    */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->remember_token = \Illuminate\Support\Str::random(10);
        });
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user recipes'
     */
    public function recipes()
    {
        return $this->hasMany(Recipe::class,'user_id');
    }

    /**
     * Get the user comments'
     */
    public function comments()
    {
        return $this->hasMany(Comment::class,'user_id');
    }

    /**
     * Get the user favoris'
     */
    public function favoris()
    {
        return $this->hasMany(Favori::class,'user_id');
    }
}
