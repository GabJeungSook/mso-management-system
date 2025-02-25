<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $guarded = [];

    protected $casts = [
        'boolean' => 'is_active',
        'boolean' => 'has_ended'
    ];

    public function fee()
    {
        return $this->hasOne(Fee::class);
    }

    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function penalties()
    {
        return $this->hasMany(Penalty::class);
    }

}
