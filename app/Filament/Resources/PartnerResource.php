<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PartnerResource\Pages;
use App\Filament\Resources\PartnerResource\RelationManagers;
use App\Models\Partner;
use App\Models\PartnerCategory;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Awcodes\Curator\Components\Tables\CuratorColumn;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PartnerResource extends Resource
{
    use Translatable;

    protected static ?string $model = Partner::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-path-rounded-square';
    protected static ?string $navigationGroup = 'Partner Management';

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
        $module = 'partners';

        return $form->columns([
            'sm' => 2,
            'xl' => 12,
        ])->schema([
            Grid::make()->columnSpan([
                'sm' => 2,
                'xl' => 3,
            ])->schema([
                CuratorPicker::make('image')->color('gray')
                    ->buttonLabel('Browse')
                    ->maxSize(5240000)
                    ->listDisplay(true)
                    ->directory($module)->acceptedFileTypes(['image/jpg', 'image/jpeg', 'image/png', 'image/webp', 'image/svg+xml'])
                    ->nullable()->columnSpanFull()
            ]),
            Grid::make()->columnSpan([
                'sm' => 2,
                'xl' => 9,
            ])->schema([
                Grid::make()->columns([
                    'sm' => 2,
                    'xl' => 12,
                ])->schema([
                    Forms\Components\TextInput::make('title')->required()->columnSpan([
                        'sm' => 2,
                        'xl' => 10,
                    ]),
                    Forms\Components\Toggle::make('is_active')->onColor('success')->offColor(null)->onIcon('heroicon-m-check')->inline(false)->columnSpan([
                        'sm' => 2,
                        'xl' => 2,
                    ]),
                ]),
                Forms\Components\TextInput::make('url')->url()->prefixIcon('heroicon-o-link')->placeholder('https://...')->columnSpanFull(),
                Forms\Components\Select::make('category_id')->options(PartnerCategory::all()->pluck('title', 'id'))->required()
                    ->native(false)
                    ->label('Categories')
                    ->searchable()
                    ->columnSpanFull(),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                CuratorColumn::make('image')->size(60)->circular(),
                Tables\Columns\TextColumn::make('title')
                    ->description(fn(Partner $record): string => $record->url)
                    ->searchable(),
                Tables\Columns\TextColumn::make('partner_category.title')->label('Category'),
                Tables\Columns\IconColumn::make('is_active')->boolean(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                SelectFilter::make('category_id')
                    ->label('Categories')
                    ->options(PartnerCategory::all()->pluck('title', 'id'))
                    ->searchable()
                    ->native(false),
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
            'index' => Pages\ManagePartners::route('/'),
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
