<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum TemplatePage: string implements HasLabel
{
    case HOME = 'home';
    case FLEXY = 'flexy';
    case ARTICLE = 'articles';
    case PARTNER = 'partners';

    public function getLabel(): string
    {
        return match ($this) {
            self::HOME => 'Home',
            self::FLEXY => 'Flexy',
            self::ARTICLE => 'Article',
            self::PARTNER => 'Partner',
        };
    }
}
