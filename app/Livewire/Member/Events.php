<?php

namespace App\Livewire\Member;

use App\Models\Event;
use Livewire\Component;

class Events extends Component
{
    public $events;

    public function mount()
    {
        $this->events = Event::where('is_active', true)->get();
    }

    public function render()
    {
        return view('livewire.member.events');
    }
}
