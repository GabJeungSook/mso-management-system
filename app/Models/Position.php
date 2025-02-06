<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $guarded = [];

    public function officer()
    {
        return $this->hasOne(Officer::class);
    }
}
