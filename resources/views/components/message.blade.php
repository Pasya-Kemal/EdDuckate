@if(session()->has('message'))
    <div class="mb-4">
        <div class="rounded-lg bg-blue-100 text-blue-800 px-4 py-3">
            {{ session()->get('message') }}
        </div>
    </div>
@endif
