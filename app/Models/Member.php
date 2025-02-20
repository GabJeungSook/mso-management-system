<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function officer()
    {
        return $this->hasOne(Officer::class);
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class, 'user_id');
    }

    public function penalties()
    {
        return $this->hasMany(Penalty::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
