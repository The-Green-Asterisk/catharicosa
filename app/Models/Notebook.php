<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notebook extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'user_id'];

    public function items()
    {
        $this->hasMany(InventoryItem::class);
    }

    public function locations()
    {
        $this->hasMany(Location::class);
    }

    public function notes()
    {
        $this->hasMany(Note::class);
    }

    public function npcs()
    {
        $this->hasMany(NPC::class);
    }

    public function quests()
    {
        $this->hasMany(Quest::class);
    }
}
