<?php

namespace App\Livewire\Admin;

use App\Models\Event;
use App\Models\Registration;
use App\Models\Attendance;
use Livewire\Component;
use Filament\Notifications\Notification;

class ScanQrCode extends Component
{
    public $event;
    public $scannedCode;

    public function mount()
    {
        $this->event = Event::where('is_active', 1)->first();
    }

    public function saveAttendance()
    {
        $code = trim($this->scannedCode);
        $registration = Registration::where('qr_code', $code)->first();
        if($registration)
        {
            $existing = Attendance::where('registration_id', $registration->id)->first();
            if(!$existing)
            {
                $attendance = Attendance::create([
                    'registration_id' => $registration->id,
                    'status' => 'PRESENT'
                ]);
    
                $this->scannedCode = null;
    
                Notification::make()
                ->success()
                ->title('Success')
                ->body('QR Code scanned successfully')
                ->send();
            }else{
                $this->scannedCode = null;

                Notification::make()
                ->danger()
                ->title('Oops')
                ->body('Member already attended')
                ->send();
            }
           

        }else{
            $this->scannedCode = null;

            Notification::make()
            ->danger()
            ->title('Oops')
            ->body('QR Code does not exist')
            ->send();
        }
    }

    public function render()
    {
        return view('livewire.admin.scan-qr-code');
    }
}
