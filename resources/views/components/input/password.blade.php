<div class="relative">
    <input type="password" id="{{ $name }}" name="{{ $name }}" placeholder="{{ $placeholder }}" class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:border-blue-300 focus:outline-none focus:shadow-outline">
    <button type="button" id="{{ $name }}-button" onclick="onTogglePasswordVisibility('{{ $name }}', '{{ $name }}-button-icon')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5"/>
        <i id="{{ $name }}-button-icon" class="material-icons">visibility</i>
    </button>
</div>
