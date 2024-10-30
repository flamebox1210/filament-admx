<div>
    @if($type == 'url')
        <a href="{{ $url }}" target="{{ $target }}"
           class="inline-block py-4 px-8 bg-black hover:bg-fe-primary text-white transition ease-in-out duration-300 rounded-full uppercase">
            <div class="flex gap-2 items-center">
                {{ $label }}
                <svg class="ml-2 icon-button-base" xmlns="http://www.w3.org/2000/svg" width="10" height="8"
                     viewBox="0 0 10 8" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9 4.50012H0V3.50012H9V4.50012Z"
                          fill="currentColor"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M9 4.50012L5.99999 1.50008L6.70709 0.792969L9.70709 3.79297L9 4.50012Z"
                          fill="currentColor"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M9 3.50012L5.99999 6.50017L6.70709 7.20728L9.70709 4.20728L9 3.50012Z"
                          fill="currentColor"></path>
                </svg>
            </div>
        </a>
    @else
        <button class="p-4 bg-black text-white rounded-full" type="{{ $type }}">{{ $label }}</button>
    @endif
</div>
