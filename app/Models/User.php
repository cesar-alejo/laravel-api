<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type_ident',
        'ident',
        'name',
        'email',
        'username',
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

    // Relations

    public function offices()
    {
        return $this->belongsToMany(Office::class)
            ->withPivot('is_default')->withPivot('sign_mech')->withPivot('sign_elec');
    }

    public function defaultOffice()
    {
        return $this->offices()->wherePivot('is_default', true)->first();
    }

    public function getActiveOffice()
    {
        return $this->defaultOffice();
    }

    public function files(): HasMany
    {
        return $this->hasMany(File::class, 'user_id', 'id');
    }

    // Mutators & Casting

    public function name(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => mb_strtoupper(str_replace("|", " ", $value), 'UTF-8'),
            set: fn(string $value) => mb_strtoupper($value, 'UTF-8'),
        );
    }
}
