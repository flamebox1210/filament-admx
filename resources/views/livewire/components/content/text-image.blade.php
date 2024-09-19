<div>
    <section class="{{ $query['type'] }}">
        <div class="py-10 overflow-hidden relative">
            @if($this->media)
                <img src="{{ Storage::disk('public')->url($media['path']) }}" alt="{{ $data['title'] }}"
                     class="fixed top-0 left-0 right-0 object-cover h-full w-full"/>
            @endif
            <div class="px-5 lg:px-0">
                <div
                    class="justify-center items-center relative z-20 text-center lg:max-w-2xl mx-auto top-[15%] bg-gradient-to-b from-neutral-100/80 to-fe-secondary/80 p-10 rounded-xl">
                    <h1 class="text-fe-primary font-bold text-5xl leading-tight mb-10">{{ $data['title'] }}</h1>
                    <div class="text-lg leding-normal mb-8">
                        {!! $data['content'] !!}
                    </div>
                    @if($data['url'])
                        <div class="max-w-[200px] mx-auto">
                            <a class="block transition duration-200 py-2 px-3 text-sm bg-neutral-900 hover:bg-neutral-700 scale-100 hover:scale-[1.1] text-white text-center font-font-semibold uppercase rounded-md shadow-md"
                               href="{{ $data['url'] }}">{{ $data['button_label'] }}</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
