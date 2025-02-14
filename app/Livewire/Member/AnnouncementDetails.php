<?php

namespace App\Livewire\Member;

use App\Models\Announcement;
use Livewire\Component;

class AnnouncementDetails extends Component
{
    public $record;

    public function mount($record)
    {
        $this->record = Announcement::find($record);
    }

    public function render()
    {
        return view('livewire.member.announcement-details');
    }
}
