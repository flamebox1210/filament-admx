<?php

namespace App\Filament\Resources\MasterResource\Pages;

use App\Enums\MasterSection;
use App\Filament\Resources\MasterResource;
use AymanAlhattami\FilamentContextMenu\Actions\GoBackAction;
use AymanAlhattami\FilamentContextMenu\Actions\GoForwardAction;
use AymanAlhattami\FilamentContextMenu\Actions\RefreshAction;
use AymanAlhattami\FilamentContextMenu\ContextMenuDivider;
use AymanAlhattami\FilamentContextMenu\Traits\PageHasContextMenu;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListMasters extends ListRecords
{
    use ListRecords\Concerns\Translatable;
    use PageHasContextMenu;

    protected static string $resource = MasterResource::class;

    public function getContextMenuActions(): array
    {
        return [
            GoBackAction::make(),
            GoForwardAction::make(),
            RefreshAction::make(),
            ContextMenuDivider::make(),
            Action::make('Create')->icon('heroicon-o-plus')->label(__('be.button.create'))
                ->url(CreateMaster::getUrl()),
        ];
    }

    public function getTabs(): array
    {
        $tabs = [];
        foreach (MasterSection::cases() as $section) {
            $tabs[$section->getLabel()] = Tab::make()->query(fn($query) => $query->where('section', $section->name));
        }
        return $tabs;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make()->icon('heroicon-o-plus')->label(__('be.button.create')),
        ];
    }
}
