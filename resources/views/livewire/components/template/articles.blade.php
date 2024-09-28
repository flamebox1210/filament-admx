<div>
    @if($media)
        <div class="max-h-[80vh] overflow-hidden relative">
            <img src="{{ $media->path }}" alt="{{ $media->caption }}" class="object-cover h-full w-full object-top"/>
            <div
                class="absolute left-0 right-0 top-[50%] max-w-[1200px] mx-auto items-center justify-center text-center">
                <h1 class="text-4xl font-semibold text-white mb-2 drop-shadow-lg">{{ $page->title }}</h1>
                @if($page->content)
                    <div class="content-area text-white drop-shadow-lg">{!! $page->content  !!}</div>
                @endif
            </div>
        </div>
    @else
        <div class="mt-32 mb-5 mx-auto px-8 lg:px-0 lg:max-w-[1200px]">
            <h1 class="text-4xl text-fe-primary font-semibold mb-2">{{ $page->title }}</h1>
            @if($isCategory)
                <h3 class="text-black text-md font-medium">Category : {{ $categoryName }}</h3>
            @endif
            @if($isSearch)
                <h3 class="text-black text-md font-medium">Search : {{ $search }}</h3>
            @endif
        </div>
    @endif
    <div class="mx-auto px-8 lg:px-0 lg:max-w-[1200px] mb-20">
        <div class="lg:grid lg:grid-cols-3 lg:gap-6">
            <div class="col-span-2">
                <div class="bg-white shadow-lg rounded-lg border border-neutral-100 py-8 mb-5">
                    <section wire:loading.block>
                        <div class="p-8 text-center max-w-[250px] mx-auto">
                            <h5 class="text-xl font-medium mb-5">{{ __('Please wait...') }}</h5>
                        </div>
                    </section>
                    <section wire:loading.remove>
                        @if(count($articles) > 0)
                            @foreach($articles as $article)
                                <div class="mb-5">
                                    <div class="px-8">
                                        <a class="cursor-pointer hover:text-fe-primary"
                                           href="{{ route('fe.article',[$page->slug,$article->slug]) }}">
                                            <h3 class="text-xl font-semibold mb-5">{{ $article->title }}</h3>
                                        </a>
                                        <div class="content-area">
                                            @if($article->content)
                                                {!! $article->content !!}
                                            @endif
                                        </div>
                                        <div class="max-w-[120px] mb-5">
                                            <a class="block transition duration-200 py-1 px-2 text-sm bg-neutral-900 hover:bg-neutral-700 scale-100 hover:scale-[1.1] text-white text-center font-semibold uppercase rounded-md shadow-md"
                                               href="{{ route('fe.article',[$page->slug,$article->slug]) }}">Read more
                                                &raquo;</a>
                                        </div>
                                    </div>
                                    <div
                                        class="border-t border-b w-full border-t-neutral-200 h-5 py-5 flex items-center border-b-neutral-200 text-neutral-500">
                                        <div class="px-8">
                                            {!! $article->published_at->format('F d,Y') !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="pagination px-8">
                                {!! $articles->links(data: ['scrollTo' => '#body']) !!}
                            </div>
                        @else
                            <div class="p-8 text-center max-w-[250px] mx-auto">
                                <h5 class="text-xl font-medium mb-5">{{ __('No data available') }}</h5>
                                <div class="mb-5">
                                    <a class="block transition duration-200 py-2 px-2 text-sm bg-neutral-300 hover:bg-neutral-500 scale-100 hover:scale-[1.1] text-black text-center font-semibold uppercase rounded-md shadow-md"
                                       href="{{ route('fe.page',['slug' => $page->slug]) }}">Refresh
                                    </a>
                                </div>
                            </div>
                        @endif
                    </section>
                </div>
            </div>
            <div>
                <form enctype="multipart/form-data" class="mb-5" wire:submit="applySearch">
                    <input type="search" name="search" wire:model="search"
                           class="border border-neutral-200 w-full py-3 px-5 bg-white rounded-lg text-black placeholder:text-neutral-300 focus:border-fe-primary focus:ring-1 focus:ring-fe-primary"
                           placeholder="Search here..."/>
                </form>
                <h3 class="text-xl font-medium text-black mb-4">Recent Posts</h3>
                <ul class="list-disc pl-5 mb-5">
                    @foreach($recents as $recent)
                        <li class="mb-2">
                            <a class="cursor-pointer hover:text-fe-primary"
                               href="{{ route('fe.article',[$page->slug,$recent->slug]) }}">
                                <h5 class="text-md font-normal">{{ $recent->title }}</h5>
                            </a>
                        </li>
                    @endforeach
                </ul>
                <div class="block w-full">
                    <label for="category" class="block mb-2 text-sm font-medium text-gray-600 w-full">Categories</label>
                    <select id="category" wire:change="applyCategory" wire:model="category"
                            class="h-12 border border-neutral-200 text-base rounded-lg block w-full py-2.5 px-4 focus:outline-none text-black placeholder:text-neutral-300 focus:border-fe-primary focus:ring-1 focus:ring-fe-primary max-w-full">
                        <option value="" selected>Choose a category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
