<?php

namespace App\Filament\Imports;

use App\Models\Inquiry;
use Carbon\CarbonInterface;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class InquiryImporter extends Importer
{
    protected static ?string $model = Inquiry::class;

    /**
     * @return array|ImportColumn[]
     */
    public static function getColumns(): array
    {
        return [
            ImportColumn::make('name')->rules(['required']),
            ImportColumn::make('email')->rules(['required', 'email']),
            ImportColumn::make('phone')->ignoreBlankState(),
            ImportColumn::make('subject')->ignoreBlankState(),
            ImportColumn::make('message')->ignoreBlankState(),
        ];
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your inquiry import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }

    /**
     * @return string[]
     */
    public function getValidationMessages(): array
    {
        return [
            'name.required' => 'The name column must not be empty.',
            'email.required' => 'The email column must not be empty.',
        ];
    }

    /**
     * @return CarbonInterface|null
     */
    public function getJobRetryUntil(): ?CarbonInterface
    {
        return now()->addSeconds(5);
    }

    /**
     * @return string|null
     */
    public function getJobQueue(): ?string
    {
        return 'imports';
    }

    /**
     * @return Inquiry|null
     */
    public function resolveRecord(): ?Inquiry
    {
        // return Inquiry::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new Inquiry();
    }
}
