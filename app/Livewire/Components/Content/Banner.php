<?php

namespace App\Livewire\Components\Content;

use Awcodes\Curator\Models\Media;
use Livewire\Component;

class Banner extends Component
{
    public $page;
    public $query;
    public $data;
    public $media;

    public function mount()
    {
        $this->data = $this->query['data'];
        $this->media = Media::find($this->data['image']);
    }

    public function render()
    {
        return view('livewire.components.content.banner');
    }
}
