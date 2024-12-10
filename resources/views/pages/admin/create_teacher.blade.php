@extends('pages.admin.base')

@section('header', 'Create Teacher')

@section('container')
    <form method="post" action="{{ url('/admin/teacher/create') }}" class="max-w-[400px] w-full">
        @csrf

        @include('components.message')

        <div class="mb-1 font-semibold">
            Username
        </div>
        <div class="mb-4">
            <x-text-input name="username" with-error value="{{ old('username') }}"/>
        </div>

        <div class="mb-1 font-semibold">
            Password
        </div>
        <div class="mb-4">
            <x-text-input name="password" with-error/>
        </div>

        <div class="mb-1 font-semibold">
             External ID (NIP)
        </div>
        <div class="mb-4">
            <x-text-input name="external_id" placeholder="External ID (NIP)" with-error value="{{ old('external_id') }}"/>
        </div>

        <div class="mb-1 font-semibold">
            Teacher Full Name
        </div>
        <div class="mb-4">
            <x-text-input name="full_name" placeholder="Teacher Full Name" with-error value="{{ old('full_name') }}"/>
        </div>

        <x-button type="submit">Create</x-button>
    </form>
@endsection
