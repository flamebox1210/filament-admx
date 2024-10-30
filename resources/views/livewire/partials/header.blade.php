<div x-data="{open : false}">
    <header class="bg-white fixed shadow-lg top-0 w-full z-30 py-5 lg:py-0" :class="open ? 'h-full' : ''">
        <div class="lg:max-w-full px-5 lg:px-10 mx-auto">
            <div class="lg:grid lg:grid-cols-3 lg:gap-6 items-center">
                <div>
                    <a href="{{ route('fe.index') }}">
                        <img src="{{ asset('logo.svg') }}" class="max-h-[40px] lg:max-h-[30px]"/>
                    </a>
                </div>
                <div class="lg:col-span-2">
                    <div class="hidden lg:block">
                        <ul class="flex flex-row gap-4 justify-end text-xs tracking-wide">
                            @if($navigations)
                                @foreach($navigations as $navigation)
                                    @if($navigation['children'])
                                        <li x-data="{ open: false }"
                                            @mouseover="open = true"
                                            @mouseleave="open = false"
                                            @class([
                                                "relative font-bold h-16 px-4 uppercase before:content-['&nbsp;'] before:block before:transition-all before:ease-in-out before:duration-200 before:w-0 hover:before:w-full before:h-0.5 before:bg-fe-primary before:absolute before:bottom-3 before:left-0",
                                                'text-fe-primary' => Str::slug($navigation['title']) === request('slug')
                                            ]) >
                                            <a class="text-black hover:text-fe-primary pt-6 flex relative"
                                               target="{{ $navigation['target'] }}"
                                               href="{{ $navigation['final_url'] }}">{{ $navigation['title'] }}
                                                <svg class="ml-2 w-[15px]" xmlns="http://www.w3.org/2000/svg"
                                                     fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                     stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="m19.5 8.25-7.5 7.5-7.5-7.5"/>
                                                </svg>

                                            </a>
                                            <ul x-show="open"
                                                x-transition
                                                :class="open ? '' : 'hidden'"
                                                class="absolute top-16 left-0 min-w-[250px] bg-white shadow-lg border border-neutral-300 border-t-0 border-l-2 border-l-fe-primary">
                                                @foreach($navigation['children'] as $children)
                                                    <li class="border-b border-b-neutral-100 hover:bg-neutral-200">
                                                        <a class="block p-5 py-3 text-black hover:text-fe-primary"
                                                           target="{{ $children['target'] }}"
                                                           href="{{ $children['final_url'] }}">{{ $children['title'] }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @else
                                        <li @class([
                                        "relative font-bold h-16 px-4 uppercase before:content-['&nbsp;'] before:block before:transition-all before:ease-in-out before:duration-200 before:w-0 hover:before:w-full before:h-0.5 before:bg-fe-primary before:absolute before:bottom-3 before:left-0",
                                        'text-black' => Str::slug($navigation['title']) == request('slug')
                                        ]) >
                                            <a class="text-black hover:text-fe-primary pt-6 flex"
                                               target="{{ $navigation['target'] }}"
                                               href="{{ $navigation['final_url'] }}">{{ $navigation['title'] }}</a>
                                            <div
                                                class="opacity-0 group-hover:opacity-100 transition duration-200 ease-in-out absolute bottom-2 left-0 bg-fe-primary h-1 w-full"></div>
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        {{-- Mobile--}}
        <div class="block lg:hidden">
            <div @click="open = !open" class="cursor-pointer absolute right-7 top-7 z-20">
                <div x-show="!open">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                    </svg>
                </div>
                <div x-show="open">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
                    </svg>
                </div>
            </div>
            <ul x-show="open"
                class="relative top-4 text-xs tracking-wide">
                @if($navigations)
                    @foreach($navigations as $navigation)
                        @if($navigation['children'])
                            <li x-data="{ open: false }"
                                @click="open = !open"
                                @class([
                                    'relative font-bold py-4 px-6 relative uppercase border-b border-b-neutral-300',
                                    'text-black' => Str::slug($navigation['title']) === request('slug')
                                ]) >
                                <a
                                    target="{{ $navigation['target'] }}"
                                    href="#">
                                    <span
                                        :class="open ? 'text-fe-primary' : 'text-black'">
                                    {{ $navigation['title'] }}
                               </span>
                                    <div class="absolute right-5 top-4">
                                        <div x-show="!open">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="w-[15px]">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M12 4.5v15m7.5-7.5h-15"/>
                                            </svg>
                                        </div>
                                        <div x-show="open">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="w-[15px]">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14"/>
                                            </svg>
                                        </div>
                                    </div>
                                </a>
                                <div x-show="open"
                                     x-transition
                                     class="relative"
                                     :class="open ? '' : 'hidden'"
                                >
                                    <span class="absolute left-0 -top-1 h-[100%] w-[1px] bg-neutral-400"></span>
                                    <ul class="mt-5 min-w-[250px]">
                                        @foreach($navigation['children'] as $children)
                                            <li>
                                                <a class="block p-5 py-3 text-black hover:text-fe-primary"
                                                   target="{{ $children['target'] }}"
                                                   href="{{ $children['final_url'] }}">{{ $children['title'] }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                        @else
                            <li @class([
                                        'relative font-bold py-4 px-6 uppercase border-b border-b-neutral-300',
                                        'text-black' => Str::slug($navigation['title']) == request('slug')
                                        ]) >
                                <a class="text-black hover:text-fe-primary"
                                   target="{{ $navigation['target'] }}"
                                   href="{{ $navigation['final_url'] }}">{{ $navigation['title'] }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            </ul>
        </div>
    </header>
</div>
