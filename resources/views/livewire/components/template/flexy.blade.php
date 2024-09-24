<div>
    @if($media)
        <div class="max-h-[80vh] overflow-hidden relative">
            <img src="{{ Storage::disk('public')->url($media->path) }}" alt="{{ $media->caption }}"
                 class="object-cover h-full w-full object-top"/>
            <div
                class="absolute left-0 right-0 top-[50%] max-w-[1200px] mx-auto items-center justify-center text-center">
                <h1 class="text-4xl font-semibold text-white mb-2 drop-shadow-lg">{{ $page->title }}</h1>
                @if($page->content)
                    <div class="content-area text-white  drop-shadow-lg">{!! $page->content  !!}</div>
                @endif
            </div>
        </div>
    @else
        <div class="mt-32 mx-auto px-8 lg:px-0 lg:max-w-[960px]">
            <h1 class="text-4xl text-fe-primary font-semibold">{{ $page->title }}</h1>
        </div>
    @endif
    @if($page['components:'.app()->currentLocale()])
        <div class="py-10 mx-auto px-8 lg:px-0 lg:max-w-[960px]">
            @foreach($page['components:'.app()->currentLocale()] as $key => $component)
                @if($component['data']['is_active'])
                    @livewire('components.content.'.$component['type'],['query' => $component, 'page' => $page ],
                    key($key))
                @endif
            @endforeach
        </div>
    @endif
</div>
