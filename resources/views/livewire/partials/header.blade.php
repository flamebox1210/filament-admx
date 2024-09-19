<div>
    <header class="bg-white shadow-lg fixed top-0 w-full z-30">
        <div class="lg:max-w-[1200px] px-5 lg:px-0 mx-auto py-3">
            <div class="lg:grid lg:grid-cols-3 lg:gap-6 items-center">
                <div>
                    <a href="{{ __('fe.index') }}">
                        <img src="{{ asset('logo.png') }}" class="max-w-[280px]"/>
                    </a>
                </div>
                <div class="col-span-2">
                    <ul class="flex flex-row gap-14 pt-5 justify-end">
                        @if($navigations)
                            @foreach($navigations as $navigation)
                                @if($navigation['children'])
                                    <li x-data="{ open: false }"
                                        @mouseover="open = true"
                                        @mouseleave="open = false"
                                        @class([
                                            'relative font-medium h-12 px-4 relative',
                                            'text-black' => Str::slug($navigation['title']) === request('slug')
                                        ]) >
                                        <a class="text-neutral-700 hover:text-fe-primary relative"
                                           target="{{ $navigation['target'] }}"
                                           href="{{ $navigation['final_url'] }}">{{ $navigation['title'] }}
                                            <svg class="absolute -right-6 top-1 max-w-[15px]"
                                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="m19.5 8.25-7.5 7.5-7.5-7.5"/>
                                            </svg>
                                        </a>
                                        <ul x-show="open" x-transition :class="open ? '' : 'hidden'"
                                            class="absolute top-12 left-0 min-w-[250px] bg-white shadow-lg border border-t-4 border-neutral-300 border-t-fe-primary">
                                            @foreach($navigation['children'] as $children)
                                                <li class="border-b border-b-neutral-100 hover:bg-neutral-200">
                                                    <a class="block p-5 py-3 text-neutral-700"
                                                       target="{{ $children['target'] }}"
                                                       href="{{ $children['final_url'] }}">{{ $children['title'] }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @else
                                    <li @class([
                                        'relative font-medium h-12 px-4 group',
                                        'text-black' => Str::slug($navigation['title']) == request('slug')
                                        ]) >
                                        <a class="text-neutral-700 hover:text-fe-primary"
                                           target="{{ $navigation['target'] }}"
                                           href="{{ $navigation['final_url'] }}">{{ $navigation['title'] }}</a>
                                        <div
                                            class="opacity-0 group-hover:opacity-100 transition duration-200 ease-in-out absolute bottom-2 left-0 bg-fe-primary h-1 w-full"></div>
                                    </li>
                                @endif
                            @endforeach
                            <li>
                                <div class="cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/>
                                    </svg>
                                </div>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </header>
</div>
