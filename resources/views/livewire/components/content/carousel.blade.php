<div wire:id="{{ $id }}">
    <section id="{{ $data['anchor'] }}" class="{{ $query['type'] }}">
        <div class="swiper swiper-carousel">
            <div class="swiper-wrapper bg-black">
                @foreach($items as $key => $item)
                    <div class="swiper-slide h-screen w-full">
                        <div>
                            <div
                                class="max-w-[90%] lg:max-w-[50%] absolute lg:top-72 lg:left-32 text-center lg:text-left">
                                <div class="relative z-20">
                                    <div>
                                        <h5 class="mx-auto text-md tracking-wider font-semibold text-black uppercase mb-5">{{ $item['subtitle'] }}</h5>
                                        <h1 class="mx-auto text-4xl lg:text-7xl font-light text-white mb-5">{{ $item['title'] }}</h1>
                                        <p class=" w-full text-lg text-neutral-300">{{ $item['content'] }}</p>
                                    </div>
                                    <div class="flex gap-4 items-center">
                                        @if($item['button_label'])
                                            <div class="mt-10">
                                                <livewire:components.ui.button type="url"
                                                                               label="{{ $item['button_label'] }}"
                                                                               url="{{ $item['url'] }}"
                                                                               target="_blank"/>
                                            </div>
                                        @endif
                                        @if($item['button_label_secondary'])
                                            <div class="mt-10">
                                                <livewire:components.ui.button type="url"
                                                                               label="{{ $item['button_label_secondary'] }}"
                                                                               url="{{ $item['url_secondary'] }}"
                                                                               target="_blank"/>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div
                                class="bg-gradient-to-t from-black/75 to-transparent absolute left-0 right-0 bottom-0 z-0 h-screen w-full"></div>
                            <img class="w-full object-cover h-screen" src="{{ $item['image_path'] }}"/>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- pagination -->
            <div class="swiper-pagination"></div>
        </div>
    </section>
</div>
