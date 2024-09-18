<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NavigationResource\Pages;
use App\Filament\Resources\NavigationResource\RelationManagers;
use App\Models\Navigation;
use App\Models\Page;
use Filament\Forms;
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

class NavigationResource extends Resource
{
    use Translatable;

    protected static ?string $model = Navigation::class;

    protected static ?string $navigationIcon = 'heroicon-o-paper-airplane';
    protected static ?int $navigationSort = 0;

    public static function form(Form $form): Form
    {
        $module = 'navigations';

        $options = [
            0 => 'Page',
            1 => 'External url',
        ];

        $targets = [
            '_self' => 'Open in same tab',
            '_blank' => 'Open in new tab'
        ];

        return $form->columns([
            'sm' => 1,
            'xl' => 12,
        ])
            ->schema([
                Forms\Components\TextInput::make('title')->required()->live(onBlur: true)
                    ->afterStateUpdated(function (Get $get, Set $set, ?string $state, $context) {
                        if ($context == 'create')
                            $set('slug', Str::slug($state));
                    })->columnSpan([
                        'sm' => 1,
                        'xl' => 6,
                    ]),
                Forms\Components\TextInput::make('slug')->required()->unique(ignoreRecord: true)->readOnlyOn('create')->columnSpan([
                    'sm' => 1,
                    'xl' => 6,
                ]),
                // Components
                Forms\Components\Repeater::make('components')
                    ->label('Menu')->columns([
                        'sm' => 1,
                        'xl' => 12,
                    ])
                    ->schema([
                        Forms\Components\Toggle::make('is_active')->onColor('success')->offColor(null)->onIcon('heroicon-m-check')->label(null)->columnSpan([
                            'sm' => 1,
                            'xl' => 4,
                        ]),
                        Forms\Components\Select::make('type')->label(false)->options($options)
                            ->reactive()->native(false)
                            ->columnSpan([
                                'sm' => 1,
                                'xl' => 4,
                            ]),
                        Forms\Components\Select::make('target')->label(false)->options($targets)
                            ->nullable()->native(false)
                            ->columnSpan([
                                'sm' => 1,
                                'xl' => 4,
                            ]),
                        Forms\Components\TextInput::make('title')->nullable()
                            ->columnSpan([
                                'sm' => 1,
                                'xl' => 12,
                            ]),
                        // Page
                        Forms\Components\Select::make('page')->nullable()
                            ->options(Page::all()->pluck('title', 'id'))
                            ->hidden(fn(Get $get) => $get('type') != 0)
                            ->native(false)
                            ->columnSpan([
                                'sm' => 1,
                                'xl' => 12,
                            ]),
                        // External Url
                        Forms\Components\TextInput::make('url')->url()->nullable()
                            ->prefixIcon('heroicon-o-link')
                            ->hidden(fn(Get $get) => $get('type') != 1)
                            ->columnSpan([
                                'sm' => 1,
                                'xl' => 12,
                            ]),
                        Forms\Components\Repeater::make('children')->columns([
                            'sm' => 1,
                            'xl' => 12,
                        ])
                            ->schema([
                                Forms\Components\Toggle::make('is_active')->onColor('success')->offColor(null)->onIcon('heroicon-m-check')->label(null)->columnSpan([
                                    'sm' => 1,
                                    'xl' => 4,
                                ]),
                                Forms\Components\Select::make('type')->label(false)->options($options)
                                    ->reactive()->native(false)
                                    ->columnSpan([
                                        'sm' => 1,
                                        'xl' => 4,
                                    ]),
                                Forms\Components\Select::make('target')->label(false)->options($targets)
                                    ->nullable()
                                    ->native(false)
                                    ->columnSpan([
                                        'sm' => 1,
                                        'xl' => 4,
                                    ]),
                                Forms\Components\TextInput::make('title')->nullable()
                                    ->columnSpan([
                                        'sm' => 1,
                                        'xl' => 12,
                                    ]),
                                // Page
                                Forms\Components\Select::make('page')->nullable()
                                    ->options(Page::all()->pluck('title', 'id'))
                                    ->hidden(fn(Get $get) => $get('type') != 0)
                                    ->native(false)
                                    ->columnSpan([
                                        'sm' => 1,
                                        'xl' => 12,
                                    ]),
                                // External Url
                                Forms\Components\TextInput::make('url')->url()->nullable()
                                    ->prefixIcon('heroicon-o-link')
                                    ->hidden(fn(Get $get) => $get('type') != 1)
                                    ->columnSpan([
                                        'sm' => 1,
                                        'xl' => 12,
                                    ]),
                            ])->itemLabel(fn(array $state): ?string => $state['title'] ?? null)->columnSpan([
                                'sm' => 1,
                                'xl' => 12,
                            ])->collapsible()->collapsed(),
                    ])->itemLabel(fn(array $state): ?string => $state['title'] ?? null)->columnSpan([
                        'sm' => 1,
                        'xl' => 12,
                    ])->collapsible()->collapsed(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageNavigations::route('/'),
        ];
    }

    public static function getEloquentQuery(): DatabaseBuilder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
