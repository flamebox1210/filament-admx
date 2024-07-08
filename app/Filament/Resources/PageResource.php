<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Filament\Resources\PageResource\RelationManagers;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
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

class PageResource extends Resource
{
    use Translatable;

    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-square-3-stack-3d';
    protected static ?string $navigationLabel = 'Pages';
    protected static ?int $navigationSort = 1;
    protected static ?string $recordTitleAttribute = 'title';


    public static function form(Form $form): Form
    {
        $module = 'pages';

        $textImageOptions = [
            'left' => 'Image on left',
            'right' => 'Image on right'
        ];

        $videoOptions = [
            'upload' => 'Upload video',
            'youtube' => 'Youtube url'
        ];

        return $form->schema([
            // Index
            Tabs::make('Tabs')
                ->tabs([
                    Tabs\Tab::make('Index')
                        ->icon('heroicon-o-document-text')
                        ->schema([
                            Forms\Components\TextInput::make('title')->required()->live(onBlur: true)
                                ->afterStateUpdated(function (Get $get, Set $set, ?string $state, $context) {
                                    if ($context == 'create')
                                        $set('slug', Str::slug($state));
                                }),
                            Forms\Components\RichEditor::make('content')->label('Excerpt')->nullable(),
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
                    Forms\Components\TextInput::make('slug')->required()->unique(ignoreRecord: true)->readOnlyOn('create'),
                    Forms\Components\FileUpload::make('image')->image()->imageEditor()->imageEditorMode(2)
                        ->disk('public')->directory($module)
                        ->optimize('webp')
                        ->nullable()
                ])->columnSpan([
                    'sm' => 2,
                    'xl' => 4,
                ]),
            // Components
            Builder::make('components')
                ->label('Content')
                ->blocks([
                    // Accordion
                    Builder\Block::make('accordion')
                        ->icon('heroicon-m-queue-list')
                        ->schema([
                            Forms\Components\Toggle::make('is_active'),
                            Forms\Components\Repeater::make('items')
                                ->schema([
                                    Forms\Components\TextInput::make('title'),
                                    Forms\Components\Textarea::make('content')->autosize(),
                                ])->itemLabel(fn(array $state): ?string => $state['title'] ?? null)
                                ->collapsible()->collapsed(),
                        ]),
                    // Carousel
                    Builder\Block::make('carousel')
                        ->icon('heroicon-o-photo')
                        ->schema([
                            Forms\Components\Toggle::make('is_active'),
                            Forms\Components\Repeater::make('items')
                                ->columns([
                                    'sm' => 1,
                                    'xl' => 12,
                                ])
                                ->schema([
                                    Grid::make()
                                        ->columnSpan([
                                            'sm' => 1,
                                            'xl' => 4,
                                        ])->schema([
                                            Forms\Components\FileUpload::make('image')->image()->imageEditor()->imageEditorMode(2)
                                                ->disk('public')->directory($module)
                                                ->optimize('webp')
                                                ->nullable()
                                                ->columnSpanFull()
                                        ]),
                                    Grid::make()
                                        ->columnSpan([
                                            'sm' => 1,
                                            'xl' => 8,
                                        ])->schema([
                                            Grid::make()
                                                ->columns([
                                                    'sm' => 1,
                                                    'xl' => 12,
                                                ])->schema([
                                                    Forms\Components\TextInput::make('title')->columnSpan([
                                                        'sm' => 1,
                                                        'xl' => 12,
                                                    ]),
                                                    Forms\Components\Textarea::make('content')->autosize()->columnSpan([
                                                        'sm' => 1,
                                                        'xl' => 12,
                                                    ]),
                                                    Forms\Components\TextInput::make('button_label')->columnSpan([
                                                        'sm' => 1,
                                                        'xl' => 6,
                                                    ]),
                                                    Forms\Components\TextInput::make('url')->prefixIcon('heroicon-o-link')->columnSpan([
                                                        'sm' => 1,
                                                        'xl' => 6,
                                                    ]),
                                                ]),
                                        ])
                                ])->itemLabel(fn(array $state): ?string => $state['title'] ?? null)
                                ->collapsible()->collapsed(),
                        ]),
                    // Paragraph
                    Builder\Block::make('paragraph')
                        ->icon('heroicon-c-bars-4')
                        ->schema([
                            Forms\Components\Toggle::make('is_active'),
                            Forms\Components\RichEditor::make('content')->nullable(),
                        ]),
                    // Text & Image
                    Builder\Block::make('text_image')
                        ->icon('heroicon-c-clipboard-document-list')
                        ->columns([
                            'sm' => 1,
                            'xl' => 12,
                        ])->schema([
                            Forms\Components\Toggle::make('is_active')->label(null)->columnSpan([
                                'sm' => 1,
                                'xl' => 4,
                            ]),
                            Forms\Components\Radio::make('position')->inline()->label(false)->options($textImageOptions)
                                ->columnSpan([
                                    'sm' => 1,
                                    'xl' => 8,
                                ]),
                            Forms\Components\FileUpload::make('image')->image()->imageEditor()->imageEditorMode(2)
                                ->disk('public')->directory($module)
                                ->optimize('webp')
                                ->nullable()->columnSpan([
                                    'sm' => 1,
                                    'xl' => 4,
                                ]),
                            Forms\Components\RichEditor::make('content')->nullable()->columnSpan([
                                'sm' => 1,
                                'xl' => 8,
                            ]),
                        ]),
                    // Video Banner
                    Builder\Block::make('video_banner')
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
                                ->placeholder('https://www.youtube.com/watch?v=[YOUR_YOUTUBE_ID]')
                                ->hidden(fn(Get $get) => $get('type') !== 'youtube')
                                ->nullable()->columnSpan([
                                    'sm' => 1,
                                    'xl' => 12,
                                ]),
                            Forms\Components\ViewField::make('youtube_url')
                                ->hidden(fn(Get $get) => $get('type') !== 'youtube')
                                ->view('filament.forms.components.youtube-preview')->columnSpan([
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
                    Forms\Components\Toggle::make('is_default')->columnSpan([
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
                Tables\Columns\ToggleColumn::make('is_default'),
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
}
