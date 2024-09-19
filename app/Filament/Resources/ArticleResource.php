<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Filament\Resources\ArticleResource\RelationManagers\ArticleCategoriesRelationManager;
use App\Filament\Resources\KnowledgeResource\RelationManagers\FilesRelationManager;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\Author;
use App\Models\Tag;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Forms;
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
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class ArticleResource extends Resource
{
    use Translatable;

    protected static ?string $model = Article::class;
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $navigationGroup = 'Article Management';
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
        $module = 'articles';


        return $form->schema([
            // Index
            Section::make()->columns([
                'sm' => 2,
                'xl' => 12,
            ])->schema([
                Forms\Components\TextInput::make('title')->required()->live(onBlur: true)
                    ->afterStateUpdated(function (Get $get, Set $set, ?string $state, $context) {
                        //if ($context == 'create')
                        $set('slug', Str::slug($state));
                    })->columnSpan([
                        'sm' => 2,
                        'xl' => 12,
                    ]),
                TinyEditor::make('content')->label('Description')
                    ->profile('simple')->language(app()->getLocale())->nullable()->columnSpan([
                        'sm' => 2,
                        'xl' => 12,
                    ]),
                Forms\Components\Select::make('category_id')->options(ArticleCategory::all()->pluck('title', 'id'))->required()
                    ->native(false)
                    ->label('Categories')
                    ->searchable()
                    ->relationship(name: 'article_category', titleAttribute: 'title')
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
                    ->preload()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('tag_title')->required()->live(onBlur: true)
                            ->afterStateUpdated(function (Get $get, Set $set, ?string $state, $context) {
                                $set('tag_slug', Str::slug($state));
                            }),
                        Forms\Components\TextInput::make('tag_slug')->required()->unique(ignoreRecord: true)->readOnly()
                    ])->createOptionUsing(function (array $data) {
                        if ($data['tag_slug']) {
                            $findRecord = Tag::where('slug->' . app()->getLocale(), $data['tag_slug'])->count();
                            if ($findRecord > 0) {
                                $record = Tag::where('slug->' . app()->getLocale(), $data['tag_slug'])->first();
                                $record->replaceTranslations('title', [app()->getLocale() => $data['tag_title']]);
                                $record->replaceTranslations('slug', [app()->getLocale() => $data['tag_slug']]);
                                $record->save();
                            } else {
                                $record = Tag::create([
                                    'title' => $data['tag_title'],
                                    'slug' => $data['tag_slug'],
                                ]);
                            }
                            return $record->getKey();
                        }
                    })
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
                CuratorPicker::make('image')->color('gray')
                    ->buttonLabel('Browse')
                    ->maxSize(5240000)
                    ->directory($module)->acceptedFileTypes(['image/jpg', 'image/jpeg', 'image/png', 'image/webp', 'image/svg+xml'])
                    ->nullable()->columnSpan([
                        'sm' => 2,
                        'xl' => 12,
                    ]),
                Forms\Components\Select::make('author_id')->options(Author::all()->pluck('name', 'id'))
                    ->native(false)
                    ->label('Author')
                    ->columnSpan([
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

            // Components
            ComponentBuilderResource::articleComponents($module, 'en')
                ->hidden(fn(Get $get) => $get('../activeLocale') == 'id'),
            ComponentBuilderResource::articleComponents($module, 'id')
                ->hidden(fn(Get $get) => $get('../activeLocale') == 'en'),
            // Status
            Fieldset::make()->columns([
                'sm' => 1,
                'xl' => 12,
            ])
                ->schema([
                    Forms\Components\Toggle::make('is_featured')->onColor('success')->offColor(null)->onIcon('heroicon-o-check')->columnSpan([
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
                Tables\Columns\TextColumn::make('article_category.title')->label('Category'),
                Tables\Columns\ToggleColumn::make('is_featured')->onColor('success')->offColor(null)->onIcon('heroicon-m-check'),
                Tables\Columns\IconColumn::make('is_active')->boolean(),
                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime()
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
                    ->label('Categories')
                    ->options(ArticleCategory::all()->pluck('title', 'id'))
                    ->searchable()
                    ->native(false),
                SelectFilter::make('tags')
                    ->options(Tag::all()->pluck('title', 'id'))
                    ->multiple()
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
            FilesRelationManager::class
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
