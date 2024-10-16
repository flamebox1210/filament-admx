<?php

namespace App\Filament\Resources\PageResource\Pages;

use App\Enums\TemplatePage;
use App\Filament\Resources\ComponentBuilderResource;
use App\Filament\Resources\PageResource;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use AymanAlhattami\FilamentContextMenu\Actions\GoBackAction;
use AymanAlhattami\FilamentContextMenu\Actions\RefreshAction;
use AymanAlhattami\FilamentContextMenu\Traits\PageHasContextMenu;
use Filament\Actions;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Str;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class EditPage extends EditRecord
{
    use EditRecord\Concerns\Translatable;
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
        $module = 'pages';

        return $form->schema([
            // Index
            Tabs::make('Tabs')
                ->tabs([
                    Tabs\Tab::make('Index')
                        ->icon('heroicon-o-document-text')
                        ->schema([
                            Forms\Components\TextInput::make('title')
                                ->label(trans('be.form.title.label'))
                                ->translateLabel()
                                ->required()->live(onBlur: true)
                                ->afterStateUpdated(function (Get $get, Set $set, ?string $state, $context) {
                                    $set('slug', Str::slug($state));
                                }),
                            TinyEditor::make('content')
                                ->label(trans('be.form.excerpt.label'))
                                ->profile('simple')->language(app()->getLocale())->nullable(),
                        ]),
                    Tabs\Tab::make('Meta')
                        ->icon('heroicon-o-globe-alt')
                        ->schema([
                            Forms\Components\TextInput::make('meta_title')->nullable(),
                            Forms\Components\Textarea::make('meta_description')->autosize()->nullable()
                        ]),
                ])->columnSpan([
                    'sm' => 2,
                    'xl' => 8,
                ]),
            Section::make()
                ->schema([
                    Forms\Components\TextInput::make('slug')->required()->unique(ignoreRecord: true)->columnSpanFull(),
                    CuratorPicker::make('image')->color('gray')
                        ->buttonLabel('Browse')
                        ->maxSize(5240000)
                        ->directory($module)->acceptedFileTypes(['image/jpg', 'image/jpeg', 'image/png', 'image/webp', 'image/svg+xml'])
                        ->nullable()->columnSpanFull(),
                    Forms\Components\Select::make('template')->options(TemplatePage::class)
                        ->default(TemplatePage::HOME)
                        ->live()
                        ->afterStateUpdated(function ($state, Forms\Set $set) {
                            $set('template', $state);
                        })
                        ->native(false)
                ])->columnSpan([
                    'sm' => 2,
                    'xl' => 4,
                ]),

            ComponentBuilderResource::defaultComponents($module)->label('')
                ->addActionLabel('Add a new ' . TemplatePage::HOME->value . ' content')
                ->visible(fn(Forms\Get $get) => $get('template') == TemplatePage::HOME->value),
            ComponentBuilderResource::flexyComponents($module)->label('')
                ->addActionLabel('Add a new ' . TemplatePage::FLEXY->value . ' content')
                ->visible(fn(Forms\Get $get) => $get('template') == TemplatePage::FLEXY->value),
            // Status
            Fieldset::make()
                ->columns([
                    'sm' => 1,
                    'xl' => 12,
                ])
                ->schema([
                    Forms\Components\Toggle::make('is_default')->onColor('success')->offColor(null)->onIcon('heroicon-m-check')->columnSpan([
                        'sm' => 1,
                        'xl' => 2,
                    ]),
                    Forms\Components\Toggle::make('is_active')->onColor('success')->offColor(null)->onIcon('heroicon-m-check')->columnSpan([
                        'sm' => 1,
                        'xl' => 2,
                    ]),
                ])->columnSpan([
                    'sm' => 1,
                    'xl' => 12,
                ]),
        ])->columns([
            'sm' => 2,
            'xl' => 12,
        ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make()
        ];
    }
}
