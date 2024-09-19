<?php

namespace App\Livewire\Components\Content;

use Awcodes\Curator\Models\Media;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Carousel extends Component
{
    public $query;
    public $data;
    public $items;

    public function mount()
    {
        $this->data = $this->query['data'];

        $setItem = [];
        foreach ($this->data['items'] as $item) {
            $media = Media::find($item['image']);
            if ($media) {
                $image['image_path'] = Storage::disk('public')->url($media['path']);
            } else {
                $image['image_path'] = null;
            }
            $merge = array_merge($image, $item);
            $setItem[] = $merge;
        }
        $this->items = $setItem;
    }

    public function render()
    {
        return view('livewire.components.content.carousel');
    }
}
