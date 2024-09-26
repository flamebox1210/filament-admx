<?php

namespace App\Livewire\Components\Article;

use Livewire\Component;

class Paragraph extends Component
{
    public $page;
    public $query;
    public $data;

    public function mount()
    {
        $this->data = $this->query['data'];
    }

    public function render()
    {
        return view('livewire.components.article.paragraph');
    }
}
