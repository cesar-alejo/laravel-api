<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FileHistory extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'file_id',
        'user_id',
        'ttr_id',
        'details',
    ];

    public function file(): BelongsTo
    {
        return $this->belongsTo(File::class);
    }
}
