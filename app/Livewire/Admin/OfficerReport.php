<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Officer;

class OfficerReport extends Component
{
    public $officers;

    public function mount()
    {
        $this->officers = Officer::all();
    }

    public function render()
    {
        return view('livewire.admin.officer-report');
    }
}
