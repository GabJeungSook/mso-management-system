<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Member;

class MemberReport extends Component
{
    public $members;

    public function mount()
    {
        $this->members = Member::whereDoesntHave('officer')->get();
    }

    public function render()
    {
        return view('livewire.admin.member-report');
    }
}
