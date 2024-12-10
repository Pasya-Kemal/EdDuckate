@extends('pages.admin.base')

@section('header', 'Update Teacher')

@section('container')
    <form method="post" action="{{ url('/admin/teacher/update/' . $teacher->user_id) }}" class="max-w-[400px] w-full">
        @csrf

        @include('components.message')

        <div class="mb-1 font-semibold">
            Username
        </div>
        <div class="mb-4">
            <x-text-input name="username" with-error value="{{ $teacher->user->name }}"/>
        </div>

        <div class="mb-1 font-semibold">
            Password (if empty, the password won't be updated)
        </div>
        <div class="mb-4">
            <x-text-input name="password" with-error/>
        </div>

        <div class="mb-1 font-semibold">
             External ID (NIP)
        </div>
        <div class="mb-4">
            <x-text-input name="external_id" placeholder="External ID (NIP)" with-error value="{{ $teacher->external_id }}"/>
        </div>

        <div class="mb-1 font-semibold">
            Teacher Full Name
        </div>
        <div class="mb-4">
            <x-text-input name="full_name" placeholder="Teacher Full Name" with-error value="{{ $teacher->full_name }}"/>
        </div>

        <x-button type="submit">Update</x-button>
    </form>
@endsection
