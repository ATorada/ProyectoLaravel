<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    use HasFactory;
}
