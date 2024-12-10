@extends('pages.teacher.base')

@section('header', 'Score')

@section('container')
    <div class="rounded-lg border shadow-lg py-3 px-5 w-full max-w-[1200px]">
        <div style="max-width: 1200px; overflow-x: auto;">
            <table id="scoreTable" class="row-border w-full max-w-[1200px]">
                <thead>
                <tr>
                    <th>Subject Name</th>
                    <th>Student Name</th>
                    <th>Score</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach(\App\Models\Score::query()->get() as $score)
                    <tr class="cursor-pointer hover:bg-blue-100">
                        <td>{{ $score->subject()->first()->name }}</td>
                        <td>{{ \App\Models\Student::query()->find($score->student_id)->full_name }}</td>
                        <td>{{ $score->score }}</td>
                        <td>
                            <div class="flex flex-row items-center gap-x-2 text-xs">
                                <form action="{{ url('admin/teacher/edit/' . $score->subject_id) }}">
                                    <button class="flex items-center gap-x-1 px-2 py-0.5 rounded-lg bg-yellow-600 hover:bg-yellow-500 text-gray-50">
                                        <span class="material-symbols-outlined">
                                            edit
                                        </span>
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
            new DataTable('#scoreTable');
        });
    </script>
@endsection
