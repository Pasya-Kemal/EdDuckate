@extends('pages.teacher.base')

@section('header', 'Create Presence')

@section('container')
    <form method="post" action="{{ url('teacher/presence/create') }}" class="max-w-[400px] w-full">
        @csrf

        @include('components.message')

        <div class="mb-1 font-semibold">
            Presence
        </div>
        <div class="mb-4">
            <div class="mb-4">
                <x-text-input name="name" with-error value="{{ old('name') }}"/>
            </div>
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
            <select id="selectClassroom" name="classroom_id" class="shadow-md border border-gray-300 text-gray-600 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                <option value="">Select Classroom</option>
                @foreach(\App\Models\Classroom::all() as $classroom)
                    <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                @endforeach
            </select>
            <x-form-error field="classroom_id"/>
        </div>

        <div class="mb-1 font-semibold">
            Starts At
        </div>
        <div class="mb-4">
            <x-date-time-picker name="starts_at" with-error value="{{ old('starts_at') }}"/>
            <x-form-error field="starts_at"/>
        </div>

        <div class="mb-1 font-semibold">
            Ends At
        </div>
        <div class="mb-4">
            <x-date-time-picker name="ends_at" with-error value="{{ old('ends_at') }}"/>
            <x-form-error field="starts_at"/>
        </div>

        <x-button type="submit">Create</x-button>
    </form>
@endsection
