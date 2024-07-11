<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;

use Carbon\Carbon;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'expiration',
        'details',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function details(): HasMany
    {
        return $this->hasMany(FileDetail::class);
    }

    public function histories(): HasMany
    {
        return $this->hasMany(FileHistory::class);
    }

    public function id(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => str_pad($value, 5, "0", STR_PAD_LEFT)
        );
    }

    public function expiration(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Carbon::parse($value)->format('d/m/Y')
        );
    }
}
