@extends('pages.teacher.base')

@section('header', 'Questions')

@section('container')
    <div class="flex flex-col w-full gap-4">
        <div class="mb-8">
            Subject: <b>{{ $subject->name }}</b>
        </div>
        <div class="max-w-[400px]">
            <form action="{{ url('teacher/subject/createQuestion/' . $subject->id) }}">
                <x-button type="submit">Create Question</x-button>
            </form>
        </div>
        <div class="flex flex-col gap-4">
            @php
            $noQuestion = 0;
            @endphp
            @foreach(\App\Models\Question::query()->where('subject_id', '=', $subject->id)->get() as $question)
                @php
                $noQuestion++;
                @endphp
                <div class="flex flex-col gap-0.5 rounded-lg px-4 py-3 shadow border">
                    <div class="flex gap-4 text-lg mb-2 w-full">
                        <div class="font-bold">
                            {{ $noQuestion }}.
                        </div>
                        <div class="flex flex-col w-full py-1 px-3 rounded border">
                            @if($question->image_path !== null)
                                <div class="mb-2 p-1 border mt-2">
                                    <img class="max-w-[600px] max-h-[400px]" src="{{ url('images/question/' . $question->image_path) }}" alt="question_image_{{ $question->id }}"/>
                                </div>
                            @endif
                            <div>
                                {!! nl2br($question->question) !!}
                            </div>
                        </div>
                    </div>
                    <div><b>Score:</b> {{ $question->score }}</div>
                    <div><b>Answer:</b> {{ $question->answer }}</div>
                    <div class="flex gap-2 items-center mt-2">
                        <x-modal-open id="delete_question_{{ $question->id  }}">
                            <button
                                class="flex items-center gap-x-1 px-2 py-0.5 rounded-lg bg-red-900 hover:bg-red-800 text-gray-50">
                                <span class="material-symbols-outlined">
                                    delete
                                </span>
                            </button>
                        </x-modal-open>

                        <x-modal id="delete_question_{{ $question->id  }}">
                            <h1 class="mb-4">Are you sure?</h1>
                            <hr>
                            <div class="flex mt-5">
                                <form action="{{ url('teacher/subject/deleteQuestion/' . $question->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        class="items-center gap-x-1 px-2 py-2 rounded-lg bg-blue-500 hover:bg-blue-400 text-gray-50 mr-5 w-60">Yes</button>
                                </form>
                                <button
                                    class="items-center gap-x-1 px-2 py-2 rounded-lg bg-red-900 hover:bg-red-800 text-gray-50 w-60">Cancel</button>
                            </div>
                        </x-modal>


                        <form action="{{ url('teacher/subject/editQuestion/' . $question->id) }}">
                            <button class="flex items-center gap-x-1 px-2 py-0.5 rounded-lg bg-yellow-600 hover:bg-yellow-500 text-gray-50">
                                <span class="material-symbols-outlined">
                                    edit
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
