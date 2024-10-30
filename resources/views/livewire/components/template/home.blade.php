<div>
    @if($page['components'])
        @foreach($page['components'] as $key => $component)
            @if($component['data']['is_active'])
                @livewire('components.content.'.$component['type'],['query' => $component, 'page' => $page ], key($key))
            @endif
        @endforeach
    @endif
</div>
