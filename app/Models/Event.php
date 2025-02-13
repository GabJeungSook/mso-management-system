<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $guarded = [];

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
}
