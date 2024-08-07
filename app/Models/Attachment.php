<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'file_type',
        'file_size',
        'mime_type',
        'file_path',
        'file_name',
        'disk',
    ];

    public function attachable(): BelongsTo
    {
        return $this->morphTo();
    }
}
