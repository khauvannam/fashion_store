<?php

namespace App\View\Pages;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class Admin extends Component
{
    public function render(): View
    {
        return view('livewire.pages.admin');
    }
}
