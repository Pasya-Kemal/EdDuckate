@extends('pages.admin.base')

@section('header', 'Student')

@section('container')
    <div class="max-w-[200px] mb-4">
        <form action="{{ url('admin/student/create') }}">
            <x-button type="submit">Create Student</x-button>
        </form>
    </div>
    <div class="rounded-lg border shadow-lg py-3 px-5 w-[1100px]">
        <div style="max-width: 1100px; overflow-x: auto;">
            <table id="studentTable" class="row-border max-w-[1100px]">
                <thead>
                <tr>
                    <th>Username</th>
                    <th>External ID</th>
                    <th>Full Name</th>
                    <th>Classroom</th>
                    <th>Major</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach(\App\Models\Student::query()->get() as $student)
                    <tr class="cursor-pointer hover:bg-blue-100">
                        <td>{{ $student->user()->first()->name }}</td>
                        <td>{{ $student->external_id }}</td>
                        <td>{{ $student->full_name }}</td>
                        <td>{{ $student->classroom()->first()->name }}</td>
                        <td>{{ $student->major()->first()->name }}</td>
                        <td>
                            <div class="flex flex-row items-center gap-x-2 text-xs">
                                <x-modal-open id="delete_student_{{ $student->user_id  }}">
                                    <button
                                        class="flex items-center gap-x-1 px-2 py-0.5 rounded-lg bg-red-900 hover:bg-red-800 text-gray-50">
                                        <span class="material-symbols-outlined">
                                            delete
                                        </span>
                                    </button>
                                </x-modal-open>
                                <x-modal id="delete_student_{{ $student->user_id  }}">
                                    <h1 class="mb-4 text-center">Are you sure?</h1>
                                    <hr>
                                    <div class="flex mt-5">
                                        <form action="{{ url('admin/student/delete/' . $student->user_id) }}" method="POST">
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
                                <form action="{{ url('admin/student/edit/' . $student->user_id) }}">
                                    <button class="flex items-center gap-x-1 px-2 py-0.5 rounded-lg bg-yellow-600 hover:bg-yellow-500 text-gray-50">
                                        <span class="material-symbols-outlined">
                                            edit
                                        </span>
                                    </button>
                                </form>
                                <form action="{{ url('admin/student/exportToCsv/' . $student->user_id) }}">
                                    @csrf
                                    <button class="flex items-center gap-x-1 px-2 py-0.5 rounded-lg bg-blue-600 hover:bg-blue-500 text-gray-50">
                                        <span class="material-symbols-outlined">download</span>
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
            new DataTable('#studentTable');
        });
    </script>
@endsection
