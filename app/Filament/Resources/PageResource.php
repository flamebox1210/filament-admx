<?php

namespace App\Filament\Resources;

use App\Enums\TemplatePage;
use App\Filament\Resources\PageResource\Pages;
use App\Filament\Resources\PageResource\RelationManagers;
use App\Models\Page;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder as DatabaseBuilder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class PageResource extends Resource
{
    use Translatable;

    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-square-3-stack-3d';
    protected static ?string $navigationLabel = 'Pages';
    protected static ?int $navigationSort = 1;
    protected static ?string $recordTitleAttribute = 'title';

    /**
     * @return string|null
     */
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
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
                    Forms\Components\TextInput::make('slug')->required()->unique(ignoreRecord: true)->readOnlyOn('create')->columnSpanFull(),
                    CuratorPicker::make('image')->color('gray')
                        ->buttonLabel('Browse')
                        ->maxSize(5240000)
                        ->directory($module)->acceptedFileTypes(['image/jpg', 'image/jpeg', 'image/png', 'image/webp', 'image/svg+xml'])
                        ->nullable()->columnSpanFull(),
                        Forms\Components\Select::make('template')->options(TemplatePage::class)->native(false)
                ])->columnSpan([
                    'sm' => 2,
                    'xl' => 4,
                ]),
            // Components
            ComponentBuilderResource::defaultComponents($module, 'en')
                ->hidden(fn(Get $get) => $get('../activeLocale') == 'id'),
            ComponentBuilderResource::defaultComponents($module, 'id')
                ->hidden(fn(Get $get) => $get('../activeLocale') == 'en'),
            // Status
            Fieldset::make()->columns([
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

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\ToggleColumn::make('is_default')->onColor('success')->offColor(null)->onIcon('heroicon-m-check'),
                Tables\Columns\IconColumn::make('is_active')->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): DatabaseBuilder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getTranslatableLocales(): array
    {
        return config('app.locales');
    }
}
