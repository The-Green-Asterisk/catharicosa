<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'user_id'];

    public function notelettes()
    {
        return $this->morphToMany(Notelette::class, 'noteletteable');
    }

    public function npcs()
    {
        return $this->hasMany(NPC::class);
    }

    public function quests()
    {
        return $this->hasMany(Quests::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
