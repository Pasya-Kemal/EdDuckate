@if($type === 'password')
    @php
    $randomID = substr(sha1(mt_rand()), 0, 16);
    $randomID2 = substr(sha1(mt_rand()), 0, 16);
    @endphp
    <div class="relative">
        <input id="{{ $randomID }}" type="password" name="{{ $name }}" placeholder="{{ $placeholder }}" class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:border-blue-300 focus:outline-none focus:shadow-outline">
        <button type="button" onclick="onTogglePasswordVisibility('{{ $randomID }}', '{{ $randomID2 }}')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
            <i class="material-symbols-outlined" id="{{ $randomID2 }}">visibility_off</i>
        </button>
    </div>
@else
    <input type="{{ $type }}" name="{{ $name }}" value="{{ $value }}" placeholder="{{ $placeholder }}" class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:border-blue-300 focus:outline-none focus:shadow-outline">
@endif

@if($withError)
    <x-form-error field="{{ $name }}"/>
@endif
