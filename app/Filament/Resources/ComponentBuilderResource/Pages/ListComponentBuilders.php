<?php

namespace App\Filament\Resources\ComponentBuilderResource\Pages;

use App\Filament\Resources\ComponentBuilderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListComponentBuilders extends ListRecords
{
    protected static string $resource = ComponentBuilderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
