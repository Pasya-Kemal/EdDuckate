@extends('pages.teacher.base')

@section('header', 'Edit Subject')

@section('container')
    <form method="post" action="{{ url('teacher/subject/edit/' . $subject->id) }}" class="max-w-[400px] w-full">
        @csrf

        @include('components.message')

        <div class="mb-1 font-semibold">
            Subject Name
        </div>
        <div class="mb-4">
            <div class="mb-4">
                <x-text-input name="name" with-error value="{{ old('name', $subject->name) }}"/>
            </div>
        </div>

        <div class="mb-1 font-semibold">
            Starts At
        </div>
        <div class="mb-4">
            <x-date-time-picker name="starts_at" with-error value="{{ old('starts_at', $subject->starts_at->format('m/d/Y H:i')) }}"/>
            <x-form-error field="starts_at"/>
        </div>

        <div class="mb-1 font-semibold">
            Ends At
        </div>
        <div class="mb-4">
            <x-date-time-picker name="ends_at" with-error value="{{ old('ends_at', $subject->ends_at->format('m/d/Y H:i')) }}"/>
            <x-form-error field="ends_at"/>
        </div>

        <div class="mb-1 font-semibold">
            Shuffle Questions
        </div>
        <div class="mb-4">
            <x-checkbox name="shuffle_questions" value="{{ old('shuffle_questions', $subject->shuffle_questions ? 'true' : 'false') }}">Shuffle Questions</x-checkbox>
            <x-form-error field="shuffle_questions"/>
        </div>

        <div class="mb-1 font-semibold hidden">
            Shuffle Answers
        </div>
        <div class="mb-4 hidden">
            <x-checkbox name="shuffle_answers" value="{{ old('shuffle_answers', $subject->shuffle_answers ? 'true' : 'false') }}">Shuffle Answers</x-checkbox>
            <x-form-error field="shuffle_answers"/>
        </div>

        <x-button type="submit">Edit</x-button>
    </form>
@endsection
