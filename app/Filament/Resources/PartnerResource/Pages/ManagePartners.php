<?php

namespace App\Filament\Resources\PartnerResource\Pages;

use App\Filament\Resources\PartnerResource;
use AymanAlhattami\FilamentContextMenu\Actions\GoBackAction;
use AymanAlhattami\FilamentContextMenu\Actions\GoForwardAction;
use AymanAlhattami\FilamentContextMenu\Actions\RefreshAction;
use AymanAlhattami\FilamentContextMenu\Traits\PageHasContextMenu;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePartners extends ManageRecords
{
    use ManageRecords\Concerns\Translatable;
    use PageHasContextMenu;

    protected static string $resource = PartnerResource::class;

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
