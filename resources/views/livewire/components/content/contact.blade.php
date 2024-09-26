<div>
    <section id="{{ $data['anchor'] }}" class="{{ $query['type'] }} bg-white relative z-20 pt-10">
        <h1 class="text-fe-primary font-bold text-4xl leading-tight mb-10 text-center">{{ $data['title'] }}</h1>
        <div class="max-w-[1200px] mx-auto">
            <div class="lg:grid lg:grid-cols-3 lg:gap-4">
                <div class="text-center mb-4 lg:mb-0">
                    <ul class="mb-4 flex flex-row gap-4 justify-center">
                        @foreach($data['social_media'] as $social)
                            <li class="max-w-[50px]">
                                <a href="{{ $social['url'] }}" target="_blank"
                                   class="grayscale hover:grayscale-0 transition duration-200 ease-in-out">
                                    @if($social['site'] == 'facebook')
                                        <svg class="max-w-[50px] max-h-[50px]" width="166" height="166"
                                             viewBox="0 0 166 166"
                                             fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M137.84 0.47998H28.41C12.9461 0.47998 0.410034 13.016 0.410034 28.48V137.91C0.410034 153.374 12.9461 165.91 28.41 165.91H137.84C153.304 165.91 165.84 153.374 165.84 137.91V28.48C165.84 13.016 153.304 0.47998 137.84 0.47998Z"
                                                fill="#1677F0"/>
                                            <path
                                                d="M103.28 95.93L105.89 78.9H89.55V67.85C89.55 63.19 91.83 58.65 99.15 58.65H106.58V44.15C106.58 44.15 99.84 43 93.39 43C79.94 43 71.14 51.15 71.14 65.92V78.9H56.1801V95.93H71.14V137.09C74.14 137.56 77.21 137.81 80.34 137.81C83.47 137.81 86.54 137.56 89.54 137.09V95.93H103.26H103.28Z"
                                                fill="white"/>
                                        </svg>
                                    @elseif($social['site'] == 'x')
                                        <svg class="max-w-[50px] max-h-[50px]" width="166" height="166"
                                             viewBox="0 0 166 166"
                                             fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M137.84 0.47998H28.41C12.9461 0.47998 0.410034 13.016 0.410034 28.48V137.91C0.410034 153.374 12.9461 165.91 28.41 165.91H137.84C153.304 165.91 165.84 153.374 165.84 137.91V28.48C165.84 13.016 153.304 0.47998 137.84 0.47998Z"
                                                fill="#1677F0"/>
                                            <path
                                                d="M103.28 95.93L105.89 78.9H89.55V67.85C89.55 63.19 91.83 58.65 99.15 58.65H106.58V44.15C106.58 44.15 99.84 43 93.39 43C79.94 43 71.14 51.15 71.14 65.92V78.9H56.1801V95.93H71.14V137.09C74.14 137.56 77.21 137.81 80.34 137.81C83.47 137.81 86.54 137.56 89.54 137.09V95.93H103.26H103.28Z"
                                                fill="white"/>
                                        </svg>
                                    @elseif($social['site'] == 'linkedin')
                                        <svg class="max-w-[50px] max-h-[50px]" width="167" height="166"
                                             viewBox="0 0 167 166"
                                             fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M138.33 0.119995H28.9C13.4361 0.119995 0.900024 12.656 0.900024 28.12V137.55C0.900024 153.014 13.4361 165.55 28.9 165.55H138.33C153.794 165.55 166.33 153.014 166.33 137.55V28.12C166.33 12.656 153.794 0.119995 138.33 0.119995Z"
                                                fill="#2967B0"/>
                                            <path
                                                d="M88.76 73.87C89.91 72.58 90.85 71.28 92.03 70.17C95.65 66.76 99.93 65.04 104.92 65.08C107.66 65.1 110.38 65.3 113.03 66.07C119.08 67.82 122.6 71.99 124.28 77.9C125.54 82.33 125.77 86.89 125.78 91.46C125.8 101.09 125.75 110.73 125.78 120.36C125.78 121.26 125.53 121.5 124.64 121.49C119.68 121.45 114.71 121.45 109.75 121.49C108.88 121.49 108.69 121.23 108.69 120.4C108.72 111.23 108.72 102.06 108.69 92.9C108.69 90.6 108.54 88.31 107.89 86.07C106.7 81.96 103.76 79.86 99.45 80.09C93.56 80.4 90.5 83.32 89.75 89.3C89.57 90.73 89.49 92.16 89.49 93.6C89.49 102.52 89.49 111.43 89.51 120.35C89.51 121.24 89.29 121.5 88.38 121.49C83.38 121.45 78.38 121.45 73.38 121.49C72.58 121.49 72.35 121.28 72.35 120.47C72.37 102.82 72.37 85.17 72.35 67.51C72.35 66.64 72.64 66.43 73.46 66.44C78.21 66.48 82.96 66.48 87.7 66.44C88.57 66.44 88.8 66.71 88.78 67.54C88.73 69.65 88.76 71.76 88.76 73.87Z"
                                                fill="#FDFDFD"/>
                                            <path
                                                d="M61.5699 94.04C61.5699 102.77 61.5599 111.51 61.5899 120.24C61.5899 121.21 61.3499 121.5 60.3499 121.49C55.3899 121.44 50.4299 121.45 45.4699 121.49C44.6699 121.49 44.4399 121.3 44.4399 120.47C44.4599 102.79 44.4599 85.11 44.4399 67.43C44.4399 66.1 45.0299 66.33 48.7499 66.88C51.9699 67.36 55.2599 67.3101 58.4599 66.7101C61.2999 66.1801 61.5899 66.41 61.5899 67.64C61.5699 76.44 61.5699 85.25 61.5699 94.05V94.04Z"
                                                fill="#FDFDFD"/>
                                            <path
                                                d="M62.94 48.92C62.94 56.68 54.04 62.4 45.94 56.33C39.41 48.27 45.23 39.06 53.04 39.06C58.46 39.06 62.93 43.52 62.93 48.92H62.94Z"
                                                fill="#FDFDFD"/>
                                        </svg>
                                    @elseif($social['site'] == 'instagram')
                                        <svg class="max-w-[50px] max-h-[50px]" width="167" height="166"
                                             viewBox="0 0 167 166"
                                             fill="none"
                                             xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <mask id="mask0_1_305" style="mask-type:luminance"
                                                  maskUnits="userSpaceOnUse" x="0" y="0" width="167" height="166">
                                                <path
                                                    d="M138.23 0.47998H28.8C13.3361 0.47998 0.800049 13.016 0.800049 28.48V137.91C0.800049 153.374 13.3361 165.91 28.8 165.91H138.23C153.694 165.91 166.23 153.374 166.23 137.91V28.48C166.23 13.016 153.694 0.47998 138.23 0.47998Z"
                                                    fill="white"/>
                                            </mask>
                                            <g mask="url(#mask0_1_305)">
                                                <mask id="mask1_1_305" style="mask-type:luminance"
                                                      maskUnits="userSpaceOnUse" x="-5" y="-5" width="177" height="176">
                                                    <path d="M171.23 -4.52002H-4.19995V170.91H171.23V-4.52002Z"
                                                          fill="white"/>
                                                </mask>
                                                <g mask="url(#mask1_1_305)">
                                                    <rect x="-4.45996" y="-4.89001" width="176.4" height="176.4"
                                                          fill="url(#pattern0_1_305)"/>
                                                </g>
                                            </g>
                                            <path
                                                d="M118.9 57.34C122.954 57.34 126.24 54.0538 126.24 50C126.24 45.9462 122.954 42.66 118.9 42.66C114.846 42.66 111.56 45.9462 111.56 50C111.56 54.0538 114.846 57.34 118.9 57.34Z"
                                                fill="white"/>
                                            <path
                                                d="M109.07 144.5H57.98C48.43 144.5 39.4501 140.78 32.7001 134.03C25.9501 127.28 22.23 118.3 22.23 108.75V57.66C22.23 48.11 25.9501 39.13 32.7001 32.38C39.4501 25.63 48.43 21.91 57.98 21.91H109.07C118.62 21.91 127.6 25.63 134.35 32.38C141.1 39.13 144.82 48.11 144.82 57.66V108.75C144.82 118.3 141.1 127.28 134.35 134.03C127.6 140.78 118.62 144.5 109.07 144.5ZM57.98 32.19C43.94 32.19 32.5201 43.61 32.5201 57.65V108.74C32.5201 122.78 43.94 134.2 57.98 134.2H109.07C123.11 134.2 134.53 122.78 134.53 108.74V57.65C134.53 43.61 123.11 32.19 109.07 32.19H57.98Z"
                                                fill="white"/>
                                            <path
                                                d="M85.61 115.8C67.94 115.8 53.5701 101.43 53.5701 83.76C53.5701 66.09 67.94 51.72 85.61 51.72C103.28 51.72 117.65 66.09 117.65 83.76C117.65 101.43 103.28 115.8 85.61 115.8ZM85.61 60.94C73.03 60.94 62.79 71.18 62.79 83.76C62.79 96.34 73.03 106.58 85.61 106.58C98.19 106.58 108.43 96.34 108.43 83.76C108.43 71.18 98.19 60.94 85.61 60.94Z"
                                                fill="white"/>
                                            <defs>
                                                <pattern id="pattern0_1_305" patternContentUnits="objectBoundingBox"
                                                         width="1" height="1">
                                                    <use xlink:href="#image0_1_305" transform="scale(0.00675676)"/>
                                                </pattern>
                                                <image id="image0_1_305" width="148" height="148"
                                                       xlink:href="data:image/png;base64,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"/>
                                            </defs>
                                        </svg>
                                    @elseif($social['site'] == 'youtube')
                                        <svg class="max-w-[50px] max-h-[50px]" width="166" height="166"
                                             viewBox="0 0 166 166"
                                             fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M137.93 0.119995H28.5C13.036 0.119995 0.5 12.656 0.5 28.12V137.55C0.5 153.014 13.036 165.55 28.5 165.55H137.93C153.394 165.55 165.93 153.014 165.93 137.55V28.12C165.93 12.656 153.394 0.119995 137.93 0.119995Z"
                                                fill="#FF0109"/>
                                            <path
                                                d="M122.9 58.82H43.55C38.9274 58.82 35.18 62.5674 35.18 67.19V102.41C35.18 107.033 38.9274 110.78 43.55 110.78H122.9C127.523 110.78 131.27 107.033 131.27 102.41V67.19C131.27 62.5674 127.523 58.82 122.9 58.82Z"
                                                fill="white"/>
                                            <path
                                                d="M101.53 82.84C102.71 83.49 102.74 85.17 101.58 85.86L89.65 93.04L77.72 100.22C76.57 100.91 75.1 100.1 75.07 98.76L74.82 84.83L74.57 70.9C74.55 69.56 75.99 68.69 77.16 69.34L89.35 76.09L101.54 82.84H101.53Z"
                                                fill="#ED1C24"/>
                                        </svg>
                                    @endif
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <h5 class="text-lg font-medium">{{ $data['subtitle'] }}</h5>
                </div>
                <div class="text-center mb-4 lg:mb-0">
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
                <div class="text-center mb-4 lg:mb-0">
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
            <div class="mt-10 aspect-auto max-w-full">
                {!! $data['embed'] !!}
            </div>
        @endif
    </section>
</div>
