@php use Awcodes\Curator\Models\Media; @endphp
<div>
    <div class="mt-32 mx-auto px-8 lg:px-0 lg:max-w-[1200px] mb-20">
        <div class="lg:grid lg:grid-cols-3 lg:gap-10">
            <div class="col-span-2">
                <h1 class="text-4xl text-fe-primary font-semibold mb-5">{{ $article->title }}</h1>
                @if($media)
                    <div class="mb-5">
                        <img src="{{ Storage::disk('public')->url($media['path']) }}" alt="{{ $media['caption'] }}"
                             class="max-w-full rounded-lg shadow-lg"/>
                    </div>
                @endif
                @foreach($article['components:'.app()->currentLocale()] as $key => $component)
                    @if($component['data']['is_active'])
                        @livewire('components.article.'.$component['type'],['query' => $component, 'page' =>
                        $currentPage ],
                        key($key))
                    @endif
                @endforeach
            </div>
            <div>
                <h3 class="text-xl font-medium text-black mb-4">Recent Posts</h3>
                <ul class="list-disc pl-5 mb-5">
                    @foreach($recents as $recent)
                        <li class="mb-2">
                            <a class="cursor-pointer hover:text-fe-primary"
                               href="{{ route('fe.article',[$currentPage->slug,$recent->slug]) }}">
                                <h5 class="text-md font-normal">{{ $recent->title }}</h5>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <h2 class="mt-10 text-3xl text-fe-primary font-semibold mb-5">You Might Also Like</h2>
        <div class="lg:grid lg:grid-cols-3 lg:gap-4">
            @foreach($relations as $relation)
                <div>
                    <div class="overflow-hidden h-[200px] mb-5 rounded-lg shadow-lg relative">
                        @if($relation->image)
                            @php($image = Media::find($relation->image))
                            <img src="{{ Storage::disk('public')->url($image->path) }}" alt="{{ $image->caption }}"
                                 class="object-center object-cover w-full h-full"/>
                        @else
                            <img src="{{ asset('img/meta-image.jpg') }}"
                                 class="object-center object-contain w-full h-full"/>
                        @endif
                    </div>
                    <a class="cursor-pointer hover:text-fe-primary"
                       href="{{ route('fe.article',[$currentPage->slug,$recent->slug]) }}">
                        <h5 class="text-xl mb-3">{{ $relation->title }}</h5>
                        <div class="text-neutral-500">
                            {!! $relation->published_at->format('F d,Y') !!}
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
