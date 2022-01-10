<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notelette extends Model
{
    use HasFactory;
    use Search;

    protected $searchable = ['body'];

    protected $fillable = ['body', 'user_id', 'note_id', 'n_p_c_id', 'quest_id', 'location_id', 'inventory_item_id'];

    public function location()
    {
        return $this->morphedByMany(Location::class, 'noteletteable');
    }

    public function note()
    {
        return $this->morphedByMany(Note::class, 'noteletteable');
    }

    public function npc()
    {
        return $this->morphedByMany(NPC::class, 'noteletteable');
    }

    public function quest()
    {
        return $this->morphedByMany(Quest::class, 'noteletteable');
    }

    public function item()
    {
        return $this->morphedByMany(InventoryItem::class, 'noteletteable');
    }
}
