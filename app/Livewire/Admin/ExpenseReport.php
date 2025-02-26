<?php

namespace App\Livewire\Admin;

use App\Models\Event;
use App\Models\Expense;
use Livewire\Component;

class ExpenseReport extends Component
{
    public $event;
    public $events;
    public $selected;
    public $expenses;
    public $total;

    public function mount()
    {
        $this->events = Event::get();
        $this->event = Event::where('is_active', true)->orderBy('updated_at', 'desc')->first();
        $this->selected = $this->event?->id;
        if($this->event)
        {
        $this->expenses =  Expense::whereHas('fee', function($query){
            $query->where('event_id', $this->event->id);
        })->get();
        }else{
            $this->expenses = Expense::get();
        }
    $this->total = $this->expenses->sum('amount');

    }
    public function render()
    {
        return view('livewire.admin.expense-report');
    }
}
