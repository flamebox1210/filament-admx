<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\Tag;
use Filament\Forms;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Pages\PageRegistration;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder as DatabaseBuilder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class ArticleResource extends Resource
{
    use Translatable;

    protected static ?string $model = Article::class;
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $navigationGroup = 'Article Management';

    /**
     * @return string|null
     */
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        $module = 'articles';

        $videoOptions = [
            'upload' => 'Upload video',
            'youtube' => 'Youtube url'
        ];

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
                Forms\Components\RichEditor::make('content')->label('Description')->nullable()->columnSpan([
                    'sm' => 2,
                    'xl' => 12,
                ]),
                Forms\Components\Select::make('category_id')->options(ArticleCategory::all()->pluck('title', 'id'))->required()
                    ->native(false)
                    ->label('Categories')
                    ->relationship(name: 'article_categories', titleAttribute: 'title')
                    ->createOptionForm([
                        Forms\Components\TextInput::make('title')->required()->live(onBlur: true)
                            ->afterStateUpdated(function (Get $get, Set $set, ?string $state, $context) {
                                $set('slug', Str::slug($state));
                            }),
                        Forms\Components\TextInput::make('slug')->required()->unique(ignoreRecord: true)->readOnlyOn('create')
                    ])
                    ->columnSpan([
                        'sm' => 2,
                        'xl' => 6,
                    ]),
                Forms\Components\Select::make('tags')->multiple()->reactive()->options(Tag::all()->pluck('title', 'id'))->nullable()
                    ->label('Tags')
                    ->columnSpan([
                        'sm' => 2,
                        'xl' => 6,
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
                Forms\Components\DatePicker::make('published_at')->columnSpan([
                    'sm' => 2,
                    'xl' => 12,
                ]),
                Forms\Components\FileUpload::make('image')->image()->imageEditor()->imageEditorMode(2)
                    ->disk('public')->directory($module)
                    ->optimize('webp')
                    ->nullable()->columnSpan([
                        'sm' => 2,
                        'xl' => 12,
                    ]),
                Forms\Components\Placeholder::make('created_at')->visibleOn('edit')
                    ->content(fn(Article $record): string => $record->created_at->toDayDateTimeString())->columnSpan([
                        'sm' => 2,
                        'xl' => 12,
                    ]),
                Forms\Components\Placeholder::make('updated_at')->visibleOn('edit')
                    ->content(fn(Article $record): string => $record->created_at->toDayDateTimeString())->columnSpan([
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
                    // Paragraph
                    Builder\Block::make('paragraph')
                        ->icon('heroicon-c-bars-4')
                        ->schema([
                            Forms\Components\Toggle::make('is_active'),
                            Forms\Components\RichEditor::make('content')->nullable(),
                        ]),
                    // Image
                    Builder\Block::make('image')
                        ->icon('heroicon-o-photo')
                        ->schema([
                            Forms\Components\Toggle::make('is_active'),
                            Forms\Components\FileUpload::make('image')->image()->imageEditor()->imageEditorMode(2)
                                ->disk('public')->directory($module)
                                ->optimize('webp')
                                ->nullable(),
                        ]),
                    // Video
                    Builder\Block::make('video')
                        ->icon('heroicon-o-video-camera')
                        ->columns([
                            'sm' => 1,
                            'xl' => 12,
                        ])
                        ->schema([
                            Forms\Components\Toggle::make('is_active')->label(null)->columnSpan([
                                'sm' => 1,
                                'xl' => 4,
                            ]),
                            Forms\Components\Radio::make('type')->inline()->label(false)->options($videoOptions)
                                ->reactive()
                                ->columnSpan([
                                    'sm' => 1,
                                    'xl' => 8,
                                ]),
                            Forms\Components\TextInput::make('youtube_url')->url()
                                ->prefixIcon('heroicon-o-link')
                                ->hidden(fn(Get $get) => $get('type') !== 'youtube')
                                ->nullable()->columnSpan([
                                    'sm' => 1,
                                    'xl' => 12,
                                ]),
                            Forms\Components\FileUpload::make('upload_video')
                                ->disk('public')->directory($module)
                                ->optimize('webp')
                                ->hidden(fn(Get $get) => $get('type') !== 'upload')
                                ->nullable()->columnSpan([
                                    'sm' => 1,
                                    'xl' => 12,
                                ]),
                        ]),
                    // Quote
                    Builder\Block::make('quote')
                        ->icon('heroicon-o-chat-bubble-oval-left')
                        ->schema([
                            Forms\Components\Toggle::make('is_active')->columnSpan([
                                'sm' => 1,
                                'xl' => 12,
                            ]),
                            Forms\Components\TextInput::make('name')->columnSpan([
                                'sm' => 1,
                                'xl' => 6,
                            ]),
                            Forms\Components\TextInput::make('role')->columnSpan([
                                'sm' => 1,
                                'xl' => 6,
                            ]),
                            Forms\Components\Textarea::make('content')->columnSpan([
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
                    Forms\Components\Toggle::make('is_featured')->columnSpan([
                        'sm' => 1,
                        'xl' => 2,
                    ]),
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
                Tables\Columns\TextColumn::make('article_categories.title')->label('Category'),
                Tables\Columns\ToggleColumn::make('is_featured'),
                Tables\Columns\IconColumn::make('is_active')->boolean(),
                Tables\Columns\TextColumn::make('published_at')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
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
                SelectFilter::make('category_id')
                    ->options(ArticleCategory::all()->pluck('title', 'id'))
                    ->native(false),
                SelectFilter::make('tags')
                    ->options(Tag::all()->pluck('title', 'id'))
                    ->native(false)
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
            //ArticleCategoriesRelationManager::class
        ];
    }

    /**
     * @return array|PageRegistration[]
     */
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }

    /**
     * @return DatabaseBuilder
     */
    public static function getEloquentQuery(): DatabaseBuilder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
