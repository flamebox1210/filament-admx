<?php

namespace App\Livewire\Components\Template;

use App\Models\Article;
use App\Models\ArticleCategory;
use Awcodes\Curator\Models\Media;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Articles extends Component
{
    use WithPagination;

    public $perPage = 5;
    public $page;
    public $media;
    public $isCategory = false;
    public $category;
    public $categoryName;

    public $isSearch = false;
    public $search;

    public function mount()
    {
        $this->media = Media::find($this->page->image);
    }

    public function applySearch()
    {
        $this->isSearch = true;
        $this->resetPage();
        $this->render();
    }

    public function render()
    {
        $categories = ArticleCategory::orderBy('title', 'asc')->get();
        $recents = Article::where('is_active', true)->orderBy('created_at', 'desc')->limit(5)->get();
        return view('livewire.components.template.articles', [
            'articles' => $this->articleQueries(),
            'recents' => $recents,
            'categories' => $categories,
        ]);
    }

    function articleQueries()
    {
        $articles = Article::where('is_active', true)->orderBy('published_at', 'desc')
            ->when($this->isSearch, function ($query) {
                $query->where(DB::raw('lower(title)'), 'like', '%' . strtolower($this->search) . '%');
            })
            ->when($this->isCategory, function ($query) {
                $query->where('category_id', $this->category);
            })
            ->paginate($this->perPage);

        return $articles;
    }

    public function applyCategory()
    {
        if ($this->category) {
            $this->isCategory = true;
            $this->categoryName = ArticleCategory::find($this->category)->title;
        } else {
            $this->isCategory = false;
            $this->categoryName = null;
        }
        $this->resetPage();
        $this->render();
    }
}
