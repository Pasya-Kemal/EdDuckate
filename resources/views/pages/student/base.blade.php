@extends('layout.app')

@section('body')
    <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8 border-b-4">
        <nav class="flex items-center justify-between py-6">
            <div class="inline-flex items-center">
                <img src="{{ asset('images/logos.png') }}" class="w-10 h-10 mr-3">
                <a href="{{ url('/') }}" class="text-2xl font-bold text-gray-800 px-4">Ujianify</a>
            </div>
            <div class="flex items-center">
                <form action="{{ url('auth/logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest bg-red-600 hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                        Logout
                    </button>
                </form>
            </div>
        </nav>
    </div>

    <div>
        @yield('container')
    </div>
    @endsection
