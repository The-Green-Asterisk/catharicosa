<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quest extends Model
{
    use HasFactory;
    use Search;

    protected $searchable = ['title', 'description'];

    protected $fillable = ['title', 'description', 'user_id', 'npc_id', 'location_id'];

    public function notelettes()
    {
        return $this->morphToMany(Notelette::class, 'noteletteable');
    }

    public function npc()
    {
        return $this->belongsTo(NPC::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(InventoryItem::class);
    }
}
