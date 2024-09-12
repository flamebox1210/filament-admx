<?php

namespace App\Filament\Resources\PartnerCategoryResource\Pages;

use App\Filament\Resources\PartnerCategoryResource;
use AymanAlhattami\FilamentContextMenu\Actions\GoBackAction;
use AymanAlhattami\FilamentContextMenu\Actions\GoForwardAction;
use AymanAlhattami\FilamentContextMenu\Actions\RefreshAction;
use AymanAlhattami\FilamentContextMenu\Traits\PageHasContextMenu;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePartnerCategories extends ManageRecords
{
    use ManageRecords\Concerns\Translatable;
    use PageHasContextMenu;

    protected static string $resource = PartnerCategoryResource::class;

    public function getContextMenuActions(): array
    {
        return [
            GoBackAction::make(),
            GoForwardAction::make(),
            RefreshAction::make(),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make()->icon('heroicon-o-plus')->label(__('be.button.create')),
        ];
    }
}
