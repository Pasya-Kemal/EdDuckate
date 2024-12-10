@extends('pages.student.base')

@section('container')
    <div class="container mx-auto px-4 py-8">
        @include('components.message')
        <div class="flex w-full">
            <div class="w-full">
                <h1 class="text-3xl font-bold text-gray-800 mb-4">Welcome to Ujianify</h1>
                <p class="text-xl mb-7">Hello {{ $student->full_name }}</p>
                <p class="text-xl font-bold mb-3">Presences</p>
                <div class="flex flex-wrap gap-6 justify-start">
                    @if(count($presences) === 0)
                        <div class="mb-2">
                            There are no absences that must be filled in.
                        </div>
                    @endif
                    @foreach ($presences as $presence)
                        <form action="{{ url('presence/' . $presence->id) }}" class="flex flex-col max-w-[350px] w-full mb-4">
                            <div class="rounded-t-lg bg-green-700 text-white px-4 py-2 font-bold">
                                Presence #{{ $presence->id }}
                            </div>
                            <div class="flex flex-col border border-y-0 border-green-700 pt-1">
                                <div class="flex justify-between w-full border-b px-4 py-1">
                                    <div>Name</div>
                                    <div class="font-bold">{{ $presence->name }}</div>
                                </div>
                                <div class="flex justify-between w-full border-b px-4 py-1">
                                    <div>Teacher</div>
                                    <div class="font-bold">{{ $presence->teacher->full_name }}</div>
                                </div>
                                @if($presence->major !== null)
                                    <div class="flex justify-between w-full border-b px-4 py-1">
                                        <div>Major</div>
                                        <div class="font-bold">{{ $presence->major->name }}</div>
                                    </div>
                                @endif
                                @if($presence->classroom !== null)
                                    <div class="flex justify-between w-full border-b px-4 py-1">
                                        <div>Classroom</div>
                                        <div class="font-bold">{{ $presence->classroom->name }}</div>
                                    </div>
                                @endif
                                <div class="flex justify-between w-full px-4 py-1">
                                    <div>Ends in</div>
                                    <div class="font-bold" id="presence_{{ $presence->id }}_countdown"></div>
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function () {
                                            startCountdown(new Date({{ $presence->ends_at->unix() * 1000 }}), "presence_{{ $presence->id }}_countdown");
                                        });
                                    </script>
                                </div>
                            </div>
                            <button type="submit" class="bg-green-700 rounded-b-lg px-3 py-1 text-white text-center font-bold">
                                Start
                            </button>
                        </form>
                    @endforeach
                </div>
                <p class="text-xl font-bold mb-3">Subject</p>
                <div class="flex flex-wrap gap-6 justify-start">
                    @foreach ($subjects as $subject)
                        <form action="{{ url('rules/' . $subject->id) }}" class="flex flex-col max-w-[350px] w-full mb-4">
                            <div class="rounded-t-lg bg-orange-900 text-white px-4 py-2 font-bold">
                                Subject #{{ $subject->id }}
                            </div>
                            <div class="flex flex-col border border-y-0 border-orange-900 pt-1">
                                <div class="flex justify-between w-full border-b px-4 py-1">
                                    <div>Name</div>
                                    <div class="font-bold">{{ $subject->name }}</div>
                                </div>
                                <div class="flex justify-between w-full border-b px-4 py-1">
                                    <div>Questions</div>
                                    <div class="font-bold">{{ count($subject->questions) }}</div>
                                </div>
                                <div class="flex justify-between w-full px-4 py-1">
                                    <div>Ends in</div>
                                    <div class="font-bold" id="subject_{{ $subject->id }}_countdown"></div>
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function () {
                                            startCountdown(new Date({{ $subject->ends_at->unix() * 1000 }}), "subject_{{ $subject->id }}_countdown");
                                        });
                                    </script>
                                </div>
                            </div>
                            <button type="submit" class="bg-orange-900 rounded-b-lg px-3 py-1 text-white text-center font-bold">
                                Start
                            </button>
                        </form>
                    @endforeach
                </div>
            </div>
            <div style="margin-top: 80px;">
                <img src="{{ url("images/student_welcome.gif") }}" alt="anim welcome student" width="400">
            </div>
        </div>
    </div>
@endsection
