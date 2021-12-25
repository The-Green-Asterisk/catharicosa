<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NPC extends Model
{
    use HasFactory;

    public function notelettes()
    {
        return $this->hasMany(Notelette::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function quests()
    {
        return $this->hasMany(Quest::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
