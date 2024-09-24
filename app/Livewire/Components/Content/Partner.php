<?php

namespace App\Livewire\Components\Content;

use App\Models\Partner as PartnerQuery;
use App\Models\PartnerCategory;
use Awcodes\Curator\Models\Media;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Partner extends Component
{
    public $page;
    public $query;
    public $data;

    public $getCategory;
    public $categories = [];
    public $partners = [];

    public function mount()
    {
        $this->data = $this->query['data'];
        $this->categories = PartnerCategory::orderBy('created_at')->get();
        $this->getCategory = PartnerCategory::first();

        $partners = PartnerQuery::where('category_id', $this->getCategory->id)->where('is_active', 1)->orderBy('created_at')->limit(6)->get();
        $setItem = [];
        foreach ($partners as $partner) {
            $media = Media::find($partner->image);
            if ($media) {
                $partner->image_path = Storage::disk('public')->url($media['path']);
            } else {
                $partner->image_path = null;
            }
            $setItem[] = $partner;
        }
        $this->partners = $setItem;
    }

    public function render()
    {
        return view('livewire.components.content.partner');
    }

    public function selectCategory($category)
    {
        $this->getCategory = PartnerCategory::find($category);
        $partners = PartnerQuery::where('category_id', $category)->where('is_active', 1)->orderBy('created_at')->limit(6)->get();
        $setItem = [];
        foreach ($partners as $partner) {
            $media = Media::find($partner->image);
            if ($media) {
                $partner->image_path = Storage::disk('public')->url($media['path']);
            } else {
                $partner->image_path = null;
            }
            $setItem[] = $partner;
        }
        $this->partners = $setItem;
    }
}
