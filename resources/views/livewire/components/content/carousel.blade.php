<div>
    <section id="{{ $data['anchor'] }}" class="{{ $query['type'] }} bg-neutral-200 relative z-20 py-10">
        <h1 class="text-fe-primary font-bold text-4xl leading-tight mb-10 text-center">{{ $data['title'] }}</h1>
        <div class="max-w-[1200px] mx-auto">
            <div class="lg:grid lg:grid-cols-3 lg:gap-6">
                @foreach($items as $item)
                    <div class="text-center relative mb-10 lg:mb-5">
                        <div class="mb-4">
                            <img src="{{ $item['image_path'] }}" class="max-w-20 rounded-full mx-auto"
                                 alt="{{ $item['title'] }}"/>
                        </div>
                        <div class="mb-5 lg:mb-20 px-8 lg:px-0">
                            <div class="lg:max-w-60 mx-auto">
                                <h3 class="font-semibold text-lg text-fe-secondary mb-3 mx-auto">{{ $item['title'] }}</h3>
                            </div>
                            <p>{{ $item['content'] }}</p>
                        </div>
                        @if($item['url'])
                            <div class="max-w-[150px] mx-auto lg:absolute lg:bottom-0 lg:left-0 lg:right-0">
                                <a class="block transition duration-200 py-2 px-3 text-sm bg-neutral-900 hover:bg-neutral-700 scale-100 hover:scale-[1.1] text-white text-center font-font-semibold uppercase rounded-md shadow-md"
                                   href="{{ $item['url'] }}">{{ $item['button_label'] }}</a>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
