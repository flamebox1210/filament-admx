<div>
    <section class="{{ $query['type'] }} mx-auto px-8 lg:px-0 lg:max-w-[960px] mb-5">
        @if($data['type'] == 'youtube')
            <iframe width="100%" height="540" class="w-full aspect-video"
                    src="{{ $youtube }}"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        @endif
    </section>
</div>
