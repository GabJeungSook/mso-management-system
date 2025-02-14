<?php

namespace App\Livewire\Member;

use App\Models\Event;
use Livewire\Component;
use App\Models\Registration;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;


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

    public function downloadQrCode()
    {
        $user = auth()->user();
        $qrData = $user->registrations()->where('user_id', $user->id)->first()->qr_code;

        // Generate QR Code URL
        $qrUrl = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={$qrData}";

        // Fetch the QR code image
        $response = Http::get($qrUrl);

        if ($response->successful()) {
            $fileName = "qr-code.png";

            return response()->streamDownload(function () use ($response) {
                echo $response->body();
            }, $fileName, ['Content-Type' => 'image/png']);
        }
    }

    public function render()
    {
        return view('livewire.member.event-registration');
    }
}
