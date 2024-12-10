@extends('layout.app')

@section('body')

    {{-- SIDEBAR --}}
    <div class="fixed top-0 hidden h-[100vh] w-[250px] bg-blue-400 lg:block py-8 px-4 text-gray-100 md:top-0 ">
        <div class="flex flex-col h-full w-full gap-2">
            <div class="font-bold w-full text-center text-3xl">
                Ujianify
            </div>
            <form class="w-full" action="{{ url('admin/') }}">
                <button type="submit" class="{{ request()->is('admin/') ? "bg-blue-300 " : "bg-blue-400 hover:bg-blue-300 " }}flex gap-x-2 items-center rounded-lg px-4 py-2 font-semibold w-full">
                    <span class="material-symbols-outlined">
                        grid_view
                    </span>
                    Dashboard
                </button>
            </form>
            <form class="w-full" action="{{ url('admin/admin/') }}">
                <button type="submit" class="{{ request()->is('admin/admin*') ? "bg-blue-300 " : "bg-blue-400 hover:bg-blue-300 " }}flex gap-x-2 items-center rounded-lg px-4 py-2 font-semibold w-full">
                    <span class="material-symbols-outlined">
                        shield_person
                    </span>
                    Admin User
                </button>
            </form>
            <form class="w-full" action="{{ url('admin/teacher/') }}">
                <button type="submit" class="{{ request()->is('admin/teacher*') ? "bg-blue-300 " : "bg-blue-400 hover:bg-blue-300 " }}flex gap-x-2 items-center rounded-lg px-4 py-2 font-semibold w-full">
                    <span class="material-symbols-outlined">
                        person
                    </span>
                    Teacher
                </button>
            </form>
            <form class="w-full" action="{{ url('admin/student/') }}">
                <button type="submit" class="{{ request()->is('admin/student*') ? "bg-blue-300 " : "bg-blue-400 hover:bg-blue-300 " }}flex gap-x-2 items-center rounded-lg px-4 py-2 font-semibold w-full">
                    <span class="material-symbols-outlined">
                    assignment_ind
                    </span>
                    Student
                </button>
            </form>
            <form class="w-full" action="{{ url('admin/major/') }}">
                <button type="submit" class="{{ request()->is('admin/major*') ? "bg-blue-300 " : "bg-blue-400 hover:bg-blue-300 " }}flex gap-x-2 items-center rounded-lg px-4 py-2 font-semibold w-full">
                    <span class="material-symbols-outlined">
                        school
                    </span>
                    Major
                </button>
            </form>
            <form class="w-full" action="{{ url('admin/classroom/') }}">
                <button type="submit" class="{{ request()->is('admin/classroom*') ? "bg-blue-300 " : "bg-blue-400 hover:bg-blue-300 " }}flex gap-x-2 items-center rounded-lg px-4 py-2 font-semibold w-full">
                    <span class="material-symbols-outlined">
                        meeting_room
                    </span>
                    Classroom
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
