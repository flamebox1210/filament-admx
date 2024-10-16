<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Enums\TemplatePage;
use App\Filament\Resources\ArticleResource;
use App\Models\Article;
use App\Models\Page;
use AymanAlhattami\FilamentContextMenu\Actions\GoBackAction;
use AymanAlhattami\FilamentContextMenu\Actions\RefreshAction;
use AymanAlhattami\FilamentContextMenu\Traits\PageHasContextMenu;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Str;

class EditArticle extends EditRecord
{
    use EditRecord\Concerns\Translatable;
    use PageHasContextMenu;

    protected static string $resource = ArticleResource::class;

    public function getContextMenuActions(): array
    {
        return [
            GoBackAction::make(),
            RefreshAction::make(),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            $this->getSaveFormAction()->submit(null)->action('save'),
            Actions\ViewAction::make('preview')->color('success')->icon('heroicon-o-eye')
                ->hidden(Page::where('template', TemplatePage::ARTICLES)->count() == 0)
                ->url(function (Article $record) {
                    $page = Page::where('template', TemplatePage::ARTICLES)->first();
                    if ($page)
                        return route('fe.article', ['parent' => Str::singular($page->slug), 'slug' => $record->slug]);
                })
                ->openUrlInNewTab(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
