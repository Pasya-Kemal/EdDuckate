@extends('pages.teacher.base')

@section('header', 'Subject')

@section('container')
    <div class="max-w-[200px] mb-4">
        <form action="{{ url('teacher/subject/create') }}">
        <x-button type="submit">Create Subject</x-button>
        </form>
    </div>
    <div class="rounded-lg border shadow-lg py-3 px-5 w-full max-w-[1400px]">
        <div style="width: 100%; max-width: 1400px; overflow-x: auto;">
            <table id="subjectTable" class="row-border w-full max-w-[1400px]">
                <thead>
                <tr>
                    <th>Subject Name</th>
                    <th>Starts At</th>
                    <th>Ends At</th>
                    <th>Shuffle Question</th>
                    <th>Shuffle Answer</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach(\App\Models\Subject::query()->get() as $subject)
                    <tr class="cursor-pointer hover:bg-blue-100">
                        <td onclick="window.location.href = '{{ url('teacher/subject/questions/' . $subject->id) }}';">{{ $subject->name }}</td>
                        <td>{{ $subject->starts_at->format('j F Y, H.i') }}</td>
                        <td>{{ $subject->ends_at->format('j F Y, H.i') }}</td>
                        <td>{{ $subject->shuffle_questions ? 'Yes' : 'No' }}</td>
                        <td>{{ $subject->shuffle_answers ? 'Yes' : 'No' }}</td>
                        <td>
                            <div class="flex flex-row items-center gap-x-2 text-xs">
                                <x-modal-open id="delete_classroom_{{ $subject->id }}">
                                    <button class="flex items-center gap-x-1 px-2 py-0.5 rounded-lg bg-red-900 hover:bg-red-800 text-gray-50">
                                        <span class="material-symbols-outlined">delete</span>
                                    </button>
                                </x-modal-open>
                                <x-modal id="delete_classroom_{{ $subject->id }}">
                                    <h1 class="mb-4 text-center">Are you sure?</h1>
                                    <hr>
                                    <div class="flex mt-5">
                                        <form action="{{ url('teacher/subject/delete/' . $subject->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-md hover:bg-blue-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 mr-5 w-60 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-110">
                                                <span>Yes</span>
                                            </button>
                                        </form>
                                        <button class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-red-900 rounded-md hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 w-60 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-110">
                                            <span>Cancel</span>
                                        </button>
                                    </div>
                                </x-modal>
                                <form action="{{ url('teacher/subject/edit/' . $subject->id) }}">
                                    <button class="flex items-center gap-x-1 px-2 py-0.5 rounded-lg bg-yellow-600 hover:bg-yellow-500 text-gray-50">
                                        <span class="material-symbols-outlined">edit</span>
                                    </button>
                                </form>
                                <form action="{{ url('teacher/score/exportToCsv/' . $subject->id) }}">
                                    @csrf
                                    <button class="flex items-center gap-x-1 px-2 py-0.5 rounded-lg bg-blue-600 hover:bg-blue-500 text-gray-50">
                                        <span class="material-symbols-outlined">download</span>
                                    </button>
                                </form>
                                <form action="{{ url('teacher/subject/getcam/' . $subject->id) }}">
                                    @csrf
                                    <button class="flex items-center gap-x-1 px-2 py-0.5 rounded-lg bg-blue-600 hover:bg-blue-500 text-gray-50">
                                        <span class="material-symbols-outlined">photo_camera</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        $(document).ready(function () {
            new DataTable('#subjectTable');
        });
    </script>
@endsection
