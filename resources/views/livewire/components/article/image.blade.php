<div>
    <section class="{{ $query['type'] }} mb-5">
        @if($this->media)
            <img src="{{ Storage::disk('public')->url($media['path']) }}" alt="{{ $media['caption'] }}"
                 class="max-w-full rounded-lg shadow-lg"/>
        @endif
    </section>
</div>
