<?php

namespace App\Livewire;

use App\Models\Page as PageQuery;
use Filament\Resources\Concerns\Translatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Index extends Component
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
        $fallbackLocale = app()->getLocale() == 'en' ? 'id' : 'en';
        if (request('slug')) {
            $page = PageQuery::where('is_active', 1)->whereLike('slug', '%' . request('slug') . '%')->whereLocales('slug', config('app.locales'))->first();
            if (!$page) {
                abort(404);
            }
            foreach ($page->getTranslations('slug') as $key => $translation) {
                if ($translation == request('slug')) {
                    Session::put('locale', $key);
                    App::setLocale($key);
                    $page = PageQuery::where('is_active', 1)->where('slug->' . $key, request('slug'))->first();
                }
            }
        } else {
            $page = PageQuery::where('is_active', 1)->where('is_default', 1)->first();
        }
        if (!$page) {
            abort(404);
        }
        return view('livewire.index', compact('page'))->layout('livewire.layout', compact('page'));
    }
}
