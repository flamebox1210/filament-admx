<?php

namespace App\Livewire;

use App\Models\Page;
use Awcodes\Curator\Models\Media;
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
        $currentPageData = Page::where('is_active', 1)->whereLike('slug', '%' . request('slug') . '%')->first();
        $article = \App\Models\Article::where('is_active', 1)->whereLike('slug', '%' . request('articleSlug') . '%')->whereLocales('slug', config('app.locales'))->first();

        if ($article->image) {
            $media = Media::find($article->image);
        } else {
            $media = null;
        }
        $currentPageItem = [];
        foreach ($currentPageData->getTranslations('slug') as $key => $translation) {
            if ($translation == request('slug')) {
                Session::put('locale', $key);
                App::setLocale($key);
                $currentPageItem[] = Page::where('is_active', 1)->where('slug->' . $key, request('slug'))->first();
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

        // Recents
        $recents = \App\Models\Article::where('is_active', true)->orderBy('created_at', 'desc')->limit(5)->get();

        // Related
        $relations = \App\Models\Article::where('is_active', true)
            ->whereNot('id', $article->id)
            ->where('category_id', $article->category_id)
            ->orderBy('published_at', 'desc')->limit(3)->get();

        return view('livewire.article', compact('article', 'media', 'recents', 'relations', 'currentPage'))->layout('livewire.layout', compact('page', 'media'));
    }
}
