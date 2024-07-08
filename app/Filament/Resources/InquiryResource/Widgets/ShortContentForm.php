<?php

namespace App\Filament\Resources\InquiryResource\Widgets;

use App\Models\Master;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Concerns\Translatable;
use Filament\Support\Exceptions\Halt;
use Filament\Widgets\Widget;
use Illuminate\Database\Eloquent\Model;

class ShortContentForm extends Widget implements HasForms
{
    use InteractsWithForms, Translatable;

    protected static string $view = 'filament.resources.inquiry-resource.widgets.short-content-form';
    public ?Model $record = null;
    public ?array $data = [];
    public $label = 'Short content';
    protected int|string|array $columnSpan = 'full';

    public function mount(): void
    {
        try {
            $this->record = Master::first();
            if ($this->record) {
                $this->form->fill($this->record->toArray());
            }

        } catch (Halt $exception) {
            return;
        }
    }

    public function form(Form $form): Form
    {

        return $form->columns([
            'sm' => 2,
            'xl' => 12,
        ])->schema([
            Forms\Components\Hidden::make('id')->required(),
            Forms\Components\TextInput::make('title')->required()->columnSpan([
                'sm' => 2,
                'xl' => 12,
            ]),
            Forms\Components\Textarea::make('content')->label('Description')->rows(5)->autosize()->nullable()->columnSpan([
                'sm' => 2,
                'xl' => 12,
            ]),
        ])->statePath('data');
    }

    /**
     * @return void
     */
    public function save(): void
    {
        Master::updateOrCreate(['id' => $this->data['id']], $this->data);
        Notification::make()
            ->title('Saved')
            ->success()
            ->send();
    }
}
