<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MasterResource\Pages;
use App\Filament\Resources\MasterResource\RelationManagers;
use App\Models\Master;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class MasterResource extends Resource
{
    use Translatable;

    protected static ?string $model = Master::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Data Management';
    protected static ?string $navigationLabel = 'Master Data';

    public static function form(Form $form): Form
    {
        return $form->columns([
            'sm' => 2,
            'xl' => 12,
        ])->schema([
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
                        'xl' => 6,
                    ]),
                Forms\Components\TextInput::make('slug')->required()->unique(ignoreRecord: true)->readOnlyOn('create')->columnSpan([
                    'sm' => 2,
                    'xl' => 6,
                ]),
                Forms\Components\Textarea::make('content')->label('Description')->rows(5)->autosize()->nullable()->columnSpan([
                    'sm' => 2,
                    'xl' => 12,
                ]),
            ]),
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
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
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
            'index' => Pages\ListMasters::route('/'),
            'create' => Pages\CreateMaster::route('/create'),
            'edit' => Pages\EditMaster::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
