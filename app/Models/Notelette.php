<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notelette extends Model
{
    use HasFactory;

    protected $fillable = ['body', 'user_id', 'note_id', 'n_p_c_id', 'quest_id', 'location_id', 'inventory_item_id'];

    public function note()
    {
        return $this->belongsTo(Note::class);
    }

    public function npcs()
    {
        return $this->belongsToMany(NPC::class);
    }

    public function quests()
    {
        return $this->belongsToMany(Quest::class);
    }

    public function locations()
    {
        return $this->belongsToMany(Location::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
