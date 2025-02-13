<?php

namespace App\Livewire\Member;

use App\Models\Event;
use Livewire\Component;
use App\Models\Registration;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;

class EventRegistration extends Component
{
    public $record;

    public function mount($record)
    {
        $this->record = Event::find($record);
    }

    public function preRegister()
    {
        $registration = Registration::create([
            'event_id' => $this->record->id,
            'user_id' => Auth::user()->id,
            'qr_code' => uniqid(),
        ]);

        Notification::make()
        ->title('Saved successfully')
        ->body('You have successfully registered for the event')
        ->success()
        ->send();

    }

    public function render()
    {
        return view('livewire.member.event-registration');
    }
}
