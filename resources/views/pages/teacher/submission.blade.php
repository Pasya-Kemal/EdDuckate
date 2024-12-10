@extends('pages.teacher.base')

@section('header', 'Submissions')

@section('container')
    <div class="flex flex-col w-full gap-4">
        <div class="mb-8">
            Presence: <b>{{ $presence->name }}</b>
        </div>
        <div class="flex flex-col gap-4">
            @php
                $noSubmission = 0;
            @endphp
            @foreach(\App\Models\PresenceSubmission::query()->where('presence_id', '=', $presence->id)->get() as $presencesubmission)
                @php
                    $noSubmission++;
                @endphp
                <div class="flex flex-col gap-0.5 rounded-lg px-4 py-3 shadow border">
                    <div class="flex flex-col gap-4 text-lg mb-2 w-full">
                        <div class="font-bold">
                            {{ $noSubmission }}.
                            {{ $presencesubmission->student->full_name }}
                            <p class="capitalize">status : {{ $presencesubmission->status }}</p>   
                        </div>
                        <div class="flex flex-col w-full py-1 px-3 rounded border">
                                <div class="mb-2 p-1 border mt-2">
                                    <img class="max-w-[600px] max-h-[400px]" src="{{ url('images/signature/' . $presencesubmission->signature_src ) }}" alt="signature_image_{{ $presencesubmission->id }}"/>
                                </div>
                            <div>
                                {!! nl2br($presencesubmission->presencesubmission) !!}
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-2 items-center mt-2">
                        <x-modal-open id="delete_submission_{{ $presencesubmission->id  }}">
                            <button
                                class="flex items-center gap-x-1 px-2 py-0.5 rounded-lg bg-red-900 hover:bg-red-800 text-gray-50">
                                <span class="material-symbols-outlined">
                                    delete
                                </span>
                            </button>
                        </x-modal-open>

                        <x-modal id="delete_submission_{{ $presencesubmission->id  }}">
                            <h1 class="mb-4">Are you sure?</h1>
                            <hr>
                            <div class="flex mt-5">
                                <form action="{{ url('teacher/presence/deleteSubmission/' . $presencesubmission->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        class="items-center gap-x-1 px-2 py-2 rounded-lg bg-blue-500 hover:bg-blue-400 text-gray-50 mr-5 w-60">Yes</button>
                                </form>
                                <button
                                    class="items-center gap-x-1 px-2 py-2 rounded-lg bg-red-900 hover:bg-red-800 text-gray-50 w-60">Cancel</button>
                            </div>
                        </x-modal>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
