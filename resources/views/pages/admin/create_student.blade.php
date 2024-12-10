@extends('pages.admin.base')

@section('header', 'Create Student')

@section('container')
    <form enctype="multipart/form-data" method="post" action="{{ url('/admin/student/create') }}" class="max-w-[400px] w-full">
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
             External ID (NISN)
        </div>
        <div class="mb-4">
            <x-text-input name="external_id" placeholder="External ID (NISN)" with-error value="{{ old('external_id') }}"/>
        </div>

        <div class="mb-1 font-semibold">
            Student Full Name
        </div>
        <div class="mb-4">
            <x-text-input name="full_name" placeholder="Student Full Name" with-error value="{{ old('full_name') }}"/>
        </div>

        <div class="mb-1 font-semibold">
            Photo
        </div>
        <div class="mb-4">
            <input name="image" class="block w-full shadow py-2 px-3 text-sm border border-gray-300 text-gray-600 rounded-lg cursor-pointer" type="file">
            <x-form-error field="image"/>
        </div>

        <div class="mb-1 font-semibold">
            Major
        </div>
        <div class="mb-4">
            <select id="selectMajor" name="major_id" class="shadow-md border border-gray-300 text-gray-600 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                <option value="">Select Major</option>
                @foreach(\App\Models\Major::all() as $major)
                    <option value="{{ $major->id }}">{{ $major->name }}</option>
                @endforeach
            </select>
            <x-form-error field="major_id"/>
        </div>

        <div class="mb-1 font-semibold">
            Classroom
        </div>
        <div class="mb-4">
            <select id="selectClassroom" name="classroom_id" class="shadow-md border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                {{-- this classroom will automatically generated --}}
            </select>
            <x-form-error field="classroom_id"/>
        </div>

        <x-button type="submit">Create</x-button>
    </form>
@endsection
