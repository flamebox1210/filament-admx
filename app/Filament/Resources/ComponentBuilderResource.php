<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ComponentBuilderResource\RelationManagers;
use App\Models\ComponentBuilder;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Grid;
use Filament\Forms\Get;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class ComponentBuilderResource
{

    public static function defaultComponents($module)
    {
        $partnerOptions = [
            'short' => 'Short data',
            'full' => 'All data'
        ];

        return
            Forms\Components\Builder::make('components')
                ->blocks([
                    // Accordion
                    Block::make('accordion')
                        ->icon('heroicon-o-queue-list')
                        ->label(function (?array $state): string {
                            if ($state === null) {
                                return 'Accordion';
                            }

                            return $state['title'] ?? 'Accordion';
                        })
                        ->schema([
                            Grid::make()->columns([
                                'sm' => 1,
                                'xl' => 12,
                            ])->schema([
                                Forms\Components\Toggle::make('is_active')->onColor('success')->offColor(null)->onIcon('heroicon-o-check')->label(null)->columnSpan([
                                    'sm' => 1,
                                    'xl' => 2,
                                ]),
                                Forms\Components\TextInput::make('anchor')->prefix('#')->columnSpan([
                                    'sm' => 1,
                                    'xl' => 10,
                                ]),
                            ]),
                            Forms\Components\TextInput::make('title'),
                            Forms\Components\Repeater::make('items')
                                ->schema([
                                    Forms\Components\TextInput::make('title'),
                                    Forms\Components\Textarea::make('content')->autosize(),
                                ])->itemLabel(fn(array $state): ?string => $state['title'] ?? null)
                                ->collapsible()->collapsed(),
                        ]),
                    // Carousel
                    Block::make('carousel')
                        ->icon('heroicon-o-swatch')
                        ->label(function (?array $state): string {
                            if ($state === null) {
                                return 'Carousel';
                            }

                            return $state['title'] ?? 'Carousel';
                        })
                        ->schema([
                            Grid::make()->columns([
                                'sm' => 1,
                                'xl' => 12,
                            ])->schema([
                                Forms\Components\Toggle::make('is_active')->onColor('success')->offColor(null)->onIcon('heroicon-o-check')->label(null)->columnSpan([
                                    'sm' => 1,
                                    'xl' => 2,
                                ]),
                                Forms\Components\TextInput::make('anchor')->prefix('#')->columnSpan([
                                    'sm' => 1,
                                    'xl' => 10,
                                ]),
                            ]),
                            Forms\Components\TextInput::make('title')->columnSpanFull(),
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
                                            CuratorPicker::make('image')->color('gray')
                                                ->buttonLabel('Browse')
                                                ->maxSize(5240000)
                                                ->directory($module)->acceptedFileTypes(['image/jpg', 'image/jpeg', 'image/png', 'image/webp', 'image/svg+xml'])
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
                    // Partners
                    Block::make('partner')->label('Partners')
                        ->icon('heroicon-o-rectangle-group')
                        ->label(function (?array $state): string {
                            if ($state === null) {
                                return 'Partners';
                            }

                            return $state['title'] ?? 'Partners';
                        })
                        ->schema([
                            Grid::make()->columns([
                                'sm' => 1,
                                'xl' => 12,
                            ])->schema([
                                Forms\Components\Toggle::make('is_active')->onColor('success')->offColor(null)->onIcon('heroicon-o-check')->label(null)->columnSpan([
                                    'sm' => 1,
                                    'xl' => 2,
                                ]),
                                Forms\Components\TextInput::make('anchor')->prefix('#')->columnSpan([
                                    'sm' => 1,
                                    'xl' => 10,
                                ]),
                            ]),
                            Forms\Components\Select::make('type')->options($partnerOptions)->native(false),
                            Forms\Components\TextInput::make('title'),
                            Forms\Components\TextInput::make('info')
                                ->label('')
                                ->prefixIcon('heroicon-o-information-circle')
                                ->placeholder(__('be.info.modular', ['attribute' => 'partners']))->readOnly()

                        ]),
                    // Testimonials
                    Block::make('testimonials')
                        ->icon('heroicon-o-speaker-wave')
                        ->label(function (?array $state): string {
                            if ($state === null) {
                                return 'Testimonials';
                            }

                            return $state['title'] ?? 'Testimonials';
                        })
                        ->schema([
                            Grid::make()->columns([
                                'sm' => 1,
                                'xl' => 12,
                            ])->schema([
                                Forms\Components\Toggle::make('is_active')->onColor('success')->offColor(null)->onIcon('heroicon-o-check')->label(null)->columnSpan([
                                    'sm' => 1,
                                    'xl' => 2,
                                ]),
                                Forms\Components\TextInput::make('anchor')->prefix('#')->columnSpan([
                                    'sm' => 1,
                                    'xl' => 10,
                                ]),
                            ]),
                            Forms\Components\TextInput::make('title')->columnSpanFull(),
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
                                            CuratorPicker::make('image')->color('gray')
                                                ->buttonLabel('Browse')
                                                ->maxSize(5240000)
                                                ->directory($module)->acceptedFileTypes(['image/jpg', 'image/jpeg', 'image/png', 'image/webp', 'image/svg+xml'])
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
                                                    Forms\Components\TextInput::make('name')->columnSpan([
                                                        'sm' => 1,
                                                        'xl' => 6,
                                                    ]),
                                                    Forms\Components\TextInput::make('position')->columnSpan([
                                                        'sm' => 1,
                                                        'xl' => 6,
                                                    ]),
                                                    Forms\Components\Textarea::make('content')->autosize()->columnSpan([
                                                        'sm' => 1,
                                                        'xl' => 12,
                                                    ])
                                                ]),
                                        ])
                                ])->itemLabel(fn(array $state): ?string => $state['title'] ?? null)
                                ->collapsible()->collapsed(),
                        ]),
                ])->columnSpan([
                    'sm' => 1,
                    'xl' => 12,
                ])
                ->deleteAction(
                    fn(Action $action) => $action->requiresConfirmation(),
                )
                ->collapsible()->collapsed()->cloneable()->blockIcons(true)
                ->blockNumbers(false);
    }


    public static function flexyComponents($module)
    {
        $textImageOptions = [
            'left' => 'Image on left',
            'right' => 'Image on right'
        ];

        $videoOptions = [
            'upload' => 'Upload video',
            'youtube' => 'Youtube url'
        ];

        return
            Forms\Components\Builder::make('components')
                ->blocks([
                    // Paragraph
                    Block::make('paragraph')
                        ->icon('heroicon-c-bars-4')
                        ->label(function (?array $state): string {
                            if ($state === null) {
                                return 'Paragraph';
                            }

                            return $state['title'] ?? 'Paragraph';
                        })
                        ->schema([
                            Grid::make()->columns([
                                'sm' => 1,
                                'xl' => 12,
                            ])->schema([
                                Forms\Components\Toggle::make('is_active')->onColor('success')->offColor(null)->onIcon('heroicon-o-check')->label(null)->columnSpan([
                                    'sm' => 1,
                                    'xl' => 2,
                                ]),
                                Forms\Components\TextInput::make('anchor')->prefix('#')->columnSpan([
                                    'sm' => 1,
                                    'xl' => 10,
                                ]),
                            ]),
                            Forms\Components\TextInput::make('title')->columnSpanFull(),
                            TinyEditor::make('content')
                                ->profile('simple')->language(app()->getLocale())->nullable(),
                        ]),
                    // Text & Image
                    Block::make('text_image')
                        ->icon('heroicon-c-clipboard-document-list')
                        ->label(function (?array $state): string {
                            if ($state === null) {
                                return 'Text & image';
                            }

                            return $state['title'] ?? 'Text & image';
                        })
                        ->columns([
                            'sm' => 1,
                            'xl' => 12,
                        ])->schema([
                            Grid::make()->columns([
                                'sm' => 1,
                                'xl' => 12,
                            ])->schema([
                                Forms\Components\Toggle::make('is_active')->onColor('success')->offColor(null)->onIcon('heroicon-o-check')->label(null)->columnSpan([
                                    'sm' => 1,
                                    'xl' => 2,
                                ]),
                                Forms\Components\TextInput::make('anchor')->prefix('#')->columnSpan([
                                    'sm' => 1,
                                    'xl' => 10,
                                ]),
                            ]),
                            Forms\Components\TextInput::make('title')->columnSpanFull(),
                            Grid::make()->schema([
                                CuratorPicker::make('image')->color('gray')
                                    ->buttonLabel('Browse')
                                    ->maxSize(5240000)
                                    ->directory($module)->acceptedFileTypes(['image/jpg', 'image/jpeg', 'image/png', 'image/webp', 'image/svg+xml'])
                                    ->nullable()->columnSpan([
                                        'sm' => 1,
                                        'xl' => 12,
                                    ]),
                                Forms\Components\TextInput::make('button_label')->columnSpan([
                                    'sm' => 1,
                                    'xl' => 12,
                                ]),
                                Forms\Components\TextInput::make('url')->prefixIcon('heroicon-o-link')->columnSpan([
                                    'sm' => 1,
                                    'xl' => 12,
                                ]),
                            ])->columnSpan([
                                'sm' => 1,
                                'xl' => 4,
                            ]),
                            Grid::make()->schema([
                                Forms\Components\Radio::make('position')->inline()->label(false)->options($textImageOptions)
                                    ->columnSpan([
                                        'sm' => 1,
                                        'xl' => 12,
                                    ]),
                                Forms\Components\TextInput::make('title')->columnSpan([
                                    'sm' => 1,
                                    'xl' => 12,
                                ]),
                                TinyEditor::make('content')
                                    ->profile('simple')->language(app()->getLocale())->nullable()->columnSpan([
                                        'sm' => 1,
                                        'xl' => 12,
                                    ]),
                            ])
                                ->columnSpan([
                                    'sm' => 1,
                                    'xl' => 8,
                                ]),
                        ]),
                    // Video
                    Block::make('video')
                        ->icon('heroicon-o-video-camera')
                        ->label(function (?array $state): string {
                            if ($state === null) {
                                return 'Video';
                            }

                            return $state['title'] ?? 'Video';
                        })
                        ->columns([
                            'sm' => 1,
                            'xl' => 12,
                        ])
                        ->schema([
                            Grid::make()->columns([
                                'sm' => 1,
                                'xl' => 12,
                            ])->schema([
                                Forms\Components\Toggle::make('is_active')->onColor('success')->offColor(null)->onIcon('heroicon-o-check')->label(null)->columnSpan([
                                    'sm' => 1,
                                    'xl' => 2,
                                ]),
                                Forms\Components\TextInput::make('anchor')->prefix('#')->columnSpan([
                                    'sm' => 1,
                                    'xl' => 10,
                                ]),
                            ]),
                            Forms\Components\TextInput::make('title')->columnSpanFull(),
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
                ])
                ->deleteAction(
                    fn(Action $action) => $action->requiresConfirmation(),
                )
                ->collapsible()->collapsed()->cloneable()->blockIcons(true)
                ->blockNumbers(false);
    }

    public static function articleComponents($module)
    {

        $videoOptions = [
            'upload' => 'Upload video',
            'youtube' => 'Youtube url'
        ];

        return
            Forms\Components\Builder::make('components')
                ->blocks([
                    // Paragraph
                    Block::make('paragraph')
                        ->icon('heroicon-c-bars-4')
                        ->label(function (?array $state): string {
                            if ($state === null) {
                                return 'Paragraph';
                            }

                            return $state['title'] ?? 'Paragraph';
                        })
                        ->schema([
                            Forms\Components\Toggle::make('is_active')->onColor('success')->offColor(null)->onIcon('heroicon-o-check'),
                            Forms\Components\TextInput::make('title')->columnSpanFull(),
                            TinyEditor::make('content')
                                ->profile('simple')->language(app()->getLocale())->nullable(),
                        ]),
                    // Image
                    Block::make('image')
                        ->icon('heroicon-o-photo')
                        ->label(function (?array $state): string {
                            if ($state === null) {
                                return 'Image';
                            }

                            return $state['title'] ?? 'Image';
                        })
                        ->schema([
                            Forms\Components\Toggle::make('is_active')->onColor('success')->offColor(null)->onIcon('heroicon-o-check'),
                            Forms\Components\TextInput::make('title')->columnSpanFull(),
                            CuratorPicker::make('image')->color('gray')
                                ->buttonLabel('Browse')
                                ->maxSize(5240000)
                                ->directory($module)->acceptedFileTypes(['image/jpg', 'image/jpeg', 'image/png', 'image/webp', 'image/svg+xml'])
                                ->nullable()
                        ]),
                    // Video
                    Block::make('video')
                        ->icon('heroicon-o-video-camera')
                        ->label(function (?array $state): string {
                            if ($state === null) {
                                return 'Video';
                            }

                            return $state['title'] ?? 'Video';
                        })
                        ->columns([
                            'sm' => 1,
                            'xl' => 12,
                        ])
                        ->schema([
                            Forms\Components\Toggle::make('is_active')->onColor('success')->offColor(null)->onIcon('heroicon-o-check')->label(null)->columnSpan([
                                'sm' => 1,
                                'xl' => 4,
                            ]),
                            Forms\Components\Radio::make('type')->inline()->label(false)->options($videoOptions)
                                ->reactive()
                                ->columnSpan([
                                    'sm' => 1,
                                    'xl' => 8,
                                ]),
                            Forms\Components\TextInput::make('title')->columnSpanFull(),
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
                    Block::make('quote')
                        ->icon('heroicon-o-chat-bubble-oval-left')
                        ->label(function (?array $state): string {
                            if ($state === null) {
                                return 'Quote';
                            }

                            return 'Quote | ' . $state['title'] ?? 'Quote';
                        })
                        ->schema([
                            Forms\Components\Toggle::make('is_active')->onColor('success')->offColor(null)->onIcon('heroicon-o-check')->columnSpan([
                                'sm' => 1,
                                'xl' => 12,
                            ]),
                            Forms\Components\TextInput::make('title')->columnSpanFull(),
                            Forms\Components\TextInput::make('name')->columnSpan([
                                'sm' => 1,
                                'xl' => 6,
                            ]),
                            Forms\Components\TextInput::make('role')->columnSpan([
                                'sm' => 1,
                                'xl' => 6,
                            ]),
                            Forms\Components\Textarea::make('content')->autosize()->columnSpan([
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
                ])
                ->deleteAction(
                    fn(Action $action) => $action->requiresConfirmation(),
                )->collapsible()->collapsed()->cloneable();
    }
}
