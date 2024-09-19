<div>
    <section class="{{ $query['type'] }} bg-neutral-200 relative z-20 pt-10">
        <h1 class="text-fe-primary font-bold text-4xl leading-tight mb-10 text-center">{{ $data['title'] }}</h1>
        <div class="max-w-[1200px] mx-auto">
            <div class="lg:grid lg:grid-cols-3 lg:gap-4">
                <div class="text-center">
                    <ul class="mb-4">
                        @foreach($data['social_media'] as $social)
                            <li>
                                <a href="{{ $social['url'] }}" target="_blank">
                                    @if($social['site'] == 'facebook')
                                    @endif
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <h5 class="text-lg font-medium">{{ $data['subtitle'] }}</h5>
                </div>
                <div class="text-center">
                    <div class="mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="mx-auto max-w-[50px]">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M14.25 9.75v-4.5m0 4.5h4.5m-4.5 0 6-6m-3 18c-8.284 0-15-6.716-15-15V4.5A2.25 2.25 0 0 1 4.5 2.25h1.372c.516 0 .966.351 1.091.852l1.106 4.423c.11.44-.054.902-.417 1.173l-1.293.97a1.062 1.062 0 0 0-.38 1.21 12.035 12.035 0 0 0 7.143 7.143c.441.162.928-.004 1.21-.38l.97-1.293a1.125 1.125 0 0 1 1.173-.417l4.423 1.106c.5.125.852.575.852 1.091V19.5a2.25 2.25 0 0 1-2.25 2.25h-2.25Z"/>
                        </svg>
                    </div>
                    <ul>
                        @foreach($data['phones'] as $p)
                            <li class="mb-1 font-medium text-lg">
                                {{ $p['phone'] }}
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="text-center">
                    <div class="mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="mx-auto max-w-[50px]">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/>
                        </svg>
                    </div>
                    <ul>
                        @foreach($data['emails'] as $e)
                            <li class="mb-1 font-medium text-lg">
                                {{ $e['email'] }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @if($data['embed'])
            <div class="mt-10 aspect-auto">
                {!! $data['embed'] !!}
            </div>
        @endif
    </section>
</div>
