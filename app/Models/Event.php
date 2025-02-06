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
}
