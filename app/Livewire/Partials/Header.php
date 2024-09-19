<?php

namespace App\Livewire\Partials;

use App\Models\Navigation;
use App\Models\Page;
use Filament\Resources\Concerns\Translatable;
use Illuminate\Http\Request;
use Livewire\Component;

class Header extends Component
{
    use Translatable;

    public $locale;

    /**
     * Mounting livewire
     *
     * @return mount
     */
    public function mount(Request $request)
    {
        $this->locale = app()->getLocale();
    }

    public function render()
    {
        $navigationGroup = Navigation::where('slug->' . $this->locale, 'header')->first();
        $navigationItem = [];
        if ($navigationGroup) {
            foreach ($navigationGroup->components as $key => $navigation) {
                if ($navigation['type'] == 0) {
                    $page = Page::where('id', $navigation['page'])->whereLocale('slug', $this->locale)->first();
                    $navigationUrl['final_url'] = route('fe.page', ['slug' => $page->slug]);
                } else {
                    $navigationUrl['final_url'] = $navigation['url'];
                }
                $navigationItemChild = [];
                if ($navigation['children']) {
                    foreach ($navigation['children'] as $children) {
                        if ($children['type'] == 0) {
                            $pageChild = Page::where('id', $children['page'])->whereLocale('slug', $this->locale)->first();
                            if ($children['anchor']) {
                                $anchor = '#' . $children['anchor'];
                            } else {
                                $anchor = '';
                            }
                            $navigationUrlChild['final_url'] = route('fe.page', ['slug' => $pageChild->slug]) . $anchor;
                        } else {
                            $navigationUrlChild['final_url'] = $children['url'];
                        }
                        $navigationMergeChild = array_merge($navigationUrlChild, $children);
                        $navigationItemChild[] = $navigationMergeChild;
                    }
                }
                $navigation['children'] = $navigationItemChild;
                $navigationMerge = array_merge($navigationUrl, $navigation);
                $navigationItem[] = $navigationMerge;

            }
        }

        $navigations = $navigationItem;

        return view('livewire.partials.header', compact('navigations'));
    }
}
