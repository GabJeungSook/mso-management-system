<?php

namespace App\Livewire\Admin;

use App\Models\Event;
use Livewire\Component;

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
        dd($this->scannedCode);
    }

    public function render()
    {
        return view('livewire.admin.scan-qr-code');
    }
}
