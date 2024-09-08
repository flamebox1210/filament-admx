<?php

namespace App\Filament\Resources\ComponentBuilderResource\Pages;

use App\Filament\Resources\ComponentBuilderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditComponentBuilder extends EditRecord
{
    protected static string $resource = ComponentBuilderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
