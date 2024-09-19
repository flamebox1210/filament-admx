<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ComponentBuilderResource\RelationManagers;
use App\Models\ComponentBuilder;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Forms;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Grid;
use Filament\Forms\Get;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class ComponentBuilderResource
{

    public static function defaultComponents($module, $locale)
    {
        $textImageOptions = [
            'left' => 'Image on left',
            'right' => 'Image on right'
        ];

        $videoOptions = [
            'upload' => 'Upload video',
            'youtube' => 'Youtube url'
        ];

        $socialMediaOptions = [
            'facebook' => 'Facebook',
            'x' => 'X',
            'linkedin' => 'Linkedin',
            'instagram' => 'Instagram',
            'youtube' => 'Youtube'
        ];

        return
            Forms\Components\Builder::make('components:' . $locale)
                ->label('components')
                ->blocks([
                    // Banner
                    Block::make('banner')
                        ->icon('heroicon-o-viewfinder-circle')
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
                            CuratorPicker::make('image')->color('gray')
                                ->buttonLabel('Browse')
                                ->maxSize(5240000)
                                ->directory($module)->acceptedFileTypes(['image/jpg', 'image/jpeg', 'image/png', 'image/webp', 'image/svg+xml'])
                                ->nullable()->columnSpan([
                                    'sm' => 1,
                                    'xl' => 4,
                                ]),
                            Forms\Components\TextInput::make('button_label')->columnSpan([
                                'sm' => 1,
                                'xl' => 4,
                            ]),
                            Forms\Components\TextInput::make('url')->prefixIcon('heroicon-o-link')->columnSpan([
                                'sm' => 1,
                                'xl' => 4,
                            ]),
                        ]),
                    // Partners
                    Block::make('partner')->label('Clients')
                        ->icon('heroicon-o-rectangle-group')
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
                            Forms\Components\TextInput::make('info')
                                ->label('')
                                ->prefixIcon('heroicon-o-information-circle')
                                ->placeholder(__('be.info.modular', ['attribute' => 'partners']))->readOnly()

                        ]),
                    // Accordion
                    Block::make('accordion')
                        ->icon('heroicon-o-queue-list')
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
                    // Contact
                    Block::make('contact')
                        ->icon('heroicon-o-phone')
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
                            Grid::make()->columns([
                                'sm' => 1,
                                'xl' => 12,
                            ])->schema([
                                Forms\Components\TextInput::make('title')->columnSpan([
                                    'sm' => 1,
                                    'xl' => 6,
                                ]),
                                Forms\Components\TextInput::make('subtitle')->columnSpan([
                                    'sm' => 1,
                                    'xl' => 6,
                                ]),
                            ]),
                            Grid::make()->schema([
                                Grid::make()->schema([
                                    Forms\Components\Repeater::make('social_media')->columnSpanFull()
                                        ->schema([
                                            Grid::make()->schema([
                                                Forms\Components\Select::make('site')->options($socialMediaOptions)->native(false)->columnSpan([
                                                    'sm' => 1,
                                                    'xl' => 6,
                                                ]),
                                                Forms\Components\TextInput::make('url')->prefixIcon('heroicon-o-link')->columnSpan([
                                                    'sm' => 1,
                                                    'xl' => 6,
                                                ]),
                                            ])
                                        ])->itemLabel(fn(array $state): ?string => $state['site'] ?? null)
                                        ->collapsible()->collapsed(),
                                ])->columnSpan([
                                    'sm' => 1,
                                    'xl' => 4,
                                ]),
                                Grid::make()->schema([
                                    Forms\Components\Repeater::make('phones')->columnSpanFull()
                                        ->schema([
                                            Grid::make()->schema([
                                                Forms\Components\TextInput::make('phone')->columnSpanFull(),
                                            ])->columns([
                                                'sm' => 1,
                                                'xl' => 12,
                                            ])
                                        ])->itemLabel(fn(array $state): ?string => $state['phone'] ?? null)
                                        ->collapsible()->collapsed(),
                                ])->columnSpan([
                                    'sm' => 1,
                                    'xl' => 4,
                                ]),
                                Grid::make()->schema([
                                    Forms\Components\Repeater::make('emails')->columnSpanFull()
                                        ->schema([
                                            Grid::make()->schema([
                                                Forms\Components\TextInput::make('email')->columnSpanFull(),
                                            ])->columns([
                                                'sm' => 1,
                                                'xl' => 12,
                                            ])
                                        ])->itemLabel(fn(array $state): ?string => $state['email'] ?? null)
                                        ->collapsible()->collapsed(),
                                ])->columnSpan([
                                    'sm' => 1,
                                    'xl' => 4,
                                ]),
                                Forms\Components\Textarea::make('embed')->label('Embed maps')->autosize()->columnSpanFull(),
                            ])->columns([
                                'sm' => 1,
                                'xl' => 12,
                            ]),
                        ]),
                    // Carousel
                    Block::make('carousel')->label('Services')
                        ->icon('heroicon-o-swatch')
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
                    // Testimonial
                    Block::make('testimonial')->label('Testimonials')
                        ->icon('heroicon-o-speaker-wave')
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
                                                    Forms\Components\TextInput::make('youtube_url')->url()
                                                        ->prefixIcon('heroicon-o-link')
                                                        ->placeholder('https://www.youtube.com/watch?v=[YOUR_YOUTUBE_ID]')
                                                        ->nullable()->columnSpan([
                                                            'sm' => 1,
                                                            'xl' => 12,
                                                        ]),
                                                    Forms\Components\ViewField::make('youtube_url')
                                                        ->view('filament.forms.components.youtube-preview')->columnSpan([
                                                            'sm' => 1,
                                                            'xl' => 12,
                                                        ]),
                                                ]),
                                        ])
                                ])->itemLabel(fn(array $state): ?string => $state['title'] ?? null)
                                ->collapsible()->collapsed(),
                        ]),
                    // Paragraph
                    Block::make('paragraph')
                        ->icon('heroicon-c-bars-4')
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
                            TinyEditor::make('content')
                                ->profile('simple')->language(app()->getLocale())->nullable(),
                        ]),
                    // Text & Image
                    Block::make('text_image')
                        ->icon('heroicon-c-clipboard-document-list')
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
                    // Video Banner
                    Block::make('video_banner')
                        ->icon('heroicon-o-video-camera')
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
                ])->collapsible()->collapsed()->cloneable();
    }

    public static function articleComponents($module, $locale)
    {

        $videoOptions = [
            'upload' => 'Upload video',
            'youtube' => 'Youtube url'
        ];

        return
            Forms\Components\Builder::make('components:' . $locale)
                ->label('Content')
                ->blocks([
                    // Paragraph
                    Block::make('paragraph')
                        ->icon('heroicon-c-bars-4')
                        ->schema([
                            Forms\Components\Toggle::make('is_active')->onColor('success')->offColor(null)->onIcon('heroicon-o-check'),
                            TinyEditor::make('content')
                                ->profile('simple')->language(app()->getLocale())->nullable(),
                        ]),
                    // Image
                    Block::make('image')
                        ->icon('heroicon-o-photo')
                        ->schema([
                            Forms\Components\Toggle::make('is_active')->onColor('success')->offColor(null)->onIcon('heroicon-o-check'),
                            CuratorPicker::make('image')->color('gray')
                                ->buttonLabel('Browse')
                                ->maxSize(5240000)
                                ->directory($module)->acceptedFileTypes(['image/jpg', 'image/jpeg', 'image/png', 'image/webp', 'image/svg+xml'])
                                ->nullable()
                        ]),
                    // Video
                    Block::make('video')
                        ->icon('heroicon-o-video-camera')
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
                        ->schema([
                            Forms\Components\Toggle::make('is_active')->onColor('success')->offColor(null)->onIcon('heroicon-o-check')->columnSpan([
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
                ])->collapsible()->collapsed()->cloneable();
    }
}
