<?php

namespace App\Filament\Resources\KnowledgeResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class LinksRelationManager extends RelationManager
{
    protected static string $relationship = 'links';

    protected static ?string $title = 'Related Links';

    public function form(Form $form): Form
    {
        $module = 'links';

        return $form
            ->schema([
                Forms\Components\TextInput::make('title')->columnSpanFull(),
                Forms\Components\TextInput::make('url')->url()->prefixIcon('heroicon-o-link')->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('url')->markdown()->alignCenter()
                    ->icon('heroicon-o-link')
                    ->formatStateUsing(fn(string $state): string => "<a target='_blank' href='{$state}'>" . __('be.button.browse') . "</a>"),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->icon('heroicon-o-plus')->label(__('be.button.create')),
                Tables\Actions\AttachAction::make()
                    ->preloadRecordSelect()
                    ->multiple(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make(),
                ]),
            ]);
    }
}
