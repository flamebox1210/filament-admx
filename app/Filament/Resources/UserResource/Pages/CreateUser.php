<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use AymanAlhattami\FilamentContextMenu\Actions\GoBackAction;
use AymanAlhattami\FilamentContextMenu\Actions\RefreshAction;
use AymanAlhattami\FilamentContextMenu\Traits\PageHasContextMenu;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    use PageHasContextMenu;

    protected static string $resource = UserResource::class;

    public function getContextMenuActions(): array
    {
        return [
            GoBackAction::make(),
            RefreshAction::make(),
        ];
    }
}
