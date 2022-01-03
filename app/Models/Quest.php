<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quest extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'user_id'];

    public function notelettes()
    {
        return $this->hasMany(Notelette::class);
    }

    public function npc()
    {
        return $this->belongsTo(NPC::class);
    }

    public function locations()
    {
        return $this->hasMany(Location::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
