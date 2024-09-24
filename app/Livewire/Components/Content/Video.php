<?php

namespace App\Livewire\Components\Content;

use Livewire\Component;

class Video extends Component
{
    public $page;
    public $query;
    public $data;
    public $youtube;

    public function mount()
    {
        $this->data = $this->query['data'];
        $this->youtube = str_replace('https://www.youtube.com/watch?v=', 'https://www.youtube.com/embed/', $this->data['youtube_url']);
    }

    public function render()
    {
        return view('livewire.components.content.video');
    }
}
