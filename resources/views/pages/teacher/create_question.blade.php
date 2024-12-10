@extends('pages.teacher.base')

@section('header', 'Create Question')

@section('container')
    <div>
        <div class="mb-8">
            Create Question for subject: <b>{{ $subject->name }}</b>
        </div>
        <form enctype="multipart/form-data" method="post" action="{{ url('teacher/subject/createQuestion/' . $subject->id) }}"
            class="max-w-[700px] w-full mr-20">
            @csrf

            @include('components.message')

            <div class="mb-1 font-semibold">
                Question
            </div>
            <div class="mb-4">
                @php
                $questionTemplate = "--Question here--\n\nA.\nB.\nC.\nD.\nE.";
                @endphp
                <textarea name="question" class="h-[200px] resize-y shadow-md border border-gray-300 text-gray-600 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">{{ old('question', $questionTemplate) }}</textarea>
                <x-form-error field="question"/>
            </div>

            <div class="mb-1 font-semibold">
                Question Image (Optional)
            </div>
            <div class="mb-4">
                <input name="image" class="block w-full shadow py-2 px-3 text-sm border border-gray-300 text-gray-600 rounded-lg cursor-pointer" type="file">
                <x-form-error field="image"/>
            </div>

            <div class="mb-1 font-semibold">
                Score
            </div>
            <div class="mb-4">
                <x-text-input type="number" name="score" value="{{ old('score') }}"/>
                <x-form-error field="score"/>
            </div>

            <div class="mb-1 font-semibold">
                Answer
            </div>
            <div class="mb-4">
                <select name="answer" class="shadow-md border border-gray-300 text-gray-600 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                    <option value="">Select Answer</option>
                    @foreach(['A', 'B', 'C', 'D', 'E'] as $ans)
                        <option value="{{ $ans }}"{{ old('answer') === $ans ? ' selected' : '' }}>{{ $ans }}</option>
                    @endforeach
                </select>
                <x-form-error field="answer"/>
            </div>

            <x-button type="submit">Create</x-button>
        </form>
    </div>
@endsection
