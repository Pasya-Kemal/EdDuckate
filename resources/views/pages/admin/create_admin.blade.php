@extends('pages.admin.base')

@section('header', 'Create Admin')

@section('container')
    <form method="post" action="{{ url('/admin/admin/create') }}" class="max-w-[400px] w-full">
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
            <x-text-input name="password" with-error value="{{ old('password') }}"/>
        </div>

        <x-button type="submit">Create</x-button>
    </form>
@endsection
