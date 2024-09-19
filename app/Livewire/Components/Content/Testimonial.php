<?php

namespace App\Livewire\Components\Content;

use Awcodes\Curator\Models\Media;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Testimonial extends Component
{
    public $query;
    public $data;
    public $items;

    public $isOpenModal = false;
    public $title;
    public $youtube;

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
        return view('livewire.components.content.testimonial');
    }

    public function openModal($title, $youtube)
    {
        $this->isOpenModal = true;
        $this->title = $title;
        $youtube = str_replace('https://www.youtube.com/watch?v=', 'https://www.youtube.com/embed/', $youtube);
        $this->youtube = $youtube;
    }

    public function closeModal()
    {
        $this->isOpenModal = false;
        $this->title = null;
        $this->youtube = null;
    }
}
