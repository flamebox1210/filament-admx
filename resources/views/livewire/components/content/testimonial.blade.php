<div>
    <section id="{{ $data['anchor'] }}" class="{{ $query['type'] }} bg-white relative z-20 py-10">
        <h1 class="text-fe-primary font-bold text-4xl leading-tight mb-10 text-center">{{ $data['title'] }}</h1>
        <div class="max-w-[1200px] mx-auto">
            <div class="swiper swiper-cards">
                <div class="swiper-wrapper">
                    @foreach($items as $item)
                        <div class="swiper-slide px-4">
                            <div class="relative overflow-hidden rounded-lg">
                                <div
                                    class="bg-neutral-900 opacity-50 w-full h-full absolute top-0 left-0 right-0 z-10"></div>
                                <div class="cursor-pointer"
                                     wire:click.prevent="openModal('{{ $item['title'] }}','{{ $item['youtube_url'] }}')">
                                    <svg
                                        class="absolute z-20 w-[60px] h-[60px] text-white left-0 right-0 top-[35%] lg:top-[35%] mx-auto text-center scale-100 hover:scale-[1.1] transition duration-200 ease-in-out"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M15.91 11.672a.375.375 0 0 1 0 .656l-5.603 3.113a.375.375 0 0 1-.557-.328V8.887c0-.286.307-.466.557-.327l5.603 3.112Z"/>
                                    </svg>
                                </div>
                                <img src="{{ $item['image_path'] }}" alt="{{ $item['title'] }}"
                                     class="max-w-full rounded-md shadow-md"/>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-14">
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </section>
    @if($isOpenModal)
        <div
            wire:transition.opacity
            class="block fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-screen max-h-full bg-neutral-700 bg-opacity-50">
            <div class="absolute right-3 top-3">
                <button type="button" wire:click="closeModal()"
                        class="cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="text-white w-12">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="relative top-16 w-full max-w-full lg:max-w-[80%] max-h-full mx-auto" x-data
                 @click.away="@this.set('isOpenModal', false);">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden aspect-[1/2] lg:aspect-video">
                    <iframe width="100%" height="540" class="object-cover w-full h-full"
                            src="{{ $youtube }}?autoplay=1"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    @endif
</div>
