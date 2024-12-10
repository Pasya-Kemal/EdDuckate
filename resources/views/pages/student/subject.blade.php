@extends('layout.app')

@section('body')
    <div class="flex h-[100vh] flex-col" id="ujianify_subject_container">
        <script>
            const QuestionID = {{ $question->id }};
            document.addEventListener('DOMContentLoaded', function() {
                startCountdown(new Date({{ $subject->ends_at->unix() * 1000 }}), 'countdown_subject');

                @if ($currentAnswer !== null)
                    MarkAnswered('{{ $currentAnswer }}');
                @endif

                LoadAntiCheat();
                initializeCamera({{ $subject->id }});
                cheatSubjectId = {{ $subject->id }};
            });
        </script>
        <div class="flex h-24 w-full items-center border-b border-b-gray-200 px-8 shadow">
            <div class="flex items-center flex-auto text-2xl font-bold w-full">
                {{-- NAVBAR LOGO HERE --}}
            </div>
            <div class="flex flex-col items-center w-64">
                <div>Nomor Soal</div>
                <div class="font-bold text-3xl">
                    {{ $no }}
                </div>
            </div>
            <div class="flex flex-col items-end text-lg flex-auto w-full">
                <div>Sisa waktu</div>
                <div id="countdown_subject" class="text-2xl font-bold">Loading...</div>
            </div>
        </div>
        <div class="flex w-full flex-auto">
            <div class="flex w-[350px] flex-col gap-4 bg-blue-500 px-3 py-6 text-white">
                @if ($student->image !== null)
                    <div class="flex w-full justify-center">
                        <img alt="pp" class="object-contain w-[200px] h-[200px] border-4"
                            src="{{ url('images/student/' . $student->image) }}" />
                    </div>
                @endif
                <div class="flex w-full flex-col items-center gap-1">
                    <div class="text-2xl">{{ $student->external_id }}</div>
                    <div class="text-center font-thin">{{ $student->full_name }}</div>
                </div>
                <div class="flex w-full flex-col items-center gap-2 rounded-sm bg-white pb-4 pt-2 text-black">
                    <div class="font-semibold">Daftar Soal</div>
                    <div class="flex flex-wrap justify-center gap-1 px-4 text-gray-600" id="answer_list">
                        @for ($i = 1; $i <= $totalQuestion; $i++)
                            <div onclick="window.location.href='{{ url('/subject/' . $subject->id . '?no=' . $i) }}';"
                                class="{{ $answeredNo[$i] ? 'bg-green-200 ' : '' }}mb-1 mx-0.5 w-10 rounded-sm border border-gray-500 p-2 text-center hover:cursor-pointer hover:bg-blue-200">
                                {{ $i }}</div>
                        @endfor
                    </div>
                </div>
                <div class="mt-2 py-2 px-4 bg-white flex-col text-black flex w-full items-center gap-2">
                    <div class="font-semibold">Kamera</div>
                    <video class="border border-gray-900" id="subjectCamera" width="640" height="480" autoplay></video>
                    <canvas id="subjectCamCanvas" style="display:none;"></canvas>
                </div>
            </div>

            <div class="h-full w-full">
                <div class="flex h-full w-full flex-col">
                    <div class="flex-auto">
                        <div class="flex flex-col gap-2 p-8 text-2xl select-none max-w-[1200px]">
                            @if ($question->image_path !== null)
                                <div class="max-w-[500px] max-h-[300px]">
                                    <img class="object-contain max-w-[500px] max-h-[300px]"
                                        src="{{ url('images/question/' . $question->image_path) }}"
                                        alt="question_image_{{ $question->id }}">
                                </div>
                            @endif
                            {!! nl2br($question->question) !!}
                        </div>
                    </div>
                    <div class="min-h-28 border-t border-t-gray-300 py-2">
                        <div class="mb-2 flex w-96 gap-3 px-2 text-lg font-semibold text-blue-400">
                            @foreach (['A', 'B', 'C', 'D', 'E'] as $ans)
                                <div id="btn_answer_{{ $ans }}"
                                    class="flex-auto rounded-md border border-blue-400 px-4 py-2 text-center hover:cursor-pointer hover:bg-blue-200">
                                    {{ $ans }}</div>
                            @endforeach
                        </div>
                        <div id="status_answering" class="px-2 text-blue-400 mb-2"></div>
                        <div class="flex">
                            <div class="flex w-96 gap-3 px-2 text-lg text-blue-400">
                                <div onclick="window.location.href='{{ url('/subject/' . $subject->id . '?no=' . max(intval($no) - 1, 1)) }}';"
                                    class="flex gap-2 justify-center items-center flex-auto rounded-md border border-blue-400 bg-blue-400 px-4 py-1.5 text-center text-white hover:cursor-pointer hover:bg-blue-500">
                                    <i class="material-symbols-outlined">arrow_back</i> Sebelumnya
                                </div>
                                <div onclick="window.location.href='{{ url('/subject/' . $subject->id . '?no=' . (intval($no) + 1)) }}';"
                                    class="flex gap-2 justify-center items-center flex-auto rounded-md border border-blue-400 bg-blue-400 px-4 py-1.5 text-center text-white hover:cursor-pointer hover:bg-blue-500">
                                    Selanjutnya <i class="material-symbols-outlined">arrow_forward</i>
                                </div>
                            </div>
                            <div class="w-full flex justify-end pr-3">
                                <x-modal-open id="end_subject">
                                    <div
                                        class="max-w-[200px] flex gap-2 justify-center items-center flex-auto rounded-md border bg-red-400 px-4 py-1.5 text-center text-white hover:cursor-pointer hover:bg-red-500">
                                        <i class="material-symbols-outlined">send</i> Submit Answers
                                    </div>
                                </x-modal-open>

                                <x-modal id="end_subject">
                                    <div class="text-3xl font-bold mb-3">
                                        Submit
                                    </div>
                                    <p class="mb-4">
                                        Are you sure want to submit all answers to the teacher?<br />
                                        After you submit, you can't submit another answer.
                                    </p>
                                    <form action="{{ url('/subject/' . $subject->id . '/submit') }}" method="post">
                                        @csrf
                                        <x-button type="submit">
                                            Submit
                                        </x-button>
                                    </form>
                                </x-modal>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
