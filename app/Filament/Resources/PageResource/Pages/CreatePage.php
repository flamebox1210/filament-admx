<?php

namespace App\Filament\Resources\PageResource\Pages;

use App\Filament\Resources\PageResource;
use AymanAlhattami\FilamentContextMenu\Actions\GoBackAction;
use AymanAlhattami\FilamentContextMenu\Actions\RefreshAction;
use AymanAlhattami\FilamentContextMenu\Traits\PageHasContextMenu;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreatePage extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;
    use PageHasContextMenu;

    protected static string $resource = PageResource::class;

    public function getContextMenuActions(): array
    {
        return [
            GoBackAction::make(),
            RefreshAction::make(),
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label(trans('be.form.title.label'))
                            ->translateLabel()
                            ->required()->live(onBlur: true)
                            ->afterStateUpdated(function (Get $get, Set $set, ?string $state, $context) {
                                $set('slug', Str::slug($state));
                            })->columnSpanFull(),
                        Forms\Components\TextInput::make('slug')->required()->unique(ignoreRecord: true)->columnSpanFull(),
                    ])
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('create')
                ->label('Next')
                ->action('create')
                ->color('primary'),
            $this->getCancelFormAction(),
        ];
    }
}
