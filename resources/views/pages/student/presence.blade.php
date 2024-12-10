@extends('layout.app')

@section('body')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            startCountdown(new Date({{ $presence->ends_at->unix() * 1000 }}), 'presence_countdown');
        });
    </script>
    <div class="flex flex-col justify-center w-full h-[100vh]">
        <div class="flex justify-center w-full">
            <div class="flex flex-col gap-2 max-w-[450px] w-full">
                <div class="text-3xl font-bold text-center">
                    Presence
                </div>
                <div class="text-sm text-gray-400 text-center mb-3">
                    {{ $presence->name }} - {{ $presence->starts_at->format('Y/m/d H:i') }} - <span id="presence_countdown">........</span>
                </div>
                <div class="rounded-lg border border-gray-200 mx-2 p-6 shadow">
                    <form id="presence_form" action="{{ url('presence/' . $presence->id . '/submit') }}" method="POST">
                        @csrf
                        <div class="mb-1 font-semibold">
                            Status
                        </div>
                        <div class="mb-4">
                            <select name="status"
                                    class="shadow border border-gray-300 text-gray-600 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                                <option value=""></option>
                                <option value="present">Present</option>
                                <option value="excused">Excused</option>
                                <option value="sick">Sick</option>
                            </select>
                        </div>
                        <div class="mb-1 font-semibold">
                            Signature
                        </div>
                        <div class="mb-4">
                            <input type="hidden" id="signature_presence_input" name="signature">
                            <div class="border border-gray-200 shadow rounded-lg" id="signature_presence_wrapper">
                                <canvas id="signature_presence"></canvas>
                            </div>
                            <div class="flex justify-end text-sm mt-0.5 cursor-pointer text-blue-400" onclick="clearSignaturePresence()">
                                Clear Signature
                            </div>
                        </div>
                        <x-button type="submit">Submit</x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
