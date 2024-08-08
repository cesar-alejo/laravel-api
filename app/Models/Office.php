<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory;



    public function users()
    {
        //return $this->belongsToMany(User::class, 'user_office_table');
        return $this->belongsToMany(User::class)
            ->withPivot('is_default')->withPivot('sign_mech')->withPivot('sign_elec');
    }
}
