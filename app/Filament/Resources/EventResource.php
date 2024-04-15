<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Filament\Resources\EventResource\RelationManagers;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Section;
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

class EventResource extends Resource
{
    use Translatable;

    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Form $form): Form
    {
        $module = 'events';
        return $form->schema([
            // Index
            Section::make()->columns([
                'sm' => 2,
                'xl' => 12,
            ])->schema([
                Forms\Components\TextInput::make('title')->required()->live(onBlur: true)
                    ->afterStateUpdated(function (Get $get, Set $set, ?string $state, $context) {
                        if ($context == 'create')
                            $set('slug', Str::slug($state));
                    })->columnSpan([
                        'sm' => 2,
                        'xl' => 12,
                    ]),
                Forms\Components\RichEditor::make('content')->label('Description')
                    ->nullable()->columnSpan([
                        'sm' => 2,
                        'xl' => 12,
                    ]),
            ])->columnSpan([
                'sm' => 2,
                'xl' => 8,
            ]),
            Section::make()->columns([
                'sm' => 2,
                'xl' => 12,
            ])->schema([
                Forms\Components\TextInput::make('slug')->required()->unique(ignoreRecord: true)->readOnlyOn('create')->columnSpan([
                    'sm' => 2,
                    'xl' => 12,
                ]),
                Forms\Components\DatePicker::make('started_at')->columnSpan([
                    'sm' => 2,
                    'xl' => 6,
                ]),
                Forms\Components\DatePicker::make('ended_at')->columnSpan([
                    'sm' => 2,
                    'xl' => 6,
                ]),
                Forms\Components\FileUpload::make('image')->image()->imageEditor()->imageEditorMode(2)
                    ->disk('public')->directory($module)
                    ->optimize('webp')
                    ->nullable()->columnSpan([
                        'sm' => 2,
                        'xl' => 12,
                    ]),
                Forms\Components\Placeholder::make('created_at')->visibleOn('edit')
                    ->content(fn(Event $record): string => $record->created_at->toDayDateTimeString())->columnSpan([
                        'sm' => 2,
                        'xl' => 12,
                    ]),
                Forms\Components\Placeholder::make('updated_at')->visibleOn('edit')
                    ->content(fn(Event $record): string => $record->created_at->toDayDateTimeString())->columnSpan([
                        'sm' => 2,
                        'xl' => 12,
                    ])
            ])->columnSpan([
                'sm' => 2,
                'xl' => 4,
            ]),
            // Components
            Forms\Components\Builder::make('components')
                ->label('Content')
                ->blocks([
                    // Address
                    Builder\Block::make('address')
                        ->icon('heroicon-o-map')
                        ->schema([
                            Forms\Components\Toggle::make('is_active'),
                            Forms\Components\RichEditor::make('content')
                                ->nullable(),
                        ]),
                    // Location
                    Builder\Block::make('embed')
                        ->icon('heroicon-o-code-bracket-square')
                        ->schema([
                            Forms\Components\Toggle::make('is_active')->columnSpan([
                                'sm' => 1,
                                'xl' => 12,
                            ]),
                            Forms\Components\Textarea::make('embed')->autosize()->columnSpan([
                                'sm' => 1,
                                'xl' => 12,
                            ]),
                        ])->columns([
                            'sm' => 1,
                            'xl' => 12,
                        ]),
                    // Url
                    Builder\Block::make('url')
                        ->icon('heroicon-o-link')
                        ->schema([
                            Forms\Components\Toggle::make('is_active')->columnSpan([
                                'sm' => 1,
                                'xl' => 12,
                            ]),
                            Forms\Components\TextInput::make('url')->url()->columnSpan([
                                'sm' => 1,
                                'xl' => 12,
                            ]),
                        ])->columns([
                            'sm' => 1,
                            'xl' => 12,
                        ])
                ])->columnSpan([
                    'sm' => 1,
                    'xl' => 12,
                ])->collapsible()->collapsed()->cloneable(),
            // Status
            Fieldset::make()->columns([
                'sm' => 1,
                'xl' => 12,
            ])
                ->schema([
                    Forms\Components\Toggle::make('is_active')->columnSpan([
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
                Tables\Columns\TextColumn::make('started_at')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ended_at')
                    ->date()
                    ->sortable(),
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
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
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
