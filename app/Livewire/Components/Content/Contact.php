<?php

namespace App\Livewire\Components\Content;

use Livewire\Component;

class Contact extends Component
{
    public $query;
    public $data;

    public function mount()
    {
        $this->data = $this->query['data'];
    }

    public function render()
    {
        return view('livewire.components.content.contact');
    }
}
