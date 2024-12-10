@extends('pages.teacher.base')

@section('header', 'Dashboard')

@section('container')
    <div class="grid grid-cols-2 gap-4">
        <div class="col-span-1">
            <div class="max-w-4xl w-full p-4 bg-white shadow-lg rounded-lg transform hover:scale-105 transition-transform duration-300 m-4" role="region" aria-label="Presence card">
                <div class="mt-4 grid grid-cols-1 gap-2">

                    <div class="p-6 bg-green-100 rounded-lg flex items-center justify-between hover:bg-green-200 transition-colors duration-300 cursor-pointer shadow-md hover:shadow-lg" role="button" aria-label="Presences count">
                        <div class="text-green-500">
                            <span class="material-symbols-outlined text-2xl">
                                event
                            </span>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-medium text-gray-700">Presence</p>
                            <p id="teacher-count" class="text-lg font-semibold text-gray-900">{{ $presence->count() }}</p>
                        </div>
                    </div>

                    <div class="p-6 bg-purple-100 rounded-lg flex items-center justify-between hover:bg-purple-200 transition-colors duration-300 cursor-pointer shadow-md hover:shadow-lg" role="button" aria-label="Submissions count">
                        <div class="text-purple-500">
                            <span class="material-symbols-outlined text-2xl">
                                domain_verification
                            </span>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-medium text-gray-700">Submission</p>
                            <p id="classroom-count" class="text-lg font-semibold text-gray-900">{{ $submission->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-span-1">
            <div class="max-w-4xl w-full p-4 bg-white shadow-lg rounded-lg transform hover:scale-105 transition-transform duration-300 m-4" role="region" aria-label="Subject card">
                <div class="mt-4 grid grid-cols-1 gap-2">

                    <div class="p-6 bg-blue-100 rounded-lg flex items-center justify-between hover:bg-blue-200 transition-colors duration-300 cursor-pointer shadow-md hover:shadow-lg" role="button" aria-label="Subjects count">
                        <div class="text-blue-500">
                            <span class="material-symbols-outlined text-2xl">
                                subject
                            </span>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-medium text-gray-700">Subject</p>
                            <p id="admin-count" class="text-lg font-semibold text-gray-900">{{ $subject->count() }}</p>
                        </div>
                    </div>

                    <div class="p-6 bg-orange-100 rounded-lg flex items-center justify-between hover:bg-orange-200 transition-colors duration-300 cursor-pointer shadow-md hover:shadow-lg" role="button" aria-label="Questions count">
                        <div class="text-orange-500">
                            <span class="material-symbols-outlined text-2xl">
                                note
                            </span>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-medium text-gray-700">Made Questions</p>
                            <p id="major-count" class="text-lg font-semibold text-gray-900">{{ $question->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
