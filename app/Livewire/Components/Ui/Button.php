<?php

namespace App\Livewire\Components\Ui;

use Livewire\Component;

class Button extends Component
{
    public $type;
    public $url;
    public $target = null;
    public $label;

    public function mount()
    {
        //
    }

    public function render()
    {
        return view('livewire.components.ui.button');
    }
}
