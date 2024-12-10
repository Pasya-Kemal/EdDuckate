@extends('pages.teacher.base')

@section('header', 'Create Subject')

@section('container')
    <form method="post" action="{{ url('teacher/subject/create') }}" class="max-w-[400px] w-full">
        @csrf

        @include('components.message')

        <div class="mb-1 font-semibold">
            Subject Name
        </div>
        <div class="mb-4">
            <div class="mb-4">
                <x-text-input name="name" with-error value="{{ old('name') }}"/>
            </div>
        </div>

        <div class="mb-1 font-semibold">
            Starts At
        </div>
        <div class="mb-4">
            <x-date-time-picker name="starts_at" with-error value="{{ old('name') }}"/>
            <x-form-error field="starts_at"/>
        </div>

        <div class="mb-1 font-semibold">
            Ends At
        </div>
        <div class="mb-4">
            <x-date-time-picker name="ends_at" with-error value="{{ old('name') }}"/>
            <x-form-error field="starts_at"/>
        </div>

        <div class="mb-1 font-semibold">
            Shuffle Questions
        </div>
        <div class="mb-4">
            <x-checkbox name="shuffle_questions">Shuffle Question</x-checkbox>
            <x-form-error field="shuffle_questions"/>



        </div>

        <div class="mb-1 font-semibold hidden">
            Shuffle Answers
        </div>
        <div class="mb-4 hidden">
            <x-checkbox name="shuffle_answers">Shuffle Answers</x-checkbox>
            <x-form-error field="shuffle_answers"/>
        </div>

        <x-button type="submit">Create</x-button>
    </form>
@endsection
