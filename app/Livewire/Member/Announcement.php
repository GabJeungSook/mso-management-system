<?php

namespace App\Livewire\Member;

use Livewire\Component;
use App\Models\Announcement as AnnouncementModel;

class Announcement extends Component
{

    public $announcements;

    public function mount()
    {
        $this->announcements = AnnouncementModel::all();
    }

    public function render()
    {
        return view('livewire.member.announcement');
    }
}
