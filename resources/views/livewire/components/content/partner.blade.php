<div>
    <section class="{{ $query['type'] }} bg-neutral-200 relative z-20 py-10">
        <h1 class="text-fe-primary font-bold text-4xl leading-tight mb-10 text-center">{{ $data['title'] }}</h1>
        <div class="max-w-[1920px] px-5 mx-auto">
            <div class="lg:grid lg:grid-cols-4 lg:gap-6 bg-white shadow-lg rounded-lg p-5">
                <div>
                    <div
                        class="overflow-y-scroll max-h-[140px] lg:max-h-[350px] pr-4 bg-neutral-300 py-4 lg:py-0 pl-4 lg:pl-0 lg:bg-transparent mb-5 lg:mb-0 rounded-lg lg:rounded-none">
                        @foreach($categories as $category)
                            <div wire:click="selectCategory({{ $category->id }})"
                                @class([
                                   'cursor-pointer py-3 px-5 bg-neutral-200 hover:bg-fe-secondary hover:text-white rounded-md mb-3 lg:text-md text-sm',
                                   '!bg-fe-secondary !text-white' => $category->id == $getCategory->id
                                ])>
                                {{ $category->title }}
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="lg:col-span-3">
                    @if($partners)
                        <div class="lg:grid lg:grid-cols-3 lg:gap-4 break-words">
                            @foreach($partners as $partner)
                                <div>
                                    <div class="flex flex-row gap-4 items-center">
                                        <div>
                                            <img src="{{ $partner->image_path }}" alt="{{ $partner->title }}"
                                                 class="max-w-[100px]"/>
                                        </div>
                                        <div class="lg:text-md text-sm">
                                            <h5 class="text-black font-medium mb-1">{{ $partner->title }}</h5>
                                            @if($partner->url)
                                                <a class="text-fe-primary cursor-pointer text-wrap"
                                                   href="{{ $partner->url }}"
                                                   target="_blank">{{ $partner->url }}</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-10 lg:max-w-[60%] mx-auto">
                            <a class="block transition duration-200 py-2 px-10 text-sm break-words bg-fe-secondary hover:bg-fe-primary scale-100 hover:scale-[1.1] text-white text-center font-font-semibold uppercase rounded-md shadow-md"
                               href="#">{{ __('View all') }} {{ $getCategory->title }}</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
