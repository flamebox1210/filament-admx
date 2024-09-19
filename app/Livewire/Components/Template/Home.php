<?php

namespace App\Livewire\Components\Template;

use Livewire\Component;

class Home extends Component
{
    public $page;

    public function mount()
    {
        //
    }

    public function render()
    {
        return view('livewire.components.template.home');
    }
}
