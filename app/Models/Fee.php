<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    protected $guarded = [];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    public function expensesRelation()
    {
        return $this->hasMany(Expense::class);
    }

    public function expenses_relation()
    {
        return $this->hasMany(Expense::class);
    }

    public function getExpenseTotalAttribute()
    {
        return $this->expenses()->sum('amount');
    }
}
