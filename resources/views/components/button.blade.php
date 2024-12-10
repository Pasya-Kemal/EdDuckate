<button type="{{ $type }}"
        class="flex flex-row gap-x-1 items-center justify-center rounded-lg bg-blue-400 text-gray-100 shadow w-full py-1.5 px-3 uppercase font-semibold hover:bg-blue-300">
    @if($leftIcon)
        <span class="material-symbols-outlined">{{ $leftIcon }}</span>
    @endif
    {{ $slot }}
    @if($rightIcon)
        <span class="material-symbols-outlined">{{ $rightIcon }}</span>
    @endif
</button>
