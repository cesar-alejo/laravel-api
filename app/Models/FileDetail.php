<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FileDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_id',
        'user_id',
        'name',
        'mime_type',
        'extension',
        'size',
        'path',
        'disk'
    ];

    public function file(): BelongsTo
    {
        return $this->belongsTo(File::class);
    }
}
