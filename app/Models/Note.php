<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    use Search;

    protected $searchable = ['title', 'body'];

    protected $fillable = ['title', 'body', 'user_id'];

    public function notelettes()
    {
        return $this->morphToMany(Notelette::class, 'noteletteable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
