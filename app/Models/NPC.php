<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NPC extends Model
{
    use HasFactory;
    use Search;

    protected $searchable = ['name', 'description'];

    protected $fillable = ['name', 'description', 'user_id', 'location_id', 'notebook_id'];

    public function notelettes()
    {
        return $this->morphToMany(Notelette::class, 'noteletteable');
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function quests()
    {
        return $this->hasMany(Quest::class, 'npc_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(InventoryItem::class, 'npc_id');
    }

    public function notebook()
    {
        return $this->belongsTo(Notebook::class);
    }
}
