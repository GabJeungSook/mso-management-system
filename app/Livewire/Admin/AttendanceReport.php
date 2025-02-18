<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Event;
use App\Models\Attendance;


class AttendanceReport extends Component
{
    public $event;
    public $events;
    public $selected;
    public $attendances;

    public function mount()
    {
        $this->events = Event::where('has_ended', 1)->get();
        $this->event = Event::where('has_ended', 1)->orderBy('updated_at', 'desc')->first();
        $this->selected = $this->event?->id;
        if($this->event)
        {
        $this->attendances = Attendance::whereHas('registration', function ($query) {
            $query->where('event_id', $this->selected);
        })->get();
        }else{
            $this->attendances = Attendance::all();
        }
    }

    public function updatedSelected()
    {
        $this->event = Event::find($this->selected);

        $this->attendances = Attendance::whereHas('registration', function ($query) {
            $query->where('event_id', $this->event->id);
        })->get();
    }


    public function render()
    {
        return view('livewire.admin.attendance-report');
    }
}
