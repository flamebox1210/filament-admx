<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum MasterSection: string implements HasLabel
{
    case DANGER = 'danger';
    case GRAY = 'gray';
    case INFO = 'info';
    case PRIMARY = 'primary';
    case SUCCESS = 'success';
    case WARNING = 'warning';

    public function getLabel(): string
    {
        return match ($this) {
            self::DANGER => 'Danger',
            self::GRAY => 'Gray',
            self::INFO => 'Info',
            self::PRIMARY => 'Primary',
            self::SUCCESS => 'Success',
            self::WARNING => 'Warning',
        };
    }
}
