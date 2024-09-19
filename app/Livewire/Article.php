<?php

namespace App\Livewire;

use App\Models\Page as PageQuery;
use Filament\Resources\Concerns\Translatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Article extends Component
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
        $currentPageData = PageQuery::where('is_active', 1)->whereLike('slug', '%' . request('slug') . '%')->first();
        $article = \App\Models\Article::where('is_active', 1)->whereLike('slug', '%' . request('articleSlug') . '%')->whereLocales('slug', config('app.locales'))->first();

        $currentPageItem = [];
        foreach ($currentPageData->getTranslations('slug') as $key => $translation) {
            if ($translation == request('slug')) {
                Session::put('locale', $key);
                App::setLocale($key);
                $currentPageItem[] = PageQuery::where('is_active', 1)->where('slug->' . $key, request('slug'))->first();
                $article = \App\Models\Article::where('is_active', 1)->where('slug->' . $key, request('articleSlug'))->first();
            }
        }
        foreach ($currentPageItem as $current) {
            if ($current) {
                $currentPage = $current;
            }
        }
        if (!$article) {
            abort(404);
        }
        // Meta
        $page = $article;
        $page->meta_title = $article->title;
        $page->meta_description = $article->excerpt;

        return view('livewire.fe.article', compact('article', 'currentPage'))->layout('livewire.fe.layout', compact('page'));
    }
}
