<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $guarded = [];

    public function fee()
    {
        return $this->belongsTo(Fee::class);
    }
}
