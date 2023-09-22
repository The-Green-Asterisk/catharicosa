<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'ddb',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function locations()
    {
        return $this->hasMany(Location::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function notelettes()
    {
        return $this->hasMany(Notelette::class);
    }

    public function npcs()
    {
        return $this->hasMany(NPC::class);
    }

    public function quests()
    {
        return $this->hasMany(Quest::class);
    }

    public function items()
    {
        return $this->hasMany(InventoryItem::class);
    }

    public function notebooks()
    {
        return $this->hasMany(Notebook::class);
    }
}
