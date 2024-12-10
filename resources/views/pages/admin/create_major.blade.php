@extends('pages.admin.base')

@section('header', 'Create Major')

@section('container')
    <form method="post" action="{{ url('/admin/major/create') }}" class="max-w-[400px] w-full">
        @csrf

        @include('components.message')

        <div class="mb-1 font-semibold">
            Major Name
        </div>
        <div class="mb-4">
            <x-text-input name="name" placeholder="Major Name" with-error value="{{ old('name') }}"/>
        </div>

        <x-button type="submit">Create</x-button>
    </form>
@endsection
