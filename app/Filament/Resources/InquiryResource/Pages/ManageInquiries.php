<?php

namespace App\Filament\Resources\InquiryResource\Pages;

use App\Filament\Exports\InquiryExporter;
use App\Filament\Imports\InquiryImporter;
use App\Filament\Resources\InquiryResource;
use AymanAlhattami\FilamentContextMenu\Actions\GoBackAction;
use AymanAlhattami\FilamentContextMenu\Actions\GoForwardAction;
use AymanAlhattami\FilamentContextMenu\Actions\RefreshAction;
use AymanAlhattami\FilamentContextMenu\ContextMenuDivider;
use AymanAlhattami\FilamentContextMenu\Traits\PageHasContextMenu;
use Filament\Actions\ExportAction;
use Filament\Actions\ImportAction;
use Filament\Resources\Pages\ManageRecords;

class ManageInquiries extends ManageRecords
{
    use PageHasContextMenu;

    protected static string $resource = InquiryResource::class;

    public function getContextMenuActions(): array
    {
        return [
            GoBackAction::make(),
            GoForwardAction::make(),
            RefreshAction::make(),
            ContextMenuDivider::make(),
            ExportAction::make()
                ->exporter(InquiryExporter::class)->color('success')
                ->icon('heroicon-o-arrow-down-tray'),
            ImportAction::make()
                ->importer(InquiryImporter::class)->color('primary')
                ->icon('heroicon-o-arrow-top-right-on-square'),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            InquiryResource\Widgets\ShortContentForm::class,
        ];
    }
}
