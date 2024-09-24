<?php

namespace App\Livewire\Components\Template;

use Awcodes\Curator\Models\Media;
use Livewire\Component;

class Flexy extends Component
{
    public $page;
    public $media;

    public function mount()
    {
        $this->media = Media::find($this->page->image);
    }

    public function render()
    {
        return view('livewire.components.template.flexy');
    }
}
