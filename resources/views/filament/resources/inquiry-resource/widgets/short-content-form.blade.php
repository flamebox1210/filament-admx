<x-filament-widgets::widget>
    <x-filament::section
        icon="heroicon-o-document-text"
        collapsible
        collapsed
        persist-collapsed
        id="{{ Str::slug($label) }}"
    >
        <x-slot name="heading">
            {{ $label }}
        </x-slot>
        <form wire:submit="save">
            <div class="mb-5">
                {{ $this->form }}
            </div>
            <x-filament::button type="submit">
                <svg fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                     class="animate-spin fi-btn-icon transition duration-75 h-5 w-5 text-white" x-show="isProcessing"
                     wire:loading>
                    <path clip-rule="evenodd"
                          d="M12 19C15.866 19 19 15.866 19 12C19 8.13401 15.866 5 12 5C8.13401 5 5 8.13401 5 12C5 15.866 8.13401 19 12 19ZM12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                          fill-rule="evenodd" fill="currentColor" opacity="0.2"></path>
                    <path d="M2 12C2 6.47715 6.47715 2 12 2V5C8.13401 5 5 8.13401 5 12H2Z" fill="currentColor"></path>
                </svg>
                {{ __('filament-panels::resources/pages/edit-record.form.actions.save.label') }}
            </x-filament::button>
        </form>
    </x-filament::section>
</x-filament-widgets::widget>
