<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Event;
use App\Models\Penalty;

class PenaltyReport extends Component
{
    public $event;
    public $events;
    public $selected;
    public $penalties;
    public $total;

    public function mount()
    {
        $this->events = Event::where('has_ended', 1)->get();
        $this->event = Event::where('has_ended', 1)->orderBy('updated_at', 'desc')->first();
        $this->selected = $this->event?->id;
        if($this->event)
        {
            
        $this->penalties = Penalty::where('event_id', $this->event->id)->where('is_paid', 1)->get();
        $this->total = $this->penalties->sum('amount');
        }
            
    }

    public function updatedSelected()
    {
        $this->event = Event::find($this->selected);

        $this->penalties = Penalty::where('event_id', $this->event->id)->where('is_paid', 1)->get();
        $this->total = $this->penalties->sum('amount');
    }

    public function render()
    {
        return view('livewire.admin.penalty-report');
    }
}
