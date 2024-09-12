<?php

namespace App\Livewire;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class Index extends Component
{
    /**
     * @return void
     */
    public function mount()
    {

    }

    /**
     * @return Factory|View|Application
     */
    public function render()
    {
        return view('livewire.index');
    }
}
