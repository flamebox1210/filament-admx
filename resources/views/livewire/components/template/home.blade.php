<div>
    @if($page['components:'.app()->currentLocale()])
        @foreach($page['components:'.app()->currentLocale()] as $key => $component)
            @if($component['data']['is_active'])
                @livewire('components.content.'.$component['type'],['query' =>$component ], key($key))
            @endif
        @endforeach
    @endif
</div>
