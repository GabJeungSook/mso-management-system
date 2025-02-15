<?php

namespace App\Livewire\Member;

use Livewire\Component;
use App\Models\Penalty;
use Illuminate\Support\Facades\Auth;

class MemberPenalties extends Component
{
    public $penalties;

    public function mount()
    {
        $this->penalties = Penalty::whereHas('member', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->where('is_paid', false)->get();

    }

    public function render()
    {
        return view('livewire.member.member-penalties');
    }
}
