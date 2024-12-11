@extends('layout.app')

@section('body')

    {{-- SIDEBAR --}}
    <div class="fixed top-0 hidden h-[100vh] w-[250px] bg-blue-400 lg:block py-8 px-4 text-gray-100">
        <div class="flex flex-col h-full w-full gap-2">
            <div class="font-bold w-full text-center text-3xl">
                EdDuckate
            </div>
            <form class="w-full" action="{{ url('teacher/') }}">
                <button type="submit" class="{{ request()->is('admin/') ? "bg-blue-300 " : "bg-blue-400 hover:bg-blue-300 " }}flex gap-x-2 items-center rounded-lg px-4 py-2 font-semibold w-full">
                    <span class="material-symbols-outlined">
                        grid_view
                    </span>
                    Dashboard
                </button>
            </form>
            <form class="w-full" action="{{ url('teacher/subject') }}">
                <button type="submit" class="{{ request()->is('admin/') ? "bg-blue-300 " : "bg-blue-400 hover:bg-blue-300 " }}flex gap-x-2 items-center rounded-lg px-4 py-2 font-semibold w-full">
                    <span class="material-symbols-outlined">
                        subject
                    </span>
                    Subject
                </button>
            </form>
            <form class="w-full" action="{{ url('teacher/score') }}">
                <button type="submit" class="{{ request()->is('admin/') ? "bg-blue-300 " : "bg-blue-400 hover:bg-blue-300 " }}flex gap-x-2 items-center rounded-lg px-4 py-2 font-semibold w-full">
                    <span class="material-symbols-outlined">
                        grade
                    </span>
                    Grade
                </button>
            </form>
            <form class="w-full" action="{{ url('teacher/presence') }}">
                <button type="submit" class="{{ request()->is('admin/') ? "bg-blue-300 " : "bg-blue-400 hover:bg-blue-300 " }}flex gap-x-2 items-center rounded-lg px-4 py-2 font-semibold w-full">
                    <span class="material-symbols-outlined">
                        event
                    </span>
                    Presence
                </button>
            </form>
            <form method="post" class="w-full" action="{{ url('auth/logout') }}">
                @csrf
                <button type="submit" class="flex gap-x-2 items-center rounded-lg px-4 py-2 hover:bg-blue-300 hover:cursor-pointer font-semibold w-full">
                    <span class="material-symbols-outlined">
                        logout
                    </span>
                    Logout
                </button>
            </form>
        </div>
    </div>

    {{-- CONTAINER --}}
    <div class="w-full pl-[30px] pr-[30px] lg:pl-[280px] py-8">
        <div class="text-3xl font-bold mb-8">
            @yield('header')
        </div>
        @yield('container')
    </div>
@endsection
