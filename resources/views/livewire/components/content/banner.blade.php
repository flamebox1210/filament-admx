<div>
    <section id="{{ $data['anchor'] }}" class="{{ $query['type'] }} bg-white relative z-20">
        <div class="h-screen overflow-hidden relative">
            <div class="bg-neutral-900 opacity-50 w-screen h-screen absolute top-0 left-0 right-0 z-10"></div>
            @if($this->media)
                <img src="{{ Storage::disk('public')->url($media['path']) }}" alt="{{ $data['title'] }}"
                     class="absolute top-0 left-0 right-0 object-cover h-full w-full"/>
            @endif
            <div class="justify-center items-center relative z-20 text-center max-w-3xl mx-auto top-[45%]">
                <h1 class="text-white font-bold text-5xl leading-tight mb-10">{{ $data['title'] }}</h1>
                @if($data['url'])
                    <div class="max-w-[300px] mx-auto">
                        <a class="block transition duration-200 py-5 px-10 bg-fe-secondary hover:bg-fe-primary scale-100 hover:scale-[1.1] text-white text-center font-font-semibold uppercase rounded-md shadow-md"
                           href="{{ $data['url'] }}">{{ $data['button_label'] }}</a>
                    </div>
                @endif
            </div>
        </div>
    </section>
</div>
